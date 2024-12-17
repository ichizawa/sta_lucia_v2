<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilitiesSelected extends Model
{
    use HasFactory;

    protected $table = 'utilities_selected';

    protected $fillable = [
        'lease_id',
        'utility_id',
    ];

    public function util_desc()
    {
        return $this->belongsTo(UtilitiesModel::class, 'utility_id', 'id');
    }

    public function util_read()
    {
        return $this->hasOne(UtilitiesReading::class, 'utility_id', 'utility_id');
    }

    // public function reading()
    // {
    //     return $this->belongsTo(UtilitiesReading::class, 'lease_id', 'proposal_id');
    // }

    public function reading()
    {

        return $this->hasMany(UtilitiesReading::class, 'utility_id', 'utility_id');
    }


}
