<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilitiesSelected extends Model
{
    use HasFactory;

    protected $table = 'utilities_selected';

    public function util_desc()
    {
        return $this->belongsTo(UtilitiesModel::class, 'utility_id');
    }

    public function utilities_reading()
    {
        return $this->belongsTo(UtilitiesReading::class, 'utility_id');
    }
}
