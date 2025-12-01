<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Menampilkan daftar menu di dashboard dengan filter kategori
     */
    public function dashboardIndex(Request $request)
    {
        $kategori = $request->query('kategori', 'all');
        
        $query = Menu::query();
        
        if ($kategori !== 'all') {
            $query->where('kategori', $kategori);
        }
        
        $menus = $query->orderBy('id_menu', 'desc')->get();
        
        return view('dashboard.menu.index', compact('menus', 'kategori'));
    }

    /**
     * Menampilkan form tambah menu
     */
    public function create()
    {
        return view('dashboard.menu.create');
    }

    /**
     * Menyimpan menu baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'deskripsi_menu' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|in:Food,Drink,Snack',
            'img_menu' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar
        $gambarPath = $request->file('img_menu')->store('menu', 'public');

        // Simpan ke database
        Menu::create([
            'nama_menu' => $request->nama_menu,
            'deskripsi_menu' => $request->deskripsi_menu,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'img_menu' => $gambarPath,
        ]);

        return redirect()->route('dashboard.menu.index')
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit menu
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('dashboard.menu.edit', compact('menu'));
    }

    /**
     * Update menu
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'deskripsi_menu' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|in:Food,Drink,Snack',
            'img_menu' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nama_menu' => $request->nama_menu,
            'deskripsi_menu' => $request->deskripsi_menu,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
        ];

        // Jika ada gambar baru, upload dan hapus yang lama
        if ($request->hasFile('img_menu')) {
            // Hapus gambar lama
            if ($menu->img_menu) {
                Storage::disk('public')->delete($menu->img_menu);
            }
            $gambarPath = $request->file('img_menu')->store('menu', 'public');
            $data['img_menu'] = $gambarPath;
        }

        $menu->update($data);

        return redirect()->route('dashboard.menu.index')
            ->with('success', 'Menu berhasil diupdate!');
    }

    /**
     * Hapus menu
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        
        // Hapus gambar dari storage
        if ($menu->img_menu) {
            Storage::disk('public')->delete($menu->img_menu);
        }
        
        $menu->delete();

        return redirect()->route('dashboard.menu.index')
            ->with('success', 'Menu berhasil dihapus!');
    }

    /**
     * Menampilkan daftar menu berdasarkan kategori (6 data dibagi 2 halaman, 3 per halaman)
     */
    public function index(Request $request)
    {
        // Ambil kategori dari query parameter
        $kategori = $request->query('category', 'Drink');

        // Ambil halaman dari query parameter
        $page = (int) $request->query('page', 1);
        $perPage = 3;
        $maxItems = 6;

        Log::info('Kategori: ' . $kategori);
        Log::info('Page: ' . $page);
    
        // Ambil data dengan urutan terbaru
        $menuQuery = Menu::where('kategori', $kategori)
            ->take($maxItems)
            ->get();

        // Bagi data untuk pagination
        $menuItems = $menuQuery->slice(($page - 1) * $perPage, $perPage)->values();
        $totalPages = min(2, ceil($menuQuery->count() / $perPage));
        return view('section.menu', [
            'menuItems' => $menuItems,
            'kategoriAktif' => $kategori,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * Method untuk AJAX request (hanya return HTML content)
     */
    public function getMenuContent(Request $request)
    {
        $kategori = $request->query('category', 'Drink');
        $page = (int) $request->query('page', 1);
        $perPage = 3;
        $maxItems = 6;

        $menuQuery = Menu::where('kategori', $kategori)
            ->take($maxItems)
            ->get();

        $menuItems = $menuQuery->slice(($page - 1) * $perPage, $perPage)->values();
        $totalPages = ceil($menuQuery->count() / $perPage);

        // Return hanya bagian HTML yang diperlukan
        if ($request->ajax()) {
            return view('partials.menu-content', [
                'menuItems' => $menuItems,
                'kategoriAktif' => $kategori,
                'page' => $page,
                'totalPages' => $totalPages
            ])->render();
        }

        return view('partials.menu-content', [
            'menuItems' => $menuItems,
            'kategoriAktif' => $kategori,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }

    /**
     * Method untuk AJAX request dengan JSON response (alternatif)
     */
    public function getMenuData(Request $request)
    {
        $kategori = $request->query('category', 'Drink');
        $page = (int) $request->query('page', 1);
        $perPage = 3;
        $maxItems = 6;

        $menuQuery = Menu::where('kategori', $kategori)
            ->take($maxItems)
            ->get();

        $menuItems = $menuQuery->slice(($page - 1) * $perPage, $perPage)->values();
        $totalPages = ceil($menuQuery->count() / $perPage);

        // Return JSON response
        return response()->json([
            'success' => true,
            'data' => [
                'menuItems' => $menuItems,
                'kategoriAktif' => $kategori,
                'page' => $page,
                'totalPages' => $totalPages,
                'html' => view('partials.menu-content', [
                    'menuItems' => $menuItems,
                    'kategoriAktif' => $kategori,
                    'page' => $page,
                    'totalPages' => $totalPages
                ])->render()
            ]
        ]);
    }

    /**
     * Form sementara untuk tambah menu
     */
    public function createSimple()
    {
        return view('menu.form-simple');
    }

    /**
     * Simpan data menu dari form sementara
     */
    public function storeSimple(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'deskripsi_menu' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|in:Drink,Food,Snack,Dessert',
            'img_menu' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar
        $gambarPath = $request->file('img_menu')->store('menu', 'public');

        // Simpan ke database
        Menu::create([
            'nama_menu' => $request->nama_menu,
            'deskripsi_menu' => $request->deskripsi_menu,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'img_menu' => $gambarPath,
            'stok' => 10,
        ]);

        return redirect()->route('menu.create-simple')
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Method tambahan untuk keperluan lain (opsional)
     */
    
    /**
     * Menampilkan semua menu (tanpa pagination)
     */
    public function showAll()
    {
        $menus = Menu::all();
        return view('section.menu', ['menus' => $menus]);
    }

    /**
     * Menampilkan detail menu tertentu
     */
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.detail', compact('menu'));
    }
}