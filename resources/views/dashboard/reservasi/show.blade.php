@extends('layouts.dashboard')

@section('page-title', 'Detail Reservasi')

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6 max-w-4xl mx-auto">
        <!-- Header dengan Tombol Kembali -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('dashboard.reservasi.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
            <h2 class="text-2xl font-semibold text-gray-800">Detail Reservasi #{{ $reservasi->id_reservasi }}</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Informasi Reservasi -->
            <div class="space-y-6">
                <div class="border-b border-gray-200 pb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pelanggan</h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama:</span>
                            <span class="font-medium text-gray-800">{{ $reservasi->nama_reservasi }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">No HP:</span>
                            <span class="font-medium text-gray-800">{{ $reservasi->no_hp }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal:</span>
                            <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($reservasi->tgl_reservasi)->format('d F Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jam:</span>
                            <span class="font-medium text-gray-800">{{ $reservasi->jam_reservasi }}</span>
                        </div>
                    </div>
                </div>

                <!-- Detail Paket -->
                <div class="border-b border-gray-200 pb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Pesanan</h3>
                    
                    <div class="space-y-3">
                        @foreach($reservasi->pakets as $paket)
                        <div class="bg-gray-50 rounded-lg p-3">
                            <div class="flex justify-between items-start mb-2">
                                <span class="font-medium text-gray-800">{{ $paket->nama_paket }}</span>
                                <span class="text-sm text-gray-600">x{{ $paket->pivot->jumlah }}</span>
                            </div>
                            <p class="text-sm text-gray-600">{{ $paket->deeskripsi_menu }}</p>
                            <p class="text-sm font-medium text-gray-800 mt-1">{{ $paket->harga_formatted }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Catatan -->
                @if($reservasi->catatan)
                <div class="border-b border-gray-200 pb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Catatan</h3>
                    <p class="text-gray-600 bg-gray-50 rounded-lg p-3">{{ $reservasi->catatan }}</p>
                </div>
                @endif

                <!-- Total -->
                <div>
                    <div class="flex justify-between items-center bg-[#2E4239] text-white rounded-lg p-4">
                        <span class="text-lg font-semibold">Total</span>
                        <span class="text-xl font-bold">{{ $reservasi->total_formatted }}</span>
                    </div>
                </div>
            </div>

            <!-- Bukti Pembayaran & Status -->
            <div class="space-y-6">
                <!-- Status Reservasi -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Reservasi</h3>
                    
                    <div class="text-center mb-4">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-medium 
                            {{ $reservasi->status == 'terverifikasi' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $reservasi->status == 'belum_verifikasi' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $reservasi->status == 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ $reservasi->status_label }}
                        </span>
                    </div>

                    <!-- Form Update Status -->
                    @if($reservasi->status == 'belum_verifikasi')
                    <form action="{{ route('dashboard.reservasi.updateStatus', $reservasi->id_reservasi) }}" method="POST" class="space-y-3">
                        @csrf
                        <div class="flex gap-2">
                            <button type="submit" name="status" value="terverifikasi" 
                                    class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                                <i class="fas fa-check"></i>
                                Terima
                            </button>
                            <button type="submit" name="status" value="ditolak" 
                                    class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                                <i class="fas fa-times"></i>
                                Tolak
                            </button>
                        </div>
                    </form>
                    @endif
                </div>

                <!-- Bukti Pembayaran -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Bukti Pembayaran</h3>
                    
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" 
                             alt="Bukti Pembayaran" 
                             class="max-w-full h-64 object-contain mx-auto rounded-lg border border-gray-200">
                        
                        <a href="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" 
                           target="_blank" 
                           class="inline-block mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            <i class="fas fa-expand mr-2"></i>Lihat Full Size
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection