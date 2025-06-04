<?php

namespace App\Http\Controllers\client\news;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        return view('client.news.index');
    }
}
