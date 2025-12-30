<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('donation_histories', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable()->after('nominal');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending')->after('bukti_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_histories', function (Blueprint $table) {
            $table->dropColumn(['bukti_pembayaran', 'status']);
        });
    }
};
