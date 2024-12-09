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

    // Relationships
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
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
}
