<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessments extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'user_id',
        'type',
        'score',
        'date',
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
