<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'dokter_id',
        'hari',
        'start_time',
        'date',
        'end_time',
    ];


    public function poli()
    {
        return $this->belongsTo(Poli::class, 'specialization_id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }


    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'schedule_id');
    }
}
