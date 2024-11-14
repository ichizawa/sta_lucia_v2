<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommencementProposal extends Model
{
    use HasFactory;

    protected $table = 'commencement_proposals';

    protected $fillable = [
        'proposal_id',
        'commencement_date',
    ];
}
