<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\SubCategory;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company';

    public function owner()
    {
        return $this->belongsTo(Owner::Class, 'owner_id');
    }

    public function representatives()
    {
        return $this->hasMany(Representative::class, 'owner_id');
    }


    public function category()
    {
        return $this->belongsTo(Categories::class, 'company_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'company_id');
    }
}
