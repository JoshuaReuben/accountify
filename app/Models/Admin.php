<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AdminEmailVerifyNotif;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    //To Add guard in your middleware
    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'role',
        'avatar',
        'password',
        'token',
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

    //Overriding the default method for the user verification email
    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new AdminEmailVerifyNotif($this->token, $this->id));
    // }

    //Include this method to check if the user has verified their email
    public function hasVerifiedEmail()
    {
        return $this->email_verified_at !== null;
    }

    //Method for creating tokens
    public function generateVerificationToken()
    {
        $this->token = Str::random(60); // Use Laravel's Str helper to generate a random string
        $this->save();
    }
}
