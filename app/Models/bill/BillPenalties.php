<?php

namespace App\Models\bill;

use Illuminate\Database\Eloquent\Model;

class BillPenalties extends Model
{
    protected $table = 'bill_penalties';

    protected $fillable = [
        'bill_id',
        'remarks',
        'amount',
        'balance',
        'status',
        'date_created'
    ];
}
