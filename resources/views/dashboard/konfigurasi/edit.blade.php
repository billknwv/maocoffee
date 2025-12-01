@extends('layouts.dashboard')

@section('page-title', 'Edit Konfigurasi Website')

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Konfigurasi Website</h2>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('konfigurasi.update', $konfigurasi->id_konfigurasi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Logo Website -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Logo Website</label>
                @if($konfigurasi->logo_web)
                    <div class="mb-3">
                        <p class="text-sm text-gray-600 mb-2">Current Logo:</p>
                        <img src="{{ asset('storage/' . $konfigurasi->logo_web) }}" 
                             alt="Current Logo" 
                             class="w-20 h-20 object-cover rounded-lg border">
                    </div>
                @endif
                <input type="file" name="logo_web" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2E4239]">
                <p class="text-xs text-gray-500 mt-1">Format: jpeg, png, jpg, gif | Max: 2MB</p>
            </div>

            <!-- Card 1 -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Card 1 Image</label>
                @if($konfigurasi->img_card1)
                    <div class="mb-3">
                        <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                        <img src="{{ asset('storage/' . $konfigurasi->img_card1) }}" 
                             alt="Current Card 1" 
                             class="w-32 h-32 object-cover rounded-lg border">
                    </div>
                @endif
                <input type="file" name="img_card1" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2E4239]">
                <p class="text-xs text-gray-500 mt-1">Format: jpeg, png, jpg, gif | Max: 2MB</p>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Card 1</label>
                <input type="text" name="nama_card1" value="{{ old('nama_card1', $konfigurasi->nama_card1) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2E4239]"
                       required>
            </div>

            <!-- Card 2 -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Card 2 Image</label>
                @if($konfigurasi->img_card2)
                    <div class="mb-3">
                        <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                        <img src="{{ asset('storage/' . $konfigurasi->img_card2) }}" 
                             alt="Current Card 2" 
                             class="w-32 h-32 object-cover rounded-lg border">
                    </div>
                @endif
                <input type="file" name="img_card2" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2E4239]">
                <p class="text-xs text-gray-500 mt-1">Format: jpeg, png, jpg, gif | Max: 2MB</p>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Card 2</label>
                <input type="text" name="nama_card2" value="{{ old('nama_card2', $konfigurasi->nama_card2) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2E4239]"
                       required>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button type="submit" 
                        class="bg-[#2E4239] hover:bg-[#1a2a22] text-white px-6 py-2 rounded-lg transition duration-200">
                    Update Konfigurasi
                </button>
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection