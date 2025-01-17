<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardNotice extends Model
{
    use HasFactory;

    protected $table = 'award_notice';

    protected $fillable = ['proposal_id', 'status'];

    public function proposal(){
        return $this->belongsTo(LeaseProposal::class, 'proposal_id');
    }
}
