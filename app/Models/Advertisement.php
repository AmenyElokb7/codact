<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'cafe_owner_id',
        'user_id',
        'video',
        'startdate',
        'enddate',
        'time',
        'period',
        'cost',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cafeOwner()
    {
        return $this->belongsTo(User::class, 'cafe_owner_id');
    }
}

