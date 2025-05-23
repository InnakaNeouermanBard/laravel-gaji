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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id'); // ID karyawan
            $table->decimal('jumlah_gaji', 15, 2); // Jumlah gaji
            $table->enum('status_pembayaran', ['pending', 'success', 'failed'])->default('pending'); // Status pembayaran
            $table->string('bukti_pembayaran')->nullable(); // Bukti pembayaran (gambar)
            $table->timestamps();

            // Menambahkan foreign key
            $table->foreign('karyawan_id')->references('id_karyawan')->on('karyawans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
