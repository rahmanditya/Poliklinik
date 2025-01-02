<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obats';

    protected $fillable = [
        'nama',
        'kemasan',
        'harga',
    ];

    public function periksas()
    {
        return $this->belongsToMany(Periksa::class, 'detail_periksa', 'obat_id', 'periksa_id');
    }
}
