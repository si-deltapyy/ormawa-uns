<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndikatorController extends Controller
{
    public function index()
    {
        if (Indikator::where('ormawa_id', Auth::user()->anggota->ormawa_id)->exists()) {
            return redirect()->route('user.ajuan.proker')->with('info', 'Indikator kinerja utama sudah diisi.');
        }
        return view('pages.pengajuan.indikator.index');
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'penkom_realisasi' => 'required|numeric|min:0',
                'penkom_target' => 'required|numeric|min:0',
                'pennonkom_realisasi' => 'required|numeric|min:0',
                'pennonkom_target' => 'required|numeric|min:0',
                'delkom_realisasi' => 'required|numeric|min:0',
                'delkom_target' => 'required|numeric|min:0',
                'delnonkom_realisasi' => 'required|numeric|min:0',
                'delnonkom_target' => 'required|numeric|min:0',
                'sdg_realisasi' => 'required|numeric|min:0',
                'sdg_target' => 'required|numeric|min:0',
            ]);

            $ormawaId = Auth::user()->anggota->ormawa_id;

            Indikator::create([
                'ormawa_id' => $ormawaId,
                'pendelegasian_kompetisi_realisasi' => $request->penkom_realisasi,
                'pendelegasian_kompetisi_target' => $request->penkom_target,
                'pendelegasian_non_kompetisi_realisasi' => $request->pennonkom_realisasi,
                'pendelegasian_non_kompetisi_target' => $request->pennonkom_target,
                'penyelenggaraan_kompetisi_realisasi' => $request->delkom_realisasi,
                'penyelenggaraan_kompetisi_target' => $request->delkom_target,
                'penyelenggaraan_non_kompetisi_realisasi' => $request->delnonkom_realisasi,
                'penyelenggaraan_non_kompetisi_target' => $request->delnonkom_target,
                'sdg_realisasi' => $request->sdg_realisasi,
                'sdg_target' => $request->sdg_target,
            ]);

            return redirect()->route('user.ajuan.proker')->with('success', 'Indikator kinerja utama berhasil disimpan.');
        } catch (\Exception $e) {
            toast()->error('Terjadi kesalahan saat menyimpan indikator: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan indikator: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $now = now('Asia/Jakarta');
        $open = \Carbon\Carbon::create(2026, 2, 8, 18, 0, 0);
        $close = \Carbon\Carbon::create(2026, 2, 8, 23, 59, 59);

        if ($now->lt($open)) {
            toast()->error('Akses belum dibuka.', 'Sesi revisi Indikator belum Dibuka.');
            return redirect()->back()->with('error', 'Akses belum dibuka.');
        }

        if ($now->gt($close)) {
            toast()->error('Masa Revisi Selesai', 'Sesi revisi Indikator telah berakhir.');
            return redirect()->back()->with('error', 'Masa pengisian telah berakhir.');
        }

        $indikator = Indikator::where('ormawa_id', $id)->firstOrFail();
        return view('pages.pengajuan.indikator.edit', compact('indikator'));
    }

    public function update(Request $request, $id)
    {
        $now = now('Asia/Jakarta');
        $open = \Carbon\Carbon::create(2026, 2, 8, 18, 0, 0);
        $close = \Carbon\Carbon::create(2026, 2, 8, 23, 59, 59);

        if ($now->lt($open)) {
            toast()->error('Akses belum dibuka.', 'Sesi revisi Indikator belum Dibuka.');
            return redirect()->back()->with('error', 'Akses belum dibuka.');
        }

        if ($now->gt($close)) {
            toast()->error('Masa Revisi Selesai', 'Sesi revisi Indikator telah berakhir.');
            return redirect()->back()->with('error', 'Masa pengisian telah berakhir.');
        }

        try {
            $request->validate([
                'penkom_realisasi' => 'required|numeric|min:0',
                'penkom_target' => 'required|numeric|min:0',
                'pennonkom_realisasi' => 'required|numeric|min:0',
                'pennonkom_target' => 'required|numeric|min:0',
                'delkom_realisasi' => 'required|numeric|min:0',
                'delkom_target' => 'required|numeric|min:0',
                'delnonkom_realisasi' => 'required|numeric|min:0',
                'delnonkom_target' => 'required|numeric|min:0',
                'sdg_realisasi' => 'required|numeric|min:0',
                'sdg_target' => 'required|numeric|min:0',
            ]);

            $indikator = Indikator::findOrFail($id);

            $indikator->update([
                'pendelegasian_kompetisi_realisasi' => $request->penkom_realisasi,
                'pendelegasian_kompetisi_target' => $request->penkom_target,
                'pendelegasian_non_kompetisi_realisasi' => $request->pennonkom_realisasi,
                'pendelegasian_non_kompetisi_target' => $request->pennonkom_target,
                'penyelenggaraan_kompetisi_realisasi' => $request->delkom_realisasi,
                'penyelenggaraan_kompetisi_target' => $request->delkom_target,
                'penyelenggaraan_non_kompetisi_realisasi' => $request->delnonkom_realisasi,
                'penyelenggaraan_non_kompetisi_target' => $request->delnonkom_target,
                'sdg_realisasi' => $request->sdg_realisasi,
                'sdg_target' => $request->sdg_target,
            ]);

            toast()->success('success', 'Indikator kinerja utama berhasil diperbarui.');
            return redirect()->route('user.ajuan.proker')->with('success', 'Indikator kinerja utama berhasil diperbarui.');
        } catch (\Exception $e) {
            toast()->error('Terjadi kesalahan saat memperbarui indikator: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui indikator: ' . $e->getMessage());
        }
    }
}


