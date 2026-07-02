<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            // Menggunakan uuid atau string sesuai permintaan skema kamu
            $table->string('id')->primary(); 
            
            // Relasi (Foreign Key)
            $table->foreignId('created_by_id')->constrained('users')->onDelete('cascade');
            $table->string('id_jadwal'); // Hubungan ke tabel TravelSchedule
            
            // Detail Tiket & Perjalanan
            $table->string('kode_pemesanan')->unique();
            $table->string('nama_travel');
            $table->string('kota_asal');
            $table->string('kota_tujuan');
            $table->date('tanggal_berangkat');
            $table->string('jam_berangkat');
            $table->integer('jumlah_tiket');
            $table->text('kursi_dipilih')->nullable(); // Disimpan sebagai teks/JSON casting
            $table->integer('harga_per_tiket');
            $table->integer('total_harga');
            
            // Data Penumpang
            $table->string('nama_penumpang');
            $table->string('telepon_penumpang');
            $table->string('email_penumpang');
            $table->text('alamat_penumpang')->nullable();
            
            // Sistem Status & Pembayaran
            $table->string('metode_pembayaran');
            $table->string('status')->default('Menunggu Pembayaran');
            $table->string('jenis_layanan')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};