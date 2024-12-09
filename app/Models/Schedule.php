<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function polis()
    {
        return $this->hasMany(Poli::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'specialization_id');
    }

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class);
    }
}
