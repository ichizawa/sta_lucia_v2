<?php

namespace App\Models;

use App\Models\bill\Billing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaseProposal extends Model
{
    use HasFactory;

    protected $table = 'proposal';
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

    public function billing()
    {
        return $this->hasOne(Billing::class, 'proposal_id');
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'tenant_id', 'id');
    }

    public function representative()
    {
        return $this->belongsTo(Representative::class, 'tenant_id', 'owner_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'tenant_id', 'owner_id');
    }

    public function utilities()
    {
        return $this->hasMany(UtilitiesSelected::class, 'lease_id');
    }

    public function charges()
    {
        return $this->hasMany(ChargesSelected::class, 'lease_id');
    }

    public function selected_space()
    {
        return $this->hasMany(LeasableInfoModel::class, 'proposal_id', 'id');
    }

    public function commencement_proposal()
    {
        return $this->hasOne(CommencementProposal::class, 'proposal_id');
    }
}
