<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'donasi_id',
        'nominal',
        'bukti_pembayaran',
        'status',
        'pesan',
    ];

    // RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI KE DONASI
    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }
}
