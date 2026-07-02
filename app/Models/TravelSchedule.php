<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_rute',
        'nama_travel',
        'jenis_layanan',
        'kota_asal',
        'kota_tujuan',
        'tanggal_berangkat',
        'jam_berangkat',
        'harga',
        'total_kursi',
        'kursi_terisi',
        'kursi_terpesan',
        'foto_kendaraan',
        'deskripsi',
        'aktif'
    ];

    // Konversi otomatis data JSON dari DB menjadi array PHP biasa
    protected $casts = [
        'kursi_terpesan' => 'array',
        'aktif' => 'boolean',
        'tanggal_berangkat' => 'date'
    ];

    // Relasi balik ke model Route
    public function route()
    {
        return $this->belongsTo(Route::class, 'id_rute');
    }
}