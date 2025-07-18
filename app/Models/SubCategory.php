<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_category';

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
