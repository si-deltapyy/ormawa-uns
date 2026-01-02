<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->hasRole('admin')) {
            return $next($request);
        }

        // PERBAIKAN: Pisahkan Toast dan Return Back
        
        // 1. Set notifikasi Toast
        toast()->error('Access Denied', 'Akses terbatas hanya untuk admin');
        
        // 2. Lakukan Redirect kembali
        return back(); 
    }
}