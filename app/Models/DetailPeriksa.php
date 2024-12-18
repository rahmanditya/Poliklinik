<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeriksa extends Model
{
    protected $table = 'detail_periksa';

    protected $fillable = [
        'periksa_id',
        'obat_id',
    ];

    public function periksa()
    {
        return $this->belongsTo(Periksa::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
