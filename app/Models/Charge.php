<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charge extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'charges';

    protected $fillable = [
        'charge_name',
        'charge_fee',
        'frequency',
    ];


}
