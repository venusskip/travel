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
    Schema::create('routes', function (Blueprint $table) {
        // Menggunakan uuid/string otomatis sesuai permintaanmu
        $table->id(); 
        $table->string('kota_asal');
        $table->string('kota_tujuan');
        $table->integer('jarak_km')->nullable();
        $table->string('estimasi_durasi')->nullable();
        $table->boolean('aktif')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
