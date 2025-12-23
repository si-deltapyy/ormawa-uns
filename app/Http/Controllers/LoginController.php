<?php

namespace App\Http\Controllers;

use App\Models\Ormawa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginuser(Request $request)
    {
        if (Auth::attempt($request->only('name', 'password'))) {
            return redirect()->route('ormawa.form');
        }

        return redirect()->route('login');
    }


    public function register()
    {
        $ormawa = Ormawa::all();
        return view('auth.register', ['ormawa' => $ormawa]);
    }

    public function registeruser(Request $request)
    {
        User::create([
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'id_ormawa' => $request->input('ormawa'),
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}