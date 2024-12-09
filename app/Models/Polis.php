<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polis extends Model
{
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'specialization_id');
    }
}
