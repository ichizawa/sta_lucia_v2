<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargesSelected extends Model
{
    use HasFactory;

    protected $table = 'extra_charges_selected';

    public function charge(){
        return $this->belongsTo(Charge::class, 'charge_id');
    }
}
