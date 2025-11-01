<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'user_id',
        'name',
        'type',
        'provider',
        'expired_date',
    ];

     protected $casts = [
        'expired_date' => 'date',
    ];

    public function site()
    {
        return $this->belongsTo(Sites::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }
}

