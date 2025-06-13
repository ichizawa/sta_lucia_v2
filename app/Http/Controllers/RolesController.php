<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function adminRoles() {
        return view('admin.roles');
    }
}
