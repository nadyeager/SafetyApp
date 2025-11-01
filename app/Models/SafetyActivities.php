<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyActivities extends Model
{
    use HasFactory;

    // pastikan ini adalah nama tabel di DB
    protected $table = 'safety_activities';

    protected $fillable = [
        'site_id',
        'user_id',
        'type',
        'frequency',
        'date',
        'notes',
        'file',
    ];

     protected $casts = [
        'date' => 'date',
    ];

    public function site()
    {
        return $this->belongsTo(Sites::class, 'site_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
