<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class PembinaController extends Controller
{
    public function index()
    {
        return view('pages.pembina.home');
    }

    public function verifyAnggota($id)
    {
        Anggota::where('id', $id)->update(['status' => 'Aktif']);
        toast()->success('Berhasil', 'Anggota telah diverifikasi dan diaktifkan.');
         return redirect()->back();
    }

    public function rejectAnggota($id)
    {
        Anggota::where('id', $id)->update(['status' => 'Tidak Aktif']);
        toast()->success('Berhasil', 'Anggota telah ditolak dan dinonaktifkan.');
         return redirect()->back();
    }

    public function deactivateAnggota($id)
    {
        Anggota::where('id', $id)->update(['status' => 'Tidak Aktif']);
        toast()->success('Berhasil', 'Anggota telah dinonaktifkan.');

        return redirect()->back();
    }
}
