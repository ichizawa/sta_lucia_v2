<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilitiesModel extends Model
{
    use HasFactory;

    protected $table = 'utilities';

    protected $fillable = [
        'utility_name',
        'utility_type',
        'utility_description',
        'utility_price',
    ];
}
