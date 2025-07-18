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

    protected $fillable = [
        'acc_id',
        'owner_id',
        'tenant_type',
        'company_name',
        'store_name',
        'company_address'
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
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

    public function proposals()
    {
        return $this->hasMany(LeaseProposal::class, 'tenant_id');
    }
}
