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
        Schema::create('rekening_karyawans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id'); // ID karyawan
            $table->string('bank_name'); // Nama bank
            $table->string('rekening_number')->unique(); // Nomor rekening
            $table->string('pemilik_rekening'); // Nama pemilik rekening
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekening_karyawans');
    }
};
