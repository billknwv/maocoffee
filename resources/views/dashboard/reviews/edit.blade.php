@extends('layouts.dashboard')

@section('page-title', 'Edit Review')

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
        <!-- Header dengan Tombol Kembali -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Edit Review</h2>
            <a href="{{ route('dashboard.reviews.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
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

        <form action="{{ route('dashboard.reviews.update', $review->id_review) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Preview Foto Profil -->
                <div class="flex items-center gap-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2 w-48">Foto Profil Saat Ini</label>
                    <div class="w-20 h-20 flex items-center justify-center bg-gray-100 rounded-full p-2">
                        <img src="{{ asset('storage/' . $review->profil_review) }}" 
                             alt="{{ $review->nama_review }}" 
                             class="max-w-full max-h-full object-cover rounded-full">
                    </div>
                </div>

                <!-- Nama Reviewer -->
                <div class="flex items-start gap-6">
                    <label class="block text-gray-700 text-sm font-bold pt-2 w-48">Nama Reviewer *</label>
                    <div class="flex-1">
                        <input type="text" name="nama_review" value="{{ old('nama_review', $review->nama_review) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]"
                               placeholder="Masukkan nama reviewer" required>
                    </div>
                </div>

                <!-- Rating Bintang -->
                <div class="flex items-start gap-6">
                    <label class="block text-gray-700 text-sm font-bold pt-2 w-48">Rating *</label>
                    <div class="flex-1">
                        <select name="bintang" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]" required>
                            <option value="5" {{ old('bintang', $review->bintang) == '5' ? 'selected' : '' }}>⭐️⭐️⭐️⭐️⭐️ (5 Bintang)</option>
                            <option value="4" {{ old('bintang', $review->bintang) == '4' ? 'selected' : '' }}>⭐️⭐️⭐️⭐️ (4 Bintang)</option>
                            <option value="3" {{ old('bintang', $review->bintang) == '3' ? 'selected' : '' }}>⭐️⭐️⭐️ (3 Bintang)</option>
                            <option value="2" {{ old('bintang', $review->bintang) == '2' ? 'selected' : '' }}>⭐️⭐️ (2 Bintang)</option>
                            <option value="1" {{ old('bintang', $review->bintang) == '1' ? 'selected' : '' }}>⭐️ (1 Bintang)</option>
                        </select>
                    </div>
                </div>

                <!-- Deskripsi Review -->
                <div class="flex items-start gap-6">
                    <label class="block text-gray-700 text-sm font-bold pt-2 w-48">Deskripsi Review *</label>
                    <div class="flex-1">
                        <textarea name="deskripsi_review" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]"
                                  placeholder="Masukkan deskripsi review" required>{{ old('deskripsi_review', $review->deskripsi_review) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Maksimal 255 karakter</p>
                    </div>
                </div>

                <!-- Foto Profil Baru (Optional) -->
                <div class="flex items-start gap-6">
                    <label class="block text-gray-700 text-sm font-bold pt-2 w-48">Foto Profil Baru (Opsional)</label>
                    <div class="flex-1">
                        <input type="file" name="profil_review" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]"
                               accept="image/*">
                        <p class="text-xs text-gray-500 mt-1">Format: jpeg, png, jpg, gif | Max: 2MB</p>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="flex justify-end pt-6">
                    <button type="submit" 
                            class="bg-[#2E4239] hover:bg-[#1a2a22] text-white px-6 py-3 rounded-lg transition duration-200 flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        Update Review
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection