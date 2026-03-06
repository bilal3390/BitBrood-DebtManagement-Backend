<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_phone_e164',
        'customer_name',
        'customer_phone_e164',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_phone_e164', 'user_phone_e164');
    }
}
