<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->hasRole('user')) {
            return $next($request);
        }

        toast()->error('Access Denied', 'Akses terbatas hanya untuk user');
        
        // 2. Lakukan Redirect kembali
        return back();
    }
}
