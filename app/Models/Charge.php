<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $table = 'charges';

    protected $fillable = [
        'charge_name',
        'charge_fee',
        'frequency',
    ];

    public function scopeVisible($query)
    {
        return $query->where('status', 0);
    }
}
