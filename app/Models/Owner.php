<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
    protected $table = 'owner';

    protected $fillable = [
        "owner_fname",
        "owner_lname",
        "owner_position",
        "owner_homeaddress",
        "owner_email",
        "owner_telephone",
        "owner_officehrs",
        "owner_afterofficehrs",
        "owner_mobile"
    ];

    public function companies()
    {
        return $this->hasMany(Company::class, 'owner_id');
    }

    public function representatives()
    {
        return $this->hasMany(Representative::class, 'owner_id');
    }

    public function document()
    {
        return $this->hasMany(TenantDocuments::class, 'owner_id');
    }

}
