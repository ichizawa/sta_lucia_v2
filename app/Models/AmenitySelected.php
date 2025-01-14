<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmenitySelected extends Model
{
    use HasFactory;

    protected $table = 'amenity_selected';
    protected $fillable = [
        'amenity_id',
        'space_id'
    ];

    public function amenity(){
        return $this->belongsTo(Amenities::class, 'amenity_id', 'id');
    }
}
