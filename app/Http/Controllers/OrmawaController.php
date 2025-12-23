<?php

namespace App\Http\Controllers;

use App\Models\Skim;
use App\Models\JenisSkim;
use App\Models\TargetSkim;
use App\Models\Ormawa;
use App\Models\Proker;
use Illuminate\Http\Request;
use GuzzleHttp\Handler\Proxy;
use GuzzleHttp\Promise\Create;

class OrmawaController extends Controller
{
    public function index()
    {
        // $ormawa = Ormawa::all();
        return view('home');
    }

    public function form()
    {
        $skim = Skim::all();
        $ormawa = Ormawa::all();
        $jenisskim = JenisSkim::all();
        $proker = Proker::join('ormawa', 'ormawa.ID', '=', 'proker.id_mawa')
        ->join('skim_kegiatan','skim_kegiatan.id','=','proker.id_skim')
        ->get(['proker.*', 'ormawa.*','skim_kegiatan.*']);
        return view('database', ['ormawa' => $ormawa, 'proker' => $proker, 'skim' => $skim, 'jenisskim' => $jenisskim]);
    }

    public function store(Request $request)
    {
        $dana = implode(', ', $request->input('dana'));
        $filename = $request->formrabFile->getClientOriginalName();
        $RAB = $request->formrabFile->storeAs('RAB', $filename);
        $this->validate($request, rules: [
            'ormawa' => 'required',
            'jenis_kegiatan' => 'required',
            'kategori_kegiatan' => 'required',
            'skim_kegiatan' => 'required',
            'title' => 'required',
            'nim-PIC' => 'required',
            'contact' => 'required',
            'start' => 'required',
            'end' => 'required',
            'dana' => 'required',
            'jumlah' => 'required',
            'formrabFile' => 'required',
        ]);

        Proker::create([
            'id_mawa' => $request->input('ormawa'),
            'id_proker' => $request->input('uid'),
            'jenis_kegiatan' => $request->input('jenis_kegiatan'),
            'kategori_kegiatan' => $request->input('kategori_kegiatan'),
            'skim_kegiatan' => $request->input('skim_kegiatan'),
            'judul_kegiatan' => $request->input('title'),
            'NIM' => $request->input('nim'),
            'kontak_pic' => $request->input('contact'),
            'mulai' => $request->input('start'),
            'selesai' => $request->input('end'),
            'sumber_dana' => $dana,
            'jumlah_dana' => $request->input('jumlah'),
            'file_RAB' => $RAB,
        ]);

        return redirect()->back()->with('status', 'Data sukses ditambahkan');
    }

    public function detail(Request $request)
    {
        $this->validate($request, [
            'PR01' => 'nullable',
            'PR02' => 'nullable',
            'PR03' => 'nullable',
            'RG01' => 'nullable',
            'RG02' => 'nullable',
            'RG03' => 'nullable',
            'RG04' => 'nullable',
            'RG05' => 'nullable',
            'RG06' => 'nullable',
            'RG07' => 'nullable',
            'RG08' => 'nullable',
            'MB01' => 'nullable',
            'MB02' => 'nullable',
            'MB03' => 'nullable',
            'MB04' => 'nullable',
            'MB05' => 'nullable',
            'MB06' => 'nullable',
            'MB07' => 'nullable',
            'MB08' => 'nullable',
            'BN01' => 'nullable',
            'BN02' => 'nullable',
            'BN03' => 'nullable',
            'BN04' => 'nullable',
            'BN05' => 'nullable',
            'BN06' => 'nullable',
            'BN07' => 'nullable',
            'BN08' => 'nullable',
            'BN09' => 'nullable',
            'LL' => 'nullable',     
        ]);

        TargetSkim::create([
            'id_proker' => $request->input('kode_proker'),
            'PR01' => $request->input('PR.01'),
            'PR02' => $request->input('PR.02'),
            'PR03' => $request->input('PR.03'),
            'RG01' => $request->input('RG.01'),
            'RG02' => $request->input('RG.02'),
            'RG03' => $request->input('RG.03'),
            'RG04' => $request->input('RG.04'),
            'RG05' => $request->input('RG.05'),
            'RG06' => $request->input('RG.06'),
            'RG07' => $request->input('RG.07'),
            'RG08' => $request->input('RG.08'),
            'MB01' => $request->input('MB.01'),
            'MB02' => $request->input('MB.02'),
            'MB03' => $request->input('MB.03'),
            'MB04' => $request->input('MB.04'),
            'MB05' => $request->input('MB.05'),
            'MB06' => $request->input('MB.06'),
            'MB07' => $request->input('MB.07'),
            'MB08' => $request->input('MB.08'),
            'BN01' => $request->input('BN.01'),
            'BN02' => $request->input('BN.02'),
            'BN03' => $request->input('BN.03'),
            'BN04' => $request->input('BN.04'),
            'BN05' => $request->input('BN.05'),
            'BN06' => $request->input('BN.06'),
            'BN07' => $request->input('BN.07'),
            'BN08' => $request->input('BN.08'),
            'BN09' => $request->input('BN.09'),
            'LL' => $request->input('LL'),
        ]);

        return redirect()->back()->with('status', 'Data sukses ditambahkan');
    }

}