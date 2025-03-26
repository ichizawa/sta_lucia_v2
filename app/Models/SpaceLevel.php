<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpaceLevel extends Model
{
    use HasFactory;
    use SoftDeletes;

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
