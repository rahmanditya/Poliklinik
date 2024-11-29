<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    // Table associated with the model (if using custom table names)
    protected $table = 'dokters';

    // Fields that can be mass-assigned
    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization',
    ];

    // Relationships
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'poli_id'); // Assuming a foreign key `poli_id` in `dokters` table
    }
}
