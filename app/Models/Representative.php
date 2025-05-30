<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Representative extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "representative";

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function companies()
    {
        return $this->belongsTo(Company::class, 'owner_id');
    }
}
