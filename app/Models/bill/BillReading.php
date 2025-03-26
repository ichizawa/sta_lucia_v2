<?php

namespace App\Models\bill;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillReading extends Model
{

    use SoftDeletes;
    protected $table = 'bill_reading';

    protected $fillable = [
        'reading_id',
        'bill_id',
        'utility_id',
        'present_reading',
        'previous_reading',
        'present_reading_date',
        'previous_reading_date',
        'consumption',
        'utility_price',
        'total_reading',
        'date_reading',
        'status',
    ];
}
