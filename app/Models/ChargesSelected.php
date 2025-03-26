<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChargesSelected extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'extra_charges_selected';

    public function charge(){
        return $this->belongsTo(Charge::class, 'charge_id');
    }
}
