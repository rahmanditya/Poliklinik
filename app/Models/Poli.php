<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'polis';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'schedule_id',
        'poli',
        'keluhan',
        'status',
        'nomor_antrian',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
