<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AwardNotice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'award_notice';

    protected $fillable = ['proposal_id', 'status'];

    public function proposal(){
        return $this->belongsTo(LeaseProposal::class, 'proposal_id');
    }
}
