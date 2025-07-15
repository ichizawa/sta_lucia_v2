<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleType extends Model
{
    protected $table = 'role_type';

    protected $fillable = ['name', 'type']; // Columns you want mass assignable
}
