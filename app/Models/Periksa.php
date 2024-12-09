<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    protected $table = 'periksa';

    protected $fillable = [
        'specialization_id',
        'pasien_id',
        'dokter_id',
        'appointment_date',
        'status',
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function daftarPoli()
    {
        return $this->belongsTo(DaftarPoli::class);
    }
}
