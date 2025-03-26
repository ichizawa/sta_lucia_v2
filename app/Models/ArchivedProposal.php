<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArchivedProposal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'archived_proposals';
    protected $fillable = [
        'tenant_id',
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
        'is_counter',
        'status'
    ];
}
