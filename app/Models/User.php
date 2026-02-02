<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'phone_e164',
        'currency',
        'phone_verified_at'
    ];

    protected $hidden = [
        'remember_token',
        'created_at',
        'updated_at'
    ];
}
