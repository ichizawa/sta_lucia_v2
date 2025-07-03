<?php

namespace App\Models\bill;

use Illuminate\Database\Eloquent\Model;

class BillingDetails extends Model
{
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
        'reference_num',
        'payment_option',
        'encoded_bank',
        'date_checked',
        'dep_check_num',
        'date_to',
        'remarks',
        'status',
        'is_paid'
    ];
}
