<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'medical_record_number', // Assuming a unique identifier for patients
    ];

    // Relationships
    public function poliVisits()
    {
        return $this->hasMany(PoliVisit::class); // Assuming `poli_visits` tracks visits
    }
}
