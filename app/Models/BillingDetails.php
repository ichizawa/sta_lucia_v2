<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetails extends Model
{
    use HasFactory;

    protected $table = 'bill_details';

    protected $fillable = [
        'billing_id',
        'bill_no',
        // 'total_sales',
        // 'brent',
        // 'total_brent',
        // 'mgr',
        // 'total_mgr',
        // 'amount_payable',
        // 'total_amount_payable',
        'date_from',
        'date_to',
        'remarks',
        'status'
    ];
}
