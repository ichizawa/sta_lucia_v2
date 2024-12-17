<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilitiesModel extends Model
{
    use HasFactory;

    protected $table = 'utilities';

    protected $fillable = [
        'utility_name',
        'utility_type',
        'utility_description',
        'utility_price',
    ];

<<<<<<< HEAD
    public function selected()
    {
        return $this->belongsTo(UtilitiesSelected::class, 'utility_id');
=======
    public function scopeVisible($query)
    {
        return $query->where('status', 0);
>>>>>>> 8538d82c60b85f408d2661c6656da384e96b46ad
    }
}
