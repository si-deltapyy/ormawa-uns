<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::with('user')
        ->whereNotIn('user_id', [auth()->id()])
        ->where('ormawa_id', auth()->user()->anggota->ormawa_id)
        ->get();
        
        return view('pages.anggota.index', compact('anggota'));
    }
}
