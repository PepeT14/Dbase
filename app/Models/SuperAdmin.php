<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as superAdminUser;
use Illuminate\Notifications\Notifiable;

class SuperAdmin extends superAdminUser
{
    //
    use Notifiable;

    protected $table = 'super_admins';

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $fillable = ['username', 'password'];
}
