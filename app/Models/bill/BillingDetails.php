<?php

namespace App\Models\bill;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillingDetails extends Model
{

    use SoftDeletes;
    protected $table = 'bill_details';

    protected $fillable = [
        'billing_id',
        // 'contract_id',
        'bill_no',
        'transaction_id',
        // 'total_sales',
        'debit',
        'credit',
        'change',
        // 'reference_num',
        // 'payment_option',
        // 'date_from',
        'date_to',
        'remarks',
        'status',
        'is_paid'
    ];
}
