<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/** @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Debt> $debts */

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'user_phone_e164',
        'currency',
        'phone_verified_at'
    ];
    protected $hidden = [
        'remember_token',
        'created_at',
        'updated_at'
    ];


    public function debts()
    {
        return $this->hasMany(Debt::class, 'user_phone_e164', 'user_phone_e164');
    }

    public static function getUserFromPhone($phone = null)
    {
        return User::where('user_phone_e164', $phone)->first();
    }
}
