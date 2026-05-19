<?php

namespace App\Http\Controllers;

use App\Models\Skim;
use App\Models\Asset;
use App\Models\Ormawa;
use App\Models\Proker;
use App\Models\TargetSkim;
use App\Models\TargetProker;
use Illuminate\Http\Request;
use App\Http\Middleware\Admin;
use App\Models\Anggota;
use App\Models\Indikator;
use App\Models\IndikatorKinerja;
use App\Models\LogsAjuan;
use App\Models\Mahasiswa;
use App\Models\RABModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\Attributes\IgnoreFunctionForCodeCoverage;

use function Symfony\Component\String\s;

class AdminController extends Controller
{
    public function index()
    {
        $indikator = Indikator::all();
        $jumlahProker = Proker::all();
        
        $dataproker = Proker::with('ormawa')->latest()->take(5)->get();
        $statsSkim = Skim::withCount('prokers')->get();
        
        $rabSum = RABModel::sum('total_biaya');
        $rabAcc = RABModel::whereHas('proker', function($query) {
            $query->where('status_rab', 'Disetujui');
        })->sum('total_biaya');

        $labelsSkim = $statsSkim->pluck('nama_skim')->toArray();
        $dataSkim = $statsSkim->pluck('prokers_count')->toArray() ;

        return view('pages.dashboard.admin', compact(
            'jumlahProker', 
            'dataproker', 
            'labelsSkim', 
            'dataSkim',
            'indikator',
            'rabSum',
            'rabAcc'
        ));
    }

    public function review()
    {
        $ormawa = Ormawa::withCount('prokers')->get();
        return view('pages.admin.review.index', compact('ormawa'));
    }

    public function listProker($id)
    {
        $ormawa = Ormawa::find($id);
        $proker = Proker::where('id_ormawa', $id)->with('indikator', 'rab')->get();
        return view('pages.admin.review.list-proker', compact('ormawa', 'proker'));
    }

    public function listRab($id)
    {
        $ormawa = Ormawa::find($id);
        $proker = Proker::where('id_ormawa', $id)->with('indikator', 'rab')->get();
        return view('pages.admin.review.list-rab', compact('ormawa', 'proker'));
    }

    public function revisi(Request $request, $id)
    {
        $proker = Proker::find($id);
        $rab = RABModel::where('proker_id', $id)->first();

        $proker->notes = 'Reviewer: ' . $request->input('catatan_tor');
        $rab->catatan = 'Reviewer: ' . $request->input('catatan_rab');
        $proker->status_rab = 'Revisi';
        $proker->status_proker = 'revisi';

        $proker->update();
        $rab->update();

        $logs = new LogsAjuan();
        $logs->proker_id = $id;
        $logs->action = 'Permintaan Revisi Proker';
        $logs->description = 'Proker memerlukan revisi. Catatan: TOR' . $request->input('catatan_tor') . ' | RAB: ' . $request->input('catatan_rab');
        $logs->status = 'Revisi';
        $logs->updated_by = auth()->user()->id;
        $logs->created_at = now('Asia/Jakarta');
        $logs->updated_at = now('Asia/Jakarta');
        $logs->save();

        toast()->info('Revisi Telah Dikirim','Proker telah direvisi dan dikembalikan ke ormawa untuk diperbaiki.');
        return redirect()->route('admin.review.proker');
    }

    public function show()
    {
        $proker = Proker::join('ormawa', 'ormawa.id', '=', 'proker.ormawa')
            ->join('skim_kegiatan', 'skim_kegiatan.id', '=', 'proker.skim_kegiatan')
            ->get(['proker.*', 'skim_kegiatan.nama_skim', 'ormawa.nama_ormawa']);
        return view('admin.show', ['proker' => $proker]);
    }

    public function insert()
    {
        $ormawa = Ormawa::all();
        $skim = Skim::all();
        return view('admin.insert', ['ormawa' => $ormawa, 'skim' => $skim]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ormawa' => 'required',
            'title' => 'required',
            'jenis' => 'required',
            'category' => 'required',
            'skim' => 'required',
            'tingkat' => 'required',
            'nim' => 'required',
            'kontak' => 'required',
            'start' => 'required',
            'end' => 'required',
            'dana' => 'required',
            'jumlah' => 'required',
            'RABfile' => 'required|max:10000',
        ]);

        $dana = implode(', ', $request->input('dana'));
        $mahasiswa = Mahasiswa::where('nim', $request->input('nim'))->value('nama');
        $proker = new Proker();
        $proker->ormawa = $request->input('ormawa');
        $proker->jenis_kegiatan = $request->input('jenis');
        $proker->kategori_kegiatan = $request->input('category');
        $proker->skim_kegiatan = $request->input('skim');
        $proker->nama_kegiatan = $request->input('title');
        $proker->tingkat_kegiatan = $request->input('tingkat');
        $proker->nama_pic = $mahasiswa;
        $proker->nim_pic = $request->input('nim');
        $proker->kontak_pic = $request->input('kontak');
        $proker->mulai = $request->input('start');
        $proker->selesai = $request->input('end');
        $proker->sumber_dana = $dana;
        $proker->jumlah_dana = $request->input('jumlah');
        if ($request->hasFile('RABfile')) {
            $file = $request->file('RABfile');
            $extention = $file->getClientOriginalExtension();
            $proker->filenames = $filename = time() . '.' . $extention;
            $file->storeAs('/uploads/RAB', $filename, ['disk' => 'public']);
        }
        $proker->save();

        $targetproker = new TargetProker();
        $targetproker->ormawa =  $request->input('ormawa');
        $targetproker->save();

        return redirect()->route('admin.show')->with('status', 'Data has been uploaded');
    }

    public function info($id)
    {
        $proker = Proker::find($id);
        $targetproker = TargetProker::find($id);
        return view('admin.info', compact('proker', 'targetproker'));
    }

    public function pdf($id)
    {
        $proker = Proker::join('ormawa', 'ormawa.id', '=', 'proker.ormawa')
            ->join('skim_kegiatan', 'skim_kegiatan.id', '=', 'proker.skim_kegiatan')
            ->where('proker.id', '=', $id)
            ->get(['proker.*', 'skim_kegiatan.nama_skim', 'ormawa.*']);
        $targetproker = TargetProker::find($id);
        $pdf = PDF::loadView('invoice', compact('proker'), ['targetproker' => $targetproker]);
        return $pdf->setPaper('legal', 'potrait')->stream();
    }

    public function detail(Request $request, $id)
    {
        $targetproker = TargetProker::find($id);
        $targetproker->PR01 = $request->input('PR01');
        $targetproker->PR02 = $request->input('PR02');
        $targetproker->PR03 = $request->input('PR03');
        $targetproker->RG01 = $request->input('RG01');
        $targetproker->RG02 = $request->input('RG02');
        $targetproker->RG03 = $request->input('RG03');
        $targetproker->RG04 = $request->input('RG04');
        $targetproker->RG05 = $request->input('RG05');
        $targetproker->RG06 = $request->input('RG06');
        $targetproker->RG07 = $request->input('RG07');
        $targetproker->RG08 = $request->input('RG08');
        $targetproker->MB01 = $request->input('MB01');
        $targetproker->MB02 = $request->input('MB02');
        $targetproker->MB03 = $request->input('MB03');
        $targetproker->MB04 = $request->input('MB04');
        $targetproker->MB05 = $request->input('MB05');
        $targetproker->MB06 = $request->input('MB06');
        $targetproker->MB07 = $request->input('MB07');
        $targetproker->MB08 = $request->input('MB08');
        $targetproker->BN01 = $request->input('BN01');
        $targetproker->BN02 = $request->input('BN02');
        $targetproker->BN03 = $request->input('BN03');
        $targetproker->BN04 = $request->input('BN04');
        $targetproker->BN05 = $request->input('BN05');
        $targetproker->BN06 = $request->input('BN06');
        $targetproker->BN07 = $request->input('BN07');
        $targetproker->BN08 = $request->input('BN08');
        $targetproker->BN09 = $request->input('BN09');
        $targetproker->LL = $request->input('LL');
        $targetproker->update();

        return redirect()->route('admin.show')->with('status', 'Data has been updated');
    }

    public function edit(Request $request, $id)
    {
        $sample = Proker::find($id);
        $skim = Skim::all();
        return view('admin.edit', compact('sample', 'skim'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('nim', $request->input('nim'))->value('nama');
        $dana = implode(', ', $request->input('dana'));
        $update = Proker::find($id);
        $update->nama_kegiatan = $request->input('title');
        $update->jenis_kegiatan = $request->input('jenis');
        $update->kategori_kegiatan = $request->input('category');
        $update->skim_kegiatan = $request->input('skim');
        $update->tingkat_kegiatan = $request->input('tingkat');
        $update->nama_pic = $mahasiswa;
        $update->nim_pic = $request->input('nim');
        $update->kontak_pic = $request->input('kontak');
        $update->mulai = $request->input('start');
        $update->selesai = $request->input('end');
        $update->sumber_dana = $dana;
        $update->jumlah_dana = $request->input('total_dana');
        if ($request->hasfile('dokumen')) {
            $destination = 'uploads/RAB/' . $update->filenames;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('dokumen');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->storeAs('uploads/RAB/', $filename, ['disk' => 'public']);
            $update->filenames = $filename;
        }
        $update->update();
        return redirect()->route('admin.show')->with('success', 'Update Successful');;
    }

    public function final($id)
    {
        $targetproker = TargetProker::find($id);
        $targetproker->status = 'final';
        $targetproker->update();
        return redirect()->back()->with('status', 'Data telah terfinalisasi');
    }

    public function destroy($id)
    {
        $proker = Proker::find($id);
        $fileRAB = 'uploads/maps/' . $proker->filename;
        if (File::exists($fileRAB)) {
            File::delete($fileRAB);
        }
        $proker->delete();
        return redirect()->back()->with('status', 'Data Deleted Successfully');
    }
}
