<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Safety_Activities extends Model
{
    use HasFactory;

    protected $table = [
        'site_id',
        'user_id',
        'type',
        'date',
        'notes'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
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
