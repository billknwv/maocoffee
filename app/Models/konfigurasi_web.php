<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class konfigurasi_web extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'konfigurasi_web';

    protected $primaryKey = 'id_konfigurasi';

    protected $fillable = [
        'logo_web',
        'img_card1',
        'nama_card1',
        'img_card2',
        'nama_card2',
    ];
}
