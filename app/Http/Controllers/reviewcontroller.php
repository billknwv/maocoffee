<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    /**
     * Menampilkan daftar review di dashboard
     */
    public function dashboardIndex()
    {
        $reviews = Review::orderBy('id_review', 'desc')->get();
        return view('dashboard.reviews.index', compact('reviews'));
    }

    /**
     * Menampilkan form tambah review
     */
    public function create()
    {
        return view('dashboard.reviews.create');
    }

    /**
     * Menyimpan review baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_review' => 'required|string|max:255',
            'bintang' => 'required|integer|min:1|max:5',
            'deskripsi_review' => 'required|string|max:255',
            'profil_review' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar profil
        $profilPath = $request->file('profil_review')->store('reviews', 'public');

        // Simpan ke database
        Review::create([
            'nama_review' => $request->nama_review,
            'bintang' => $request->bintang,
            'deskripsi_review' => $request->deskripsi_review,
            'profil_review' => $profilPath,
        ]);

        return redirect()->route('dashboard.reviews.index')
            ->with('success', 'Review berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit review
     */
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('dashboard.reviews.edit', compact('review'));
    }

    /**
     * Update review
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        
        $request->validate([
            'nama_review' => 'required|string|max:255',
            'bintang' => 'required|integer|min:1|max:5',
            'deskripsi_review' => 'required|string|max:255',
            'profil_review' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nama_review' => $request->nama_review,
            'bintang' => $request->bintang,
            'deskripsi_review' => $request->deskripsi_review,
        ];

        // Jika ada gambar baru, upload dan hapus yang lama
        if ($request->hasFile('profil_review')) {
            // Hapus gambar lama
            if ($review->profil_review) {
                Storage::disk('public')->delete($review->profil_review);
            }
            $profilPath = $request->file('profil_review')->store('reviews', 'public');
            $data['profil_review'] = $profilPath;
        }

        $review->update($data);

        return redirect()->route('dashboard.reviews.index')
            ->with('success', 'Review berhasil diupdate!');
    }

    /**
     * Hapus review
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        
        // Hapus gambar dari storage
        if ($review->profil_review) {
            Storage::disk('public')->delete($review->profil_review);
        }
        
        $review->delete();

        return redirect()->route('dashboard.reviews.index')
            ->with('success', 'Review berhasil dihapus!');
    }

    /**
     * Menampilkan maksimal 6 review dari database (untuk public)
     */
    public function index()
    {
        // Ambil 6 review terbaru
        $reviews = Review::orderBy('id_review', 'desc')
            ->take(6)
            ->get();

        return view('review.index', compact('reviews'));
    }

    /**
     * Ambil data review untuk ditampilkan di home
     */
    public function getReviewsForHome()
    {
        $reviews = Review::orderBy('id_review', 'desc')
            ->take(6)
            ->get();

        return $reviews;
    }
}