<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PasswordReset extends Model

{
    protected $fillable = [
        'user_id',
        'email',
        'phone',
        'key',
        'link',
        'created_at',
    ];
    

    // Rest of the model code...

    protected $table = 'password_resets';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

}