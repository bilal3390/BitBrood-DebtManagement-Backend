<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_phone_e164',
        'customer_name',
        'customer_phone_e164'
    ];
}
