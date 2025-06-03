<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenities extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'amenities';
    protected $fillable = [
        'amenity_name', 
        'amenity_status'
    ];
}
