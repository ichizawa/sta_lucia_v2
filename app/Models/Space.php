<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Space extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'space';
    protected $fillable = [
        "space_name",
        "space_area",
        "mall_code",
        "bldg_number",
        "unit_number",
        "level_number",
        "store_type",
        "property_code",
        "space_type",
        "location",
        "remarks",
        "space_img",
        "space_tag"

    ];

    public function leasableInfo()
    {
        return $this->hasMany(LeasableInfoModel::class, 'space_id');
    }

    public function utilities()
    {
        return $this->hasMany(SpaceUtility::class, 'space_id');
    }

    public function amenities(){
        return $this->hasMany(AmenitySelected::class, 'space_id');
    }
}
