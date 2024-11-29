<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'polis';

    protected $fillable = [
        'name',
        'location',
        'description',
    ];

    // Relationships
    public function dokters()
    {
        return $this->hasMany(Dokter::class);
    }

    public function poliVisits()
    {
        return $this->hasMany(PoliVisit::class);
    }
}
