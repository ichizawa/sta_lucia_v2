<?php

namespace App\Models\bill;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillPenalties extends Model
{

    use SoftDeletes;
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
