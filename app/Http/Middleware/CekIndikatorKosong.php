<?php

namespace App\Http\Middleware;

use App\Models\Indikator;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekIndikatorKosong
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $ormawaId = optional($user->anggota->first())->ormawa_id;

        if(!$ormawaId){
            return redirect()->route('dashboard')->with('error', 'Anda belum terdaftar di ormawa manapun.');
        }

        $sudahIsi = Indikator::where('ormawa_id', $ormawaId)->exists();

        // LOGIKA: Jika BELUM isi, maka harus isi dulu.
        if (!$sudahIsi) {
            // Cek agar tidak redirect loop jika user memang sedang berada di halaman input
            if (!$request->routeIs('user.input.indikator')) {
                return redirect()->route('user.input.indikator')
                                ->with('info', 'Silakan isi Indikator Kinerja Utama terlebih dahulu.');
            }
        }

        return $next($request);
    }
}
