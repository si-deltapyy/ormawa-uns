<?php

namespace App\Http\Controllers;

use App\Models\Skim;
use App\Models\User;
use App\Models\Asset;
use App\Models\Ormawa;
use App\Models\Proker;
use App\Models\Mahasiswa;
use App\Models\TargetProker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


class UserController extends Controller
{
    public function index()
    {
        $account = (Auth::user()->ormawa);
        $name = User::join('ormawa', 'ormawa.id', '=', 'users.ormawa')
            ->where('users.ormawa', '=', $account)
            ->get(['users.*', 'ormawa.nama_ormawa']);
        return view('user.index', compact('name'));
    }

    public function profile()
    {
        $account = (Auth::user()->ormawa);
        $user = User::where('ormawa', $account)->join('ormawa', 'ormawa.id', '=', 'users.ormawa')->get();
        return view('user.profile', compact('user'));
    }

    public function change(Request $request)
    {
        $account = (Auth::user()->id);
        $user = User::find($account);
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->update();
        return redirect()->route('user.profile')->with('status', 'Data has been uploaded');
    }

    public function show()
    {
        $account = (Auth::user()->ormawa);

        $proker = Proker::join('ormawa', 'ormawa.id', '=', 'proker.ormawa')
            ->join('skim_kegiatan', 'skim_kegiatan.id', '=', 'proker.skim_kegiatan')
            ->where('proker.ormawa', '=', $account)
            ->get(['proker.*', 'skim_kegiatan.nama_skim', 'ormawa.nama_ormawa']);
        return view('user.show', ['proker' => $proker]);
    }

    public function insert()
    {
        $account = (Auth::user()->ormawa);
        $ormawa = Ormawa::where('ormawa.id', '=', $account)->get(['ormawa.*']);
        $skim = Skim::all();
        $mahasiswa = Mahasiswa::select()->get('nama', 'nim');
        return view('user.insert', ['ormawa' => $ormawa, 'skim' => $skim, 'mahasiswa' => $mahasiswa]);
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
        if ($request->file('RABfile') != null) {
            $file = $request->file('RABfile');
            $extention = $file->getClientOriginalExtension();
            $proker->filenames = $filename = time() . '.' . $extention;
            $file->storeAs('uploads/RAB/', $filename);
        }
        $proker->save();

        $targetproker = new TargetProker();
        $targetproker->ormawa =  $request->input('ormawa');
        $targetproker->save();

        return redirect()->route('user.show')->with('status', 'Data has been uploaded');
    }

    public function info($id)
    {
        $proker = Proker::find($id);
        $targetproker = TargetProker::find($id);
        return view('user.info', compact('proker', 'targetproker'));
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $mahasiswa = $request->input('search');
            $data = Mahasiswa::where('nim', $mahasiswa)->get();
            $output = '';
            if (count($data) > 0) {
                $output = '
                <table class="table">
                <thead>
                <tr>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Angkatan</th>
                </tr>
                </thead>
                <tbody>';
                foreach ($data as $row) {
                    $output .= '
                        <tr>
                        <th scope="row">' . $row->nim . '</th>
                        <td>' . $row->nama . '</td>
                        <td>' . $row->angkatan . '</td>
                        </tr>
                        ';
                }
                $output .= '
                 </tbody>
                </table>';
            } else {
                $output .= 'No results';
            }
            return $output;
        }
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

        return redirect()->route('user.show')->with('status', 'Data has been updated');
    }

    public function final($id)
    {
        $targetproker = TargetProker::find($id);
        $targetproker->status = 'final';
        $targetproker->update();
        return redirect()->back()->with('status', 'Data telah terfinalisasi');
    }

    public function pdf($id)
    {
        $proker = Proker::join('ormawa', 'ormawa.id', '=', 'proker.ormawa')
            ->join('skim_kegiatan', 'skim_kegiatan.id', '=', 'proker.skim_kegiatan')
            ->where('proker.id', '=', $id)
            ->get(['proker.*', 'skim_kegiatan.nama_skim', 'ormawa.*']);
        $targetproker = TargetProker::find($id);
        $pdf = FacadePdf::loadView('invoice', ['targetproker' => $targetproker, 'proker' => $proker]);
        $pdf->setPaper('legal', 'potrait');
        return $pdf->stream();
    }

    public function edit(Request $request, $id)
    {
        $sample = Proker::find($id);
        $skim = Skim::all();
        return view('user.edit', compact('sample', 'skim'));
    }

    public function update(Request $request, $id)
    {
        $dana = implode(', ', $request->input('dana'));
        $mahasiswa = Mahasiswa::where('nim', $request->input('nim'))->value('nama');

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
            $file->storeAs('uploads/RAB/', $filename);
            $update->filenames = $filename;
        }
        $update->update();
        return redirect()->route('user.show')->with('success', 'Update Successful');;
    }
}
