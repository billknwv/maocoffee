@extends('layouts.dashboard')

@section('page-title', 'Tambah Paket Baru')

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
        <!-- Header dengan Tombol Kembali -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('dashboard.paket.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
            <h2 class="text-2xl font-semibold text-gray-800">Tambah Paket Baru</h2>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.paket.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <!-- Nama Paket -->
                <div class="flex flex-col md:flex-row md:items-start gap-4 md:gap-6">
                    <label class="block text-gray-700 text-sm font-bold pt-2 w-full md:w-48">Nama Paket *</label>
                    <div class="flex-1">
                        <input type="text" name="nama_paket" value="{{ old('nama_paket') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239] @error('nama_paket') border-red-500 @enderror"
                               placeholder="Masukkan nama paket" required>
                        @error('nama_paket')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi Menu -->
                <div class="flex flex-col md:flex-row md:items-start gap-4 md:gap-6">
                    <label class="block text-gray-700 text-sm font-bold pt-2 w-full md:w-48">Deskripsi Menu *</label>
                    <div class="flex-1">
                        <textarea name="deeskripsi_menu" rows="5"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239] @error('deeskripsi_menu') border-red-500 @enderror"
                                  placeholder="Masukkan deskripsi menu yang termasuk dalam paket" required>{{ old('deeskripsi_menu') }}</textarea>
                        @error('deeskripsi_menu')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Contoh: Nasi Goreng Special + Es Teh Manis + Pisang Goreng</p>
                    </div>
                </div>

                <!-- Harga Paket -->
                <div class="flex flex-col md:flex-row md:items-start gap-4 md:gap-6">
                    <label class="block text-gray-700 text-sm font-bold pt-2 w-full md:w-48">Harga Paket *</label>
                    <div class="flex-1">
                        <input type="number" name="harga_paket" value="{{ old('harga_paket') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239] @error('harga_paket') border-red-500 @enderror"
                               placeholder="0" min="0" required>
                        @error('harga_paket')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Gambar Paket -->
                <div class="flex flex-col md:flex-row md:items-start gap-4 md:gap-6">
                    <label class="block text-gray-700 text-sm font-bold pt-2 w-full md:w-48">Gambar Paket *</label>
                    <div class="flex-1">
                        <input type="file" name="image_paket" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239] @error('image_paket') border-red-500 @enderror"
                               accept="image/*" required>
                        @error('image_paket')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Format: jpeg, png, jpg, gif | Max: 2MB</p>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="flex justify-end pt-6">
                    <button type="submit" 
                            class="bg-[#2E4239] hover:bg-[#1a2a22] text-white px-6 py-3 rounded-lg transition duration-200 flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        Simpan Paket
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection