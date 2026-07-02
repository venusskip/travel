<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Route extends Model
{
   
    protected $fillable = [
        'kota_asal',
        'kota_tujuan',
        'jarak_km',
        'estimasi_durasi',
        'aktif'
    ];

  public function travelSchedules()
{
    return $this->hasMany(TravelSchedule::class, 'id_rute');
}
  
}