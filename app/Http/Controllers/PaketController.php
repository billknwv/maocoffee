<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    /**
     * Menampilkan daftar paket di dashboard
     */
    public function dashboardIndex()
    {
        $pakets = Paket::orderBy('id_paket', 'desc')->get();
        return view('dashboard.paket.index', compact('pakets'));
    }

    /**
     * Menampilkan form tambah paket
     */
    public function create()
    {
        return view('dashboard.paket.create');
    }

    /**
     * Menyimpan paket baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deeskripsi_menu' => 'required|string',
            'harga_paket' => 'required|numeric|min:0',
            'image_paket' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_paket.required' => 'Nama paket harus diisi',
            'deeskripsi_menu.required' => 'Deskripsi menu harus diisi',
            'harga_paket.required' => 'Harga paket harus diisi',
            'harga_paket.numeric' => 'Harga paket harus berupa angka',
            'harga_paket.min' => 'Harga paket tidak boleh negatif',
            'image_paket.required' => 'Gambar paket harus diupload',
            'image_paket.image' => 'File harus berupa gambar',
            'image_paket.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'image_paket.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Upload gambar
        $imagePath = $request->file('image_paket')->store('paket', 'public');

        // Simpan ke database
        Paket::create([
            'nama_paket' => $request->nama_paket,
            'deeskripsi_menu' => $request->deeskripsi_menu,
            'harga_paket' => $request->harga_paket,
            'image_paket' => $imagePath,
        ]);

        return redirect()->route('dashboard.paket.index')
            ->with('success', 'Paket berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit paket
     */
    public function edit($id)
    {
        $paket = Paket::findOrFail($id);
        return view('dashboard.paket.edit', compact('paket'));
    }

    /**
     * Update paket
     */
    public function update(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);
        
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deeskripsi_menu' => 'required|string',
            'harga_paket' => 'required|numeric|min:0',
            'image_paket' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_paket.required' => 'Nama paket harus diisi',
            'deeskripsi_menu.required' => 'Deskripsi menu harus diisi',
            'harga_paket.required' => 'Harga paket harus diisi',
            'harga_paket.numeric' => 'Harga paket harus berupa angka',
            'harga_paket.min' => 'Harga paket tidak boleh negatif',
            'image_paket.image' => 'File harus berupa gambar',
            'image_paket.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'image_paket.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $data = [
            'nama_paket' => $request->nama_paket,
            'deeskripsi_menu' => $request->deeskripsi_menu,
            'harga_paket' => $request->harga_paket,
        ];

        // Jika ada gambar baru, upload dan hapus yang lama
        if ($request->hasFile('image_paket')) {
            // Hapus gambar lama
            if ($paket->image_paket) {
                Storage::disk('public')->delete($paket->image_paket);
            }
            $imagePath = $request->file('image_paket')->store('paket', 'public');
            $data['image_paket'] = $imagePath;
        }

        $paket->update($data);

        return redirect()->route('dashboard.paket.index')
            ->with('success', 'Paket berhasil diupdate!');
    }

    /**
     * Hapus paket
     */
    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);
        
        // Hapus gambar dari storage
        if ($paket->image_paket) {
            Storage::disk('public')->delete($paket->image_paket);
        }
        
        $paket->delete();

        return redirect()->route('dashboard.paket.index')
            ->with('success', 'Paket berhasil dihapus!');
    }
}