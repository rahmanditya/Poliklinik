<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'poli';
    
    protected $fillable = ['name'];

    public function dokters()
    {
        return $this->hasMany(Dokter::class, 'specialization_id'); // Use specialization_id as the foreign key
    }

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'dokter_id');
    }

    public function periksa()
    {
        return $this->hasMany(Periksa::class);
    }
}
