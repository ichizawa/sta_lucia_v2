<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

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
}
