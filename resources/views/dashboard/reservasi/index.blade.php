@extends('layouts.dashboard')

@section('page-title', 'Manajemen Reservasi')

@section('dashboard-content')
<div class="p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Header dengan Filter -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Manajemen Reservasi</h2>
                <p class="text-gray-600">Kelola reservasi pelanggan</p>
            </div>
            
            <!-- Filter Status -->
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <select id="filterStatus" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239]">
                    <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="belum_verifikasi" {{ $status == 'belum_verifikasi' ? 'selected' : '' }}>Belum Verifikasi</option>
                    <option value="terverifikasi" {{ $status == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Reservasi -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">No HP</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tanggal & Jam</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Paket & Qty</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Catatan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Total</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($reservasis as $reservasi)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <span class="text-sm text-gray-600">#{{ $reservasi->id_reservasi }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-800">{{ $reservasi->nama_reservasi }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-sm text-gray-600">{{ $reservasi->no_hp }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-sm text-gray-800">{{ \Carbon\Carbon::parse($reservasi->tgl_reservasi)->format('d/m/Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $reservasi->jam_reservasi }}</p>
                        </td>
                        <td class="px-4 py-3">
                            @foreach($reservasi->pakets as $paket)
                                <div class="text-sm">
                                    <span class="font-medium">{{ $paket->nama_paket }}</span>
                                    <span class="text-gray-500">(x{{ $paket->pivot->jumlah }})</span>
                                </div>
                            @endforeach
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-sm text-gray-600">{{ Str::limit($reservasi->catatan, 50) ?: '-' }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-gray-800 font-medium">{{ $reservasi->total_formatted }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $reservasi->status == 'terverifikasi' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $reservasi->status == 'belum_verifikasi' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $reservasi->status == 'ditolak' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ $reservasi->status_label }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('dashboard.reservasi.show', $reservasi->id_reservasi) }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition duration-200">
                                <i class="fas fa-eye mr-1"></i> Lihat
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-calendar-alt text-4xl mb-2 block"></i>
                            Tidak ada reservasi yang ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Filter status
    document.getElementById('filterStatus').addEventListener('change', function() {
        const status = this.value;
        window.location.href = `{{ route('dashboard.reservasi.index') }}?status=${status}`;
    });
</script>
@endsection