<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paket extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tabel_paket';
    protected $primaryKey = 'id_paket';

    protected $fillable = [
        'nama_paket',
        'deeskripsi_menu',
        'harga_paket',
        'image_paket',
    ];

    // Relasi ke detail reservasi
    public function detailReservasis()
    {
        return $this->hasMany(DetailReservasi::class, 'id_paket');
    }

    // Accessor untuk format harga
    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga_paket, 0, ',', '.');
    }
}