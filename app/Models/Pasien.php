<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';

    protected $fillable = [
        'medical_record_number',
        'name',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'password',
        
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email'); // Matches Pasien's email with User's email
    }

    public function periksa()
    {
        return $this->hasMany(Periksa::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'specialization_id');
    }

    public function specialization()
    {
        return $this->belongsTo(Poli::class, 'specialization_id');
    }

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'pasien_id');
    }
}
