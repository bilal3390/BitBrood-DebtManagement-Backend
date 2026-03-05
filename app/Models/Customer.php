<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
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
