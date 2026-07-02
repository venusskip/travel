<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('travel_schedules', function (Blueprint $table) {
            // Kita gunakan id string/uuid atau auto-increment. 
            // Agar mudah berelasi, kita gunakan id standar laravel namun bertipe string otomatis jika menggunakan UUID, 
            // atau jika ingin string kustom/increment standard:
            $table->id(); 
            
            // Relasi ke tabel routes (Foreign Key) sesuai aturan 3.1 & 3.2
            // Pastikan tabel 'routes' sudah dibuat sebelumnya
            $table->foreignId('id_rute')->constrained('routes')->onDelete('cascade');
            
            $table->string('nama_travel');
            $table->string('jenis_layanan');
            $table->string('kota_asal');
            $table->string('kota_tujuan');
            $table->date('tanggal_berangkat');
            $table->string('jam_berangkat');
            $table->integer('harga');
            $table->integer('total_kursi');
            $table->integer('kursi_terisi')->default(0); // Pendekatan lebih mudah untuk hitung kursi sisa
            $table->json('kursi_terpesan')->nullable(); // Untuk menyimpan array nomor kursi dalam bentuk JSON di MySQL
            $table->string('foto_kendaraan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('travel_schedules');
    }
};