<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterProposal extends Model
{
    use HasFactory;

    protected $table = 'counter_proposals';
    protected $fillable = [
        'proposal_id',
        'proposal_uid',
        'bussiness_nature',
        'discount',
        'brent',
        'total_rent',
        'min_mgr',
        'total_mgr',
        'lease_term',
        'commencement',
        'end_contract',
        'const_period',
        'rent_deposit',
        'sec_dep',
        'escalation_rate',
        'status'
    ];

    public function proposal()
    {
        return $this->belongsTo(LeaseProposal::class, 'proposal_id');
    }


}
