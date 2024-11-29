<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliVisit extends Model
{
    use HasFactory;

    protected $table = 'poli_visits';

    protected $fillable = [
        'pasien_id',
        'poli_id',
        'dokter_id',
        'schedule_date',
        'complaint',
        'status',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
