<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ashtray extends Model
{
    protected $fillable = ['user_id', 'reference'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
