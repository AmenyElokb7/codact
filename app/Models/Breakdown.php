<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breakdown extends Model
{
    protected $fillable = [
        'reference',
        'message',
     ];
    use HasFactory;
}
