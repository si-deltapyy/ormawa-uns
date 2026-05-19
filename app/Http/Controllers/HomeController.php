<?php

namespace App\Http\Controllers;

use App\Models\Ormawa;
use App\Models\Proker;
use App\Models\RABModel;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

    public function home()
    {
        return view('dashboard');
    }

    public function welcome()
    {
        $ormawacount = Ormawa::count();
        $prokercount = Proker::count();

        return view('welcome', compact('ormawacount', 'prokercount'));
    }

    public function RoleSelect()
    {
        return view('auth.selectRole');
    }
}
