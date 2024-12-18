<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'date',
        'dokter_id',
        'hari',
        'start_time',
        'end_time',
        'is_active',
        'notes'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function hasOverlap($startTime, $endTime, $hari, $excludeId = null)
    {
        $query = self::where('dokter_id', $this->dokterId)
            ->where('hari', $hari)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'specialization_id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'schedule_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
