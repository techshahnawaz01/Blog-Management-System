<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;  

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;  
    // User has many blogs  
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Password ko hide rakhne ke liye
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    // User has many comments  
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
