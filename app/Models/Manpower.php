<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manpower extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'type',
        'gender',
        'total',
        'month',
        'year',
    ];


    public function site()
    {
        return $this->belongsTo(Sites::class);
    }

}
