<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservasi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tabel_reservasi';
    protected $primaryKey = 'id_reservasi';

    protected $fillable = [
        'nama_reservasi',
        'no_hp',
        'tgl_reservasi',
        'jam_reservasi',
        'total',
        'catatan',
        'status',
        'bukti_pembayaran',
    ];

    // Relasi ke detail reservasi
    public function details()
    {
        return $this->hasMany(DetailReservasi::class, 'id_reservasi');
    }

    // Relasi ke paket melalui detail
    public function pakets()
    {
        return $this->belongsToMany(Paket::class, 'tabel_detail_reservasi', 'id_reservasi', 'id_paket')
                    ->withPivot('jumlah');
    }

    // Accessor untuk status
    public function getStatusLabelAttribute()
    {
        $statuses = [
            'terverifikasi' => 'Terverifikasi',
            'belum_verifikasi' => 'Belum Verifikasi',
            'ditolak' => 'Ditolak'
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    // Accessor untuk format total
    public function getTotalFormattedAttribute()
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }
}