<?php

namespace App\Http\Controllers;

use App\Models\IndikatorKinerja;
use App\Models\jenisKegiatan;
use App\Models\LogsAjuan;
use App\Models\Luaran;
use App\Models\Proker;
use App\Models\RABModel;
use App\Models\Skim;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    public function index()
    {
        return view('pages.reviewer.index');
    }

    public function reviewProker($id)
    {
        try {
            // Ambil data proker beserta relasinya (Ormawa & Mekanisme)
            $proker = Proker::with(['ormawa', 'mekanisme'])->findOrFail($id);

            // Ambil data Master untuk Dropdown (Sama seperti di function create/index)
            $skims = Skim::all();
            $jenisKegiatan = jenisKegiatan::all();
            $luaran = Luaran::all();
            $sasaran = [
                1 => 'Mahasiswa Internal', 
                2 => 'Mahasiswa dan Umum', 
                3 => 'Mahasiswa Internal dan Eksternal', 
                4 => 'Lainnya'
            ]; // Sesuaikan dengan data Anda

            return view('pages.admin.review.index', compact(
                'proker', 
                'skims', 
                'jenisKegiatan', 
                'luaran', 
                'sasaran'
            ));
            

        } catch (\Exception $e) {
            toast()->error('Error', 'Data tidak ditemukan.'. $e->getMessage());
            return redirect()->back();
        }
    }

   

    public function reviewRab($id)
    {
        $proker = Proker::with(['ormawa', 'mekanisme', 'rab'])->findOrFail($id);
        $idProker = $proker->id_ormawa;
        return view('pages.admin.review.rab', compact('proker', 'idProker'));
    }

    public function adminRABedit($id)
    {
        $proker = Proker::with(['ormawa', 'mekanisme', 'rab'])->findOrFail($id);
        $idProker = $proker->id_ormawa;
        return view('pages.admin.review.edit-rab', compact('proker', 'idProker'));
    }

    

    public function reviewTor($id)
    {
        try {
            // Ambil data proker beserta relasinya (Ormawa & Mekanisme)
            $proker = Proker::with(['ormawa', 'mekanisme'])->findOrFail($id);

            // Ambil data Master untuk Dropdown (Sama seperti di function create/index)
            $skims = Skim::all();
            $jenisKegiatan = JenisKegiatan::all();
            $indikator = IndikatorKinerja::all();
            $luaran = Luaran::all();
            $sasaran = [
                1 => 'Mahasiswa Internal', 
                2 => 'Mahasiswa dan Umum', 
                3 => 'Mahasiswa Internal dan Eksternal', 
                4 => 'Lainnya'
            ]; // Sesuaikan dengan data Anda

            return view('pages.admin.review.tor', compact(
                'proker', 
                'skims', 
                'jenisKegiatan', 
                'luaran', 
                'sasaran',
                'indikator'
            ));

        } catch (\Exception $e) {
            toast()->error('Error', 'Data tidak ditemukan.'. $e->getMessage());
            return redirect()->back();
        }
    }

     public function approveTor($id, Request $request)
    {
        try {
           
            $proker = Proker::findOrFail($id);
            $proker->status_proker = 'Disetujui';
            $proker->is_review = true;
            $proker->notes = $request->input('catatan');
            $proker->updated_at = now('Asia/Jakarta');
            
            $proker->save();

            $logs = new LogsAjuan();
            $logs->proker_id = $id;
            $logs->action = 'Proker Disetujui';
            $logs->description = 'Proker Telah Disetujui. Catatan: ' . $request->input('catatan');
            $logs->status = 'Disetujui';
            $logs->updated_by = auth()->user()->id;
            $logs->created_at = now('Asia/Jakarta');
            $logs->updated_at = now('Asia/Jakarta');
            $logs->save();

            toast()->success('Berhasil', 'Program kerja telah disetujui.');
            return redirect()->back();

        } catch (\Exception $e) {
            toast()->error('Gagal', 'Terjadi kesalahan sistem saat menyetujui program kerja.'. $e->getMessage());
            return redirect()->route('admin.review.proker');
        }
    }

    public function approveRab($id, Request $request)
    {
        try {
           
            $proker = Proker::findOrFail($id);
            $rab = RABModel::where('proker_id', $id)->first();
            if ($rab) {
                $rab->is_approved = true;
                $rab->update();
            }
            $proker->status_rab = 'Disetujui';
            $proker->notes = $request->input('catatan');
            $proker->updated_at = now('Asia/Jakarta');
            $proker->is_review_rab = true;
            
            $proker->save();

            $logs = new LogsAjuan();
            $logs->proker_id = $id;
            $logs->action = 'RAB Disetujui';
            $logs->description = 'RAB Telah Disetujui. Catatan: ' . $request->input('catatan');
            $logs->status = 'Disetujui';
            $logs->updated_by = auth()->user()->id;
            $logs->created_at = now('Asia/Jakarta');
            $logs->updated_at = now('Asia/Jakarta');
            $logs->save();

            toast()->success('Berhasil', 'RAB telah disetujui.');
            return redirect()->back();

        } catch (\Exception $e) {
            toast()->error('Gagal', 'Terjadi kesalahan sistem saat menyetujui Rprogram kerja.'. $e->getMessage());
            return redirect()->route('admin.review.proker');
        }
    }

    public function bypassApprove($id)
    {
        try {
            $rab = RABModel::where('proker_id', $id)->first();
            if ($rab) {
                $rab->is_approved = true;
                $rab->update();
            }

            $proker = Proker::findOrFail($id);
            $proker->status_rab = 'Disetujui';
            $proker->is_review_rab = true;
            $proker->notes = 'Proker disetujui tanpa RAB karena tidak memerlukan anggaran.';
            $proker->updated_at = now('Asia/Jakarta');
            
            $proker->update();

            $logs = new LogsAjuan();
            $logs->proker_id = $id;
            $logs->action = 'Proker Disetujui Tanpa RAB';
            $logs->description = 'Proker disetujui tanpa RAB karena tidak memerlukan anggaran.';
            $logs->status = 'Disetujui';
            $logs->updated_by = auth()->user()->id;
            $logs->created_at = now('Asia/Jakarta');
            $logs->updated_at = now('Asia/Jakarta');
            $logs->save();

            toast()->success('Berhasil', 'Program kerja telah disetujui tanpa RAB.');
            return redirect()->back();

        } catch (\Exception $e) {
            toast()->error('Gagal', 'Terjadi kesalahan sistem saat menyetujui program kerja.'. $e->getMessage());
            return redirect()->route('admin.review.proker');
        }
    }

    public function revisiTor(Request $request, $id)
    {
        $proker = Proker::find($id);

        $proker->notes = 'Reviewer TOR: ' . $request->input('catatan_tor');
        $proker->is_review = true;
        $proker->status_proker = 'revisi';

        $proker->update();

        $logs = new LogsAjuan();
        $logs->proker_id = $id;
        $logs->action = 'Permintaan Revisi Proker';
        $logs->description = 'Proker memerlukan revisi. Catatan: TOR' . $request->input('catatan_tor');
        $logs->status = 'Revisi';
        $logs->updated_by = auth()->user()->id;
        $logs->created_at = now('Asia/Jakarta');
        $logs->updated_at = now('Asia/Jakarta');
        $logs->save();

        toast()->info('Revisi Telah Dikirim','Proker telah direvisi dan dikembalikan ke ormawa untuk diperbaiki.');
        return redirect()->back();
    }

    public function revisiRab(Request $request, $id)
    {
        $proker = Proker::find($id);
        $rab = RABModel::where('proker_id', $id)->first();

        $rab->catatan = 'Reviewer RAB: ' . $request->input('catatan_rab');
        $rab->is_approved = false;
        $proker->is_review_rab = true;
        $proker->status_rab = 'Revisi';

        $proker->update();
        $rab->update();

        $logs = new LogsAjuan();
        $logs->proker_id = $id;
        $logs->action = 'Permintaan Revisi Proker';
        $logs->description = 'Proker memerlukan revisi. Catatan: RAB: ' . $request->input('catatan_rab');
        $logs->status = 'Revisi';
        $logs->updated_by = auth()->user()->id;
        $logs->created_at = now('Asia/Jakarta');
        $logs->updated_at = now('Asia/Jakarta');
        $logs->save();

        toast()->info('Revisi Telah Dikirim','Proker telah direvisi dan dikembalikan ke ormawa untuk diperbaiki.');
        return redirect()->back();
    }

    public function rejectTor(Request $request, $id)
    {
        $proker = Proker::find($id);

        $proker->is_review = true;
        $proker->notes = 'Reviewer TOR: ' . $request->input('catatan');
        $proker->status_proker = 'Ditolak';

        $proker->update();

        $logs = new LogsAjuan();
        $logs->proker_id = $id;
        $logs->action = 'Proker Ditolak';
        $logs->description = 'Proker telah ditolak. Catatan: ' . $request->input('catatan');
        $logs->status = 'Ditolak';
        $logs->updated_by = auth()->user()->id;
        $logs->created_at = now('Asia/Jakarta');
        $logs->updated_at = now('Asia/Jakarta');
        $logs->save();

        toast()->info('Proker Ditolak','Proker telah ditolak dan dikembalikan ke ormawa.');
        return redirect()->back();
    }

    public function rejectRab(Request $request, $id)
    {
        $proker = Proker::find($id);
        $rab = RABModel::where('proker_id', $id)->first();

        // $proker->notes = 'Reviewer: ' . $request->input('catatan');
        $rab->catatan = 'Reviewer RAB: ' . $request->input('catatan_rab');
        $rab->is_approved = false;
        $proker->is_review_rab = true;
        $proker->status_rab = 'Ditolak';

        $proker->update();
        $rab->update();

        $logs = new LogsAjuan();
        $logs->proker_id = $id;
        $logs->action = 'RAB Ditolak';
        $logs->description = 'RAB telah ditolak. Catatan: ' . $request->input('catatan');
        $logs->status = 'Ditolak';
        $logs->updated_by = auth()->user()->id;
        $logs->created_at = now('Asia/Jakarta');
        $logs->updated_at = now('Asia/Jakarta');
        $logs->save();

        toast()->info('RAB Ditolak','RAB telah ditolak dan dikembalikan ke ormawa.');
        return redirect()->back();
    }
}
