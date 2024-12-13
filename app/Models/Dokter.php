<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization_id',
        'status',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'dokter_id');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'specialization_id');
    }

    public function specialization()
    {
        return $this->belongsTo(Poli::class, 'specialization_id');
    }

    public function periksa()
    {
        return $this->hasMany(Periksa::class);
    }
    
    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email'); // Matches Pasien's email with User's email
    }

}
