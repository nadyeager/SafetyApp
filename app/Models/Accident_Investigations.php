<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accident_Investigations extends Model
{
    use HasFactory;

    protected $table = 'accident_investigations';

    protected $fillable = [
        'accident_id',
        'investigator',
        'root_cause',
        'corrective_action',
        'status',
    ];

    public function accident()
    {
        return $this->belongsTo(Accident::class, 'accident_id');
    }
}
