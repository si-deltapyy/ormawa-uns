<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Spatie\Permission\Traits\HasRoles;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
        
        $user = auth()->user();

        // PERBAIKAN DISINI: Pastikan ada string nama role di dalam kurung
        if ($user->hasRole('super-admin') || $user->hasRole('admin')) {
            return redirect()->route('admin.index');
        } 
        
        else if ($user->hasRole('user')) {
            return redirect()->route('user.index');
        }
        
        // Jika tidak punya role
        return redirect()->route('user.index');
        } else {
            return redirect()->route('login')
                ->with('error', 'Email dan Password salah');
        }
    }
}