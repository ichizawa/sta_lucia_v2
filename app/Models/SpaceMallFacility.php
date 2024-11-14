<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceMallFacility extends Model
{
    use HasFactory;

    protected $table = 'mall_facility';

    protected $fillable = [
        'mallid',
        'mallfacility'
    ];
}
