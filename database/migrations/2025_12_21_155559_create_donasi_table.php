<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonasiTable extends Migration
{
    public function up(): void
    {
        Schema::create('donasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul_donasi');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->decimal('target_donasi', 10, 2);
            $table->decimal('donasi_terkumpul', 10, 2)->default(0);
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->enum('status', ['pending','active','completed','expired'])->default('pending');
            $table->boolean('is_verified')->default(false);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donasi');
    }
}
