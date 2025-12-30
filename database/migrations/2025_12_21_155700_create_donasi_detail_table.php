<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonasiDetailTable extends Migration
{
    public function up(): void
    {
        Schema::create('donasi_detail', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->foreignId('donasi_id')->constrained('donasi')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->string('nama_donatur');
            $table->decimal('jumlah_donasi', 10, 2);
            $table->enum('status_pembayaran', ['pending','settlement','failed'])->default('pending');
            $table->string('snap_token')->nullable();
            $table->string('payment_type')->nullable();
            $table->json('payment_details')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi_detail');
    }
}
