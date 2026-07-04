<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            // Menggunakan UUID/String sesuai spesifikasi Anda atau id biasa yang dikonversi
            $table->uuid('id')->primary();
            
            // Relasi otomatis ke users (created_by_id)
            $table->foreignId('created_by_id')->constrained('users')->onDelete('cascade');
            
            // Relasi ke jadwal travel
            $table->unsignedBigInteger('id_jadwal'); 
            // Jika TravelSchedule menggunakan UUID, ganti menjadi: $table->uuid('id_jadwal');
            
            $table->string('nama_travel');
            $table->string('kota_asal');
            $table->string('kota_tujuan');
            $table->date('tanggal_berangkat');
            $table->string('jam_berangkat');
            $table->integer('jumlah_tiket');
            $table->json('kursi_dipilih'); // Menyimpan array nomor kursi
            $table->decimal('harga_per_tiket', 12, 2);
            $table->decimal('total_harga', 12, 2);
            $table->string('jenis_layanan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};