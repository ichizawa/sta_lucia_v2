<?php

namespace App\Models\bill;

use App\Models\LeaseProposal;
use App\Models\UtilitiesReading;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'billing';

    public const PREPARED = 2;
    public const PAID = 1;
    public const FULLY_PAID = 3; 
    public const PENDING = 0;

    protected $fillable = [
        'proposal_id',
        'total_amount',
        'debit',
        'credit',
        'change',
        'billing_uid',
        'date_start',
        'date_end',
        // 'remarks',
        'is_prepared',
        'is_paid',
        'is_penal',
        'is_reading',
        'status',
    ];

    public function proposal()
    {
        return $this->belongsTo(LeaseProposal::class, 'proposal_id');
    }

    public function util_read()
    {
        return $this->hasMany(UtilitiesReading::class, 'proposal_id', 'proposal_id');
    }

    public function bill_details(){
        return $this->hasMany(BillingDetails::class, 'billing_id');
    }
}
