<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiDetail extends Model
{
    use HasFactory;

    protected $table = 'donasi_detail';

    protected $fillable = [
        'order_id',
        'donasi_id',
        'user_id',
        'nama_donatur',
        'jumlah_donasi',
        'status_pembayaran',
        'snap_token',
        'payment_type',
        'payment_details'
    ];

    protected $casts = [
        'payment_details' => 'array',
    ];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
