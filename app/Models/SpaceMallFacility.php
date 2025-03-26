<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpaceMallFacility extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'mall_facility';

    protected $fillable = [
        'mallid',
        'mallfacility'
    ];
}
