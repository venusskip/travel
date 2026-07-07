<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    // Menggunakan string primary key non-incrementing
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'created_by_id', 'id_jadwal', 'kode_pemesanan', 'nama_travel',
        'kota_asal', 'kota_tujuan', 'tanggal_berangkat', 'jam_berangkat',
        'jumlah_tiket', 'kursi_dipilih', 'harga_per_tiket', 'total_harga',
        'nama_penumpang', 'telepon_penumpang', 'email_penumpang',
        'alamat_penumpang', 'metode_pembayaran', 'status', 'jenis_layanan','is_checked_in'
    ];

    protected $casts = [
        'kursi_dipilih' => 'array', // Otomatis konversi array ke database
        'tanggal_berangkat' => 'date'
    ];

    // Otomatis isi ID dan Kode Pemesanan saat membuat data baru
    protected static function booted()
    {
        static::creating(function ($booking) {
            $booking->id = (string) Str::uuid();
            $booking->kode_pemesanan = 'TRV' . strtoupper(Str::random(10));
        });
    }

    // Relasi ke User (Aturan Relasi Tugas Besar)
    public function user()
    {
        return $table->belongsTo(User::class, 'created_by_id');
    }
}