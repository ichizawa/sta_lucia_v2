<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillingLedger extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'bill_ledger';

    protected $fillable = [
        // 'tenant_id',
        // 'proposal_id',
        // 'billing_id',
        // 'bill_no',
        // 'total_sales',
        // 'brent',
        // 'total_brent',
        // 'mgr',
        // 'total_mgr',
        // 'amount_payable',
        // 'total_amount_payable',
        // 'date_from',
        // 'date_to',
        // 'remarks'
        'billing_id',
        'bill_no',
        'total_sales',
        'amount',
        'date_from',
        'date_to',
        'remarks',
        'status',
        'is_paid'
    ];
}
