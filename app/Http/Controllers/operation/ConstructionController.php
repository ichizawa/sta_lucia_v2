<?php

namespace App\Http\Controllers\operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConstructionController extends Controller
{
    public function index(){
        return view('operations.construction-release');
    }
}
