<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceUtility extends Model
{
    use HasFactory;

    protected $table = 'space_utilities';
    protected $fillable = [
        'space_id',
        'utility',
        'utility_fee',
        'created_at',
        'updated_at'
    ];

    public function proposal()
    {
        return $this->belongsTo(LeaseProposal::class, 'proposal_id');
    }
}
