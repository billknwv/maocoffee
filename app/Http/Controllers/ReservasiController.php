<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Paket;
use App\Models\DetailReservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReservasiController extends Controller
{
    /**
     * Menampilkan form reservasi public
     */
    public function create()
    {
        $pakets = Paket::all();
        return view('reservasi.create', compact('pakets'));
    }

    /**
     * Menyimpan reservasi baru dari public
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_reservasi' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'tgl_reservasi' => 'required|date|after:today',
            'jam_reservasi' => 'required|string',
            'catatan' => 'nullable|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pakets' => 'required|array|min:1',
            'pakets.*.id' => 'required|exists:tabel_paket,id_paket',
            'pakets.*.qty' => 'required|integer|min:1',
        ]);

        // Hitung total
        $total = 0;
        foreach ($request->pakets as $paketData) {
            $paket = Paket::find($paketData['id']);
            $total += $paket->harga_paket * $paketData['qty'];
        }

        // Upload bukti pembayaran
        $buktiPath = $request->file('bukti_pembayaran')->store('reservasi/bukti', 'public');

        // Simpan reservasi
        $reservasi = Reservasi::create([
            'nama_reservasi' => $request->nama_reservasi,
            'no_hp' => $request->no_hp,
            'tgl_reservasi' => $request->tgl_reservasi,
            'jam_reservasi' => $request->jam_reservasi,
            'total' => $total,
            'catatan' => $request->catatan,
            'status' => 'belum_verifikasi',
            'bukti_pembayaran' => $buktiPath,
        ]);

        // Simpan detail reservasi
        foreach ($request->pakets as $paketData) {
            DetailReservasi::create([
                'id_reservasi' => $reservasi->id_reservasi,
                'id_paket' => $paketData['id'],
                'jumlah' => $paketData['qty'],
            ]);
        }

        return redirect()->route('reservasi.success');
    }

    /**
     * Menampilkan halaman sukses
     */
    public function success()
    {
        return view('reservasi.success');
    }

    /**
     * Menampilkan daftar reservasi di dashboard
     */
    public function dashboardIndex(Request $request)
    {
        $status = $request->query('status', 'all');
        
        $query = Reservasi::with(['pakets']);
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $reservasis = $query->orderBy('id_reservasi', 'desc')->get();
        
        return view('dashboard.reservasi.index', compact('reservasis', 'status'));
    }

    /**
     * Menampilkan detail reservasi di dashboard
     */
    public function show($id)
    {
        $reservasi = Reservasi::with(['pakets'])->findOrFail($id);
        return view('dashboard.reservasi.show', compact('reservasi'));
    }

    /**
     * Update status reservasi di dashboard
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:terverifikasi,belum_verifikasi,ditolak'
        ]);

        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update([
            'status' => $request->status
        ]);

        return redirect()->route('dashboard.reservasi.show', $id)
            ->with('success', 'Status reservasi berhasil diupdate!');
    }
}