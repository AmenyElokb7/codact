<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Role;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'phoneno',
        'cafeName',
        'cafeCategory',
        'minAge',
        'maxAge',
        'profession',
        'Opentime',
        'Closetime',
        'Besttime',
        'tablesno',
        'image',
        'password',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'cafeCategory');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'custom_user_role', 'user_id', 'role_id');
    }
    
public function hasRole($roleName)
{
    return $this->roles()->where('name', $roleName)->exists();
}


    public function advertisements()
{
    return $this->hasMany(Advertisement::class, 'user_id');
}
}
