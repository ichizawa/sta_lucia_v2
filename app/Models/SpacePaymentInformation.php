<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpacePaymentInformation extends Model
{
    use HasFactory;

    protected $table = 'space_payment';

    protected $fillable = [
        'proposal_id',
        'charge_name',
        'charge_value',
        'charge_frequency',
        'created_at',
        'updated_at'
    ];

    public function proposal()
    {
        return $this->belongsTo( LeaseProposal::class, 'proposal_id');
    }
}
