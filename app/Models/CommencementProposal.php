<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommencementProposal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'commencement_proposals';

    protected $fillable = [
        'proposal_id',
        'commencement_date',
    ];
}
