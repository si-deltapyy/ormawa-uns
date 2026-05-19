<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\LogsAjuan;
use App\Models\Proker;
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

    public function assignProker($id)
    {
        try {
            $logs = new LogsAjuan();
            $logs->proker_id = $id;
            $logs->action = 'Prosess Review Pembina';
            $logs->description = 'Proker telah ditugaskan ke pembina untuk ditinjau.';
            $logs->status = 'Proses Pembina';
            $logs->updated_by = auth()->user()->id;
            $logs->save();

            Proker::where('id', $id)->update(['status_proker' => 'Proses Pembina']);
            toast()->success('Berhasil', 'Proker telah ditugaskan ke pembina untuk ditinjau.');
            return redirect()->back();

        } catch (\Exception $e) {
            toast()->error('Gagal', 'Proker tidak ditemukan.');
            return redirect()->back();
        }
    }
}
