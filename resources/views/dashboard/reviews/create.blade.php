@extends('layouts.dashboard')

@section('page-title', 'Tambah Review Baru')

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Review Baru</h2>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.reviews.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 gap-6">
                <!-- Nama Reviewer -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Reviewer *</label>
                    <input type="text" name="nama_review" value="{{ old('nama_review') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]"
                           placeholder="Masukkan nama reviewer" required>
                </div>

                <!-- Rating Bintang -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Rating *</label>
                    <select name="bintang" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]" required>
                        <option value="">Pilih Rating</option>
                        <option value="5" {{ old('bintang') == '5' ? 'selected' : '' }}>⭐️⭐️⭐️⭐️⭐️ (5 Bintang)</option>
                        <option value="4" {{ old('bintang') == '4' ? 'selected' : '' }}>⭐️⭐️⭐️⭐️ (4 Bintang)</option>
                        <option value="3" {{ old('bintang') == '3' ? 'selected' : '' }}>⭐️⭐️⭐️ (3 Bintang)</option>
                        <option value="2" {{ old('bintang') == '2' ? 'selected' : '' }}>⭐️⭐️ (2 Bintang)</option>
                        <option value="1" {{ old('bintang') == '1' ? 'selected' : '' }}>⭐️ (1 Bintang)</option>
                    </select>
                </div>

                <!-- Deskripsi Review -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Review *</label>
                    <textarea name="deskripsi_review" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]"
                              placeholder="Masukkan deskripsi review" required>{{ old('deskripsi_review') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Maksimal 255 karakter</p>
                </div>

                <!-- Foto Profil -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Foto Profil *</label>
                    <input type="file" name="profil_review" 
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
                    Simpan Review
                </button>
                <a href="{{ route('dashboard.reviews.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-200 flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection