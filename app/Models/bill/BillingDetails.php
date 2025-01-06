<?php

namespace App\Models\bill;

use Illuminate\Database\Eloquent\Model;

class BillingDetails extends Model
{
    protected $table = 'bill_details';

    protected $fillable = [
        'billing_id',
        'bill_no',
        'total_sales',
        'amount',
        'reference_num',
        'payment_option',
        'date_from',
        'date_to',
        'remarks',
        'status',
        'is_paid'
    ];
}
