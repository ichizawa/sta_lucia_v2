<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categories;
class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sub_category';

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
