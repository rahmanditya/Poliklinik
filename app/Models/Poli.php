<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'poli'; // Explicitly specify the table if not default
    protected $fillable = ['name'];

    public function poli()
    {
        return $this->hasMany(Poli::class);
    }

    public function dokters()
    {
        return $this->hasMany(Dokter::class, 'specialization_id');
    }

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'specialization_id');
    }

    public function periksa()
    {
        return $this->hasManyThrough(Periksa::class, DaftarPoli::class, 'specialization_id');
    }

}
