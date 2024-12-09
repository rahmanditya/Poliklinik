<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    protected $table = 'daftar_poli';
    
    protected $fillable = [
        'keluhan',
        'no_antrian',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'specialization_id'); // Use specialization_id as the foreign key
    }

    public function jadwal()
    {
        return $this->belongsTo(Schedule::class, 'date');
    }

    public function jadwalPeriksa()
    {
        return $this->belongsTo(Schedule::class, 'jadwal_periksa_id');
    }

    public function periksa()
    {
        return $this->hasMany(Periksa::class);
    }
}
