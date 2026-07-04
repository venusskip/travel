<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CartItem extends Model
{
    // Menggunakan UUID otomatis saat pembuatan data baru
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'created_by_id', 'id_jadwal', 'nama_travel', 'kota_asal', 
        'kota_tujuan', 'tanggal_berangkat', 'jam_berangkat', 
        'jumlah_tiket', 'kursi_dipilih', 'harga_per_tiket', 'total_harga', 'jenis_layanan'
    ];

    protected $casts = [
        'kursi_dipilih' => 'array', // Otomatis merubah array php ke json dan sebaliknya
        'tanggal_berangkat' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}