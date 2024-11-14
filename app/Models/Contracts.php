<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    use HasFactory;

    protected $table = 'contracts';

    protected $fillable = [
        'award_notice_id',
        'status'
    ];
}
