<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters';

    protected $fillable = [
        'user_id',  
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
        return $this->belongsTo(User::class);
    }

}
