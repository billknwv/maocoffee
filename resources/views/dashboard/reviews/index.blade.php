@extends('layouts.dashboard')

@section('page-title', 'Manajemen Review')

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Header dengan Tombol Tambah -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Manajemen Review</h2>
                <p class="text-gray-600">Kelola testimoni dan ulasan pelanggan</p>
            </div>
            
            <!-- Tombol Tambah Review -->
            <a href="{{ route('dashboard.reviews.create') }}" 
               class="bg-[#2E4239] hover:bg-[#1a2a22] text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2 whitespace-nowrap">
                <i class="fas fa-plus"></i>
                Tambah Review
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Reviews -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Foto Profil</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Rating</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Deskripsi</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($reviews as $review)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <img src="{{ asset('storage/' . $review->profil_review) }}" 
                                 alt="{{ $review->nama_review }}" 
                                 class="w-12 h-12 object-cover rounded-full">
                        </td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-800">{{ $review->nama_review }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->bintang ? 'text-yellow-400' : 'text-gray-300' }} text-sm"></i>
                                @endfor
                                <span class="ml-2 text-sm text-gray-600">({{ $review->bintang }}/5)</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-sm text-gray-600">{{ Str::limit($review->deskripsi_review, 80) }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('dashboard.reviews.edit', $review->id_review) }}" 
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition duration-200">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('dashboard.reviews.destroy', $review->id_review) }}" method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus review ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition duration-200">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-star text-4xl mb-2 block"></i>
                            Tidak ada review yang ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection