<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmenitySelected extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'amenity_selected';
    protected $fillable = [
        'amenity_id',
        'space_id'
    ];

    public function amenity(){
        return $this->belongsTo(Amenities::class, 'amenity_id', 'id');
    }
}
