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
}
