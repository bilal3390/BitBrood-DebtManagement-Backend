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
}
