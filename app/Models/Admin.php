<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;



class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    //To Add guard in your middleware
    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'provider_id_google',
        'provider_id_facebook',
        'provider_token',
        'email_verified_at',
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

    public function hasVerifiedEmail()
    {
        return $this->email_verified_at !== null;
    }
}
