<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UtilitiesModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'utilities';

    protected $fillable = [
        'utility_name',
        'utility_type',
        'utility_description',
        'utility_price',
    ];

    public function selected()
    {
        return $this->belongsTo(UtilitiesSelected::class, 'utility_id');
    }
}
