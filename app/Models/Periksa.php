<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    use HasFactory;

    protected $table = 'periksa';

    protected $fillable = [
        'daftar_poli_id',
        'dokter_id',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

    // Status constants
    public const STATUS_MENUNGGU = 'menunggu';
    public const STATUS_DALAM_ANTRIAN = 'dalam_antrian';
    public const STATUS_SELESAI = 'selesai';

    // Valid status transitions
    public static $validStatusTransitions = [
        self::STATUS_MENUNGGU => [self::STATUS_DALAM_ANTRIAN],
        self::STATUS_DALAM_ANTRIAN => [self::STATUS_SELESAI],
        self::STATUS_SELESAI => []
    ];

    // Function to check if a status transition is valid
    public function canTransitionTo($newStatus)
    {
        $currentStatus = $this->status;
        return in_array($newStatus, self::$validStatusTransitions[$currentStatus] ?? []);
    }
    
    // Relationships
    public function daftarPoli()
    {
        return $this->belongsTo(DaftarPoli::class, 'daftar_poli_id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function pasien()
    {
        return $this->hasOneThrough(Pasien::class, DaftarPoli::class, 'id', 'id', 'daftar_poli_id', 'pasien_id');
    }

    public function poli()
    {
        return $this->hasOneThrough(Poli::class, DaftarPoli::class, 'id', 'id', 'daftar_poli_id', 'specialization_id');
    }

    public function detailPeriksa()
    {
        return $this->hasMany(DetailPeriksa::class);
    }
}
