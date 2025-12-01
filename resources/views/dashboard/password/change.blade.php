@extends('layouts.dashboard')

@section('page-title', 'Ubah Password')

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Ubah Password</h2>
            <p class="text-gray-600 mt-1">Pastikan password Anda kuat dan mudah diingat</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('dashboard.password.update') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <!-- Password Lama -->
                <div class="flex flex-col md:flex-row md:items-start gap-4 md:gap-6">
                    <label class="block text-gray-700 text-sm font-bold pt-2 w-full md:w-48">Password Lama *</label>
                    <div class="flex-1">
                        <input type="password" name="current_password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239] @error('current_password') border-red-500 @enderror"
                               placeholder="Masukkan password lama" required>
                        @error('current_password')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Password Baru -->
                <div class="flex flex-col md:flex-row md:items-start gap-4 md:gap-6">
                    <label class="block text-gray-700 text-sm font-bold pt-2 w-full md:w-48">Password Baru *</label>
                    <div class="flex-1">
                        <input type="password" name="new_password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239] @error('new_password') border-red-500 @enderror"
                               placeholder="Masukkan password baru" required>
                        @error('new_password')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter</p>
                    </div>
                </div>

                <!-- Konfirmasi Password Baru -->
                <div class="flex flex-col md:flex-row md:items-start gap-4 md:gap-6">
                    <label class="block text-gray-700 text-sm font-bold pt-2 w-full md:w-48">Konfirmasi Password Baru *</label>
                    <div class="flex-1">
                        <input type="password" name="confirm_password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239] @error('confirm_password') border-red-500 @enderror"
                               placeholder="Konfirmasi password baru" required>
                        @error('confirm_password')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Info Keamanan -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h3 class="text-sm font-semibold text-blue-800 mb-2">Tips Password Aman:</h3>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• Gunakan minimal 6 karakter</li>
                        <li>• Kombinasikan huruf dan angka</li>
                        <li>• Hindari menggunakan informasi pribadi</li>
                        <li>• Jangan gunakan password yang sama dengan akun lain</li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="submit" 
                            class="bg-[#2E4239] hover:bg-[#1a2a22] text-white px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2 order-2 sm:order-1">
                        <i class="fas fa-key"></i>
                        Ubah Password
                    </button>
                    <a href="{{ route('dashboard') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2 order-1 sm:order-2">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection