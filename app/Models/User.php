<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;   // 👈 ADD THIS

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;  // 👈 ADD HasApiTokens

    protected $fillable = [
        'name',
        'email',
        'password',
        'department',   // 👈 add if using
        'year',         // 👈 add if using
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}