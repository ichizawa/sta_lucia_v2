<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contracts extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'contracts';

    protected $fillable = [
        'award_notice_id',
        'status'
    ];
}
