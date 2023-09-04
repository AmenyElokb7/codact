<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'user_id',
        'video',
        'startdate',
        'enddate',
        'time',
        'period',
        'cost',
        'status',
        'pdf',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cafeOwners()
    {
        return $this->belongsToMany(User::class, 'advertisement_cafe_owner', 'advertisement_id', 'cafe_owner_id');
    }
}
