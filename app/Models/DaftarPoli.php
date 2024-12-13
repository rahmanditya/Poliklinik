<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class DaftarPoli extends Model
{
    protected $table = 'daftar_poli';

    protected $fillable = [
        'pasien_id',
        'schedule_id',
        'dokter_id',
        'keluhan',
        'no_antrian',
        'status'
    ];
    // DaftarPoli Model

    public static function generateQueueNumber($scheduleId, $dokterId)
    {
        // Get the latest queue number for the same doctor and schedule
        $lastQueue = self::where('schedule_id', $scheduleId)
            ->where('dokter_id', $dokterId)
            ->orderBy('no_antrian', 'desc')
            ->first();

        // If no records exist, start with 1
        return $lastQueue ? $lastQueue->no_antrian + 1 : 1;
    }


    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    // public function dokter(): BelongsTo
    // {
    //     return $this->belongsTo(Dokter::class);
    // }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function jadwalPeriksa(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
