<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = [
        'user_id',
        'customer_id',
        'type',
        'total_amount',
        'note',
        'date',
        'due_date',
        'cheque_number',
        'source_other'
    ];
}
