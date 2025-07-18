<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sales';
    protected $fillable = [
        'total_sales',
        'tenant_name',
        'company_name',
        'sale_date',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class, 'owner_id');
    }

    public function owner()
    {
        return $this->hasMany(Owner::class, 'owner_id');
    }
}
