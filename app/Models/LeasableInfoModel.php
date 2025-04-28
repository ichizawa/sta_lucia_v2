<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeasableInfoModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $table = "leasable_space";

    protected $fillable = [
        'space_id',
        'owner_id',
        'proposal_id',
        'status'
    ];

    public function space()
    {
        return $this->belongsTo(Space::class, 'space_id');
    }
}
