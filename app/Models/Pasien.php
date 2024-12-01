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
        'address', // Assuming a unique identifier for patients
    ];

    public function polis()
    {
        return $this->hasMany(Poli::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email'); // Matches Pasien's email with User's email
    }
}
