<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function clientIndex(){
        if(Auth::check()){
            $tenant = Auth::user();
            // $notifications = $tenant->notifications;
            return view('client.dashboard');
        }
        return redirect('auth.login');
    }

    public function clientCharges(){
        return view('client.charges');
    }
}
