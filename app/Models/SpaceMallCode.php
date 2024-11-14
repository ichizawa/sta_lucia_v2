<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceMallCode extends Model
{
    use HasFactory;

    protected $table = 'mall_codes';

    protected $fillable = [
        'mallnum',
        'mallname',
        'malladdress',
        'mallimage',
        'mallfacility',
        'total_area',
        'total_available',
        'total_leased'
    ];

    public function buildingcodes()
    {
        return $this->hasMany(SpaceBuilding::class, 'id');
    }
}
