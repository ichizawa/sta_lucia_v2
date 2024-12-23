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

    public function reading()
    {
        return $this->hasOne(UtilitiesReading::class, 'utility_id', 'utility_id')
            ->where('proposal_id', function ($query) {
                $query->select('lease_id')
                    ->from('utilities_selected')
                    ->whereColumn('lease_id', 'utilities_reading.proposal_id')
                    ->limit(1);
            });
    }
}