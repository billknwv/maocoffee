<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailReservasi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tabel_detail_reservasi';
    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_reservasi',
        'id_paket',
        'jumlah',
    ];

    // Relasi ke reservasi
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi');
    }

    // Relasi ke paket
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }
}