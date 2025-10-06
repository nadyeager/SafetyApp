<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manhours extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'type',
        'total_hours',
        'month',
        'year'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
