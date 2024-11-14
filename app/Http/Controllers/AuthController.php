<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $validate = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $status = $user->type;
                $role = $user->status;
                // if ($user->type == \App\Models\User::ROLE_ADMIN) {
                //     // return redirect()->route('admin.dashboard');
                // } else {
                //     // return redirect()->route('client.dashboard');
                // }
            } else {
                $status = 'error';
                $role = "0";
            }
        }catch (ValidationException $e) {
            $error = $e->validator->errors()->first('email');
            $status = "email-error";
            $role = "0";
        }
        
        return response()->json(['status' => $status, 'role' => $role]);
    }

    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
