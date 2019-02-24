<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    //
    use HasApiTokens, Notifiable;

    protected $table = 'admins';
    protected $fillable=['name','email','password'];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
