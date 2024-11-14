<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceBuilding extends Model
{
    use HasFactory;

    protected $table = 'building_numbers';

    protected $fillable = [
        'mallid',
        'bldgnum',
        'bldgimage'
    ];

    public function mallcodes()
    {
        return $this->belongsTo(SpaceMallCode::class, 'mallid');
    }

    public function levels()
    {
        return $this->hasMany(SpaceLevel::class, 'bldgnumid');
    }
}
