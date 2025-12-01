<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class menu extends Model
{
    use HasFactory;

    public $timestamps = false;

    // Nama tabel di database
    protected $table = 'menu';

    // Primary key
    protected $primaryKey = 'id_menu';

    // Field yang bisa diisi (mass assignable)
    protected $fillable = [
        'nama_menu',
        'deskripsi_menu',
        'harga',
        'stok',
        'kategori',
        'img_menu',
    ];

}
