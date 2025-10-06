<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';

    protected $fillable = [
        'name',
        'category',
        'address',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}