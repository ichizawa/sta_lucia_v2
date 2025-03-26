<?php

namespace App\Models;

use App\Models\bill\Billing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UtilitiesReading extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "utilities_reading";

    protected $fillable = [
        'bill_id',
        'proposal_id',
        'utility_id',
        'present_reading',
        'previous_reading',
        'present_reading_date',
        'previous_reading_date',
        'consumption',
        'utility_price',
        'total_reading',
        'date_reading',
        'prepare'
    ];
}
