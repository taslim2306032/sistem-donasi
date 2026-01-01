<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model untuk tabel donasi
class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';

    protected $fillable = [
        'judul_donasi',
        'deskripsi',
        'target_donasi',
        'tanggal_mulai',
        'tanggal_berakhir',
        'donasi_terkumpul',
        'status',
        'is_verified',
        'gambar',
        'created_by',
    ];
}
