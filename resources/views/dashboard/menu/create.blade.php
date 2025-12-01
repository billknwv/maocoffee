@extends('layouts.dashboard')

@section('page-title', 'Tambah Menu Baru')

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Menu Baru</h2>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Menu -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Menu *</label>
                    <input type="text" name="nama_menu" value="{{ old('nama_menu') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]"
                           placeholder="Masukkan nama menu" required>
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi *</label>
                    <textarea name="deskripsi_menu" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]"
                              placeholder="Masukkan deskripsi menu" required>{{ old('deskripsi_menu') }}</textarea>
                </div>

                <!-- Harga -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Harga *</label>
                    <input type="number" name="harga" value="{{ old('harga') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]"
                           placeholder="0" min="0" required>
                </div>

                <!-- Stok -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Stok *</label>
                    <input type="number" name="stok" value="{{ old('stok') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]"
                           placeholder="0" min="0" required>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Kategori *</label>
                    <select name="kategori" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Food" {{ old('kategori') == 'Food' ? 'selected' : '' }}>Makanan</option>
                        <option value="Drink" {{ old('kategori') == 'Drink' ? 'selected' : '' }}>Minuman</option>
                        <option value="Snack" {{ old('kategori') == 'Snack' ? 'selected' : '' }}>Snack</option>
                    </select>
                </div>

                <!-- Gambar Menu -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Menu *</label>
                    <input type="file" name="img_menu" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]"
                           accept="image/*" required>
                    <p class="text-xs text-gray-500 mt-1">Format: jpeg, png, jpg, gif | Max: 2MB</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 mt-8">
                <button type="submit" 
                        class="bg-[#2E4239] hover:bg-[#1a2a22] text-white px-6 py-3 rounded-lg transition duration-200 flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Simpan Menu
                </button>
                <a href="{{ route('dashboard.menu.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-200 flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection