<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = [
        'user_phone_e164',
        'customer_phone_e164',
        'type',
        'total_amount',
        'note',
        'date',
        'due_date',
        'source',
        'cheque_number',
        'source_other',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_phone_e164', 'user_phone_e164');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_phone_e164', 'customer_phone_e164');
    }
}
