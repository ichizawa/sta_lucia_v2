<?php

namespace App\Http\Controllers\client\inbox;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index()
    {
        return view('client.inbox.index');
    }
}
