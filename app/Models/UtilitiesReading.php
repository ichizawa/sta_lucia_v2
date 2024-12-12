<?php

namespace App\Models;

use App\Models\bill\Billing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilitiesReading extends Model
{
    use HasFactory;

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
