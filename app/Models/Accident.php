<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accident extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'site_id',
        'user_id',
        'category',
        'type',
        'description',
        'date',
        'image',
        'status',
    ];

    public function investigation()
{
    return $this->hasOne(Accident_Investigations::class, 'accident_id');
}

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

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

}
