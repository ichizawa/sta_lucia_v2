<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceLevel extends Model
{
    use HasFactory;

    protected $table = 'level_numbers';

    protected $fillable = [
        'bldgnumid',
        'lvlnum',
        'lvlimage'
    ];

    public function building()
    {
        return $this->belongsTo(SpaceBuilding::class, 'id');
    }
}
