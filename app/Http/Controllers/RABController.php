<?php

namespace App\Http\Controllers;

use App\Models\LogsAjuan;
use App\Models\mak;
use App\Models\Proker;
use App\Models\RABModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RABController extends Controller
{

    public function index($id)
    {
        $rab = RABModel::with('proker', 'mak')->get();
        $proker = Proker::find($id);
        return view('pages.pengajuan.rab.index', compact('rab', 'proker'));
    }

    public function createRAB($id)
    {
       $proker = Proker::find($id);
       $makList = mak::all();
       
       return view('pages.pengajuan.rab.create', compact('proker', 'makList'));
    }

    public function storeRAB(Request $request, $id)
    {// Gunakan Transaction agar data aman
        DB::beginTransaction();

        try {
        // 1. Validasi (Pindahkan ke DALAM try)
        // Validasi yang gagal akan melempar ValidationException yang ditangkap di bawah
        $request->validate([
            'kode_mak'          => 'required',
            'deskripsi_belanja' => 'required|string',
            'volume'            => 'required|integer|min:1',
            'frekuensi'         => 'required|integer|min:1',
            'perhitungan'       => 'required|integer|min:1',
            'biaya_satuan'      => 'required|string',
            'total_biaya'       => 'required|string',
            'catatan'           => 'nullable|string',
        ]);

        // 2. Bersihkan Format Uang
        $harga_bersih = (int) str_replace(['Rp', '.', ' ', ','], '', $request->biaya_satuan);
        $total_bersih = (int) str_replace(['Rp', '.', ' ', ','], '', $request->total_biaya);
        
        $total_biaya = $request->volume * $request->frekuensi * $harga_bersih;
        $perhitungan = (int)$request->perhitungan;

        // 3. Simpan ke Database
        RABModel::create([
            'proker_id'      => $id,
            'mak_id'         => $request->kode_mak,
            
            // Pastikan nama kolom DB (kiri) sesuai dengan tabel Anda
            'uraian_belanja' => $request->deskripsi_belanja, 
            'volume'         => $request->volume,
            'frekuensi'      => $request->frekuensi,
            'perhitungan'    => $perhitungan, // Pastikan kolom DB 'jumlah_kegiatan' ada
            'harga_satuan'   => $harga_bersih,
            'total_biaya'    => $total_biaya,
            'tahun_anggaran' => $request->tahun_anggaran ?? date('Y'),
            'catatan'        => $request->catatan,
        ]);

        DB::commit();

        toast()->success('Berhasil', 'Pengajuan RAB berhasil ditambahkan!');
        return redirect()->route('user.ajuan.rab.index', $id);

        } catch (ValidationException $e) {
            // TANGKAP ERROR VALIDASI KHUSUS
            DB::rollBack();
            
            // Ambil pesan error pertama untuk ditampilkan di Toast
            $firstError = $e->validator->errors()->first();
            toast()->error('Gagal Validasi', $firstError);
            
            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            DB::rollBack();
            
            toast()->error('Error Sistem', $e->getMessage());
            return redirect()->back()->withInput();
        }
        
    }

    public function requestRAB($id)
    {
        $proker = Proker::find($id);
        $proker->status_rab = 'Menunggu';
        $proker->status_proker = 'Review';
        $proker->save();

        $logs = new LogsAjuan();
            $logs->proker_id = $id;
            $logs->action = 'Pengajuan Finalisasi RAB';
            $logs->description = 'Finalisasi RAB telah diajukan oleh ormawa.';
            $logs->status = 'Ajuan RAB';
            $logs->updated_by = auth()->user()->id;
            $logs->save();

        toast()->success('Berhasil', 'Finalisasi RAB berhasil diajukan!');
        return redirect()->route('user.ajuan.rab.index', $id);
    }

    public function deleteRAB($id)
    {
        try {
            $rab = RABModel::findOrFail($id);
            $prokerId = $rab->proker_id; // Simpan proker_id sebelum menghapus RAB
            $rab->delete();

            toast()->success('Berhasil', 'Item Belanja RAB berhasil dihapus!');
            return redirect()->route('user.ajuan.rab.index', $prokerId);
        } catch (\Exception $e) {
            toast()->error('Gagal', 'Terjadi kesalahan saat menghapus RAB: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $rab = RABModel::findOrFail($id);
        if (!$rab) {
            toast()->error('Error', 'RAB tidak ditemukan.');
            return redirect()->back()->with('error', 'RAB tidak dapat diedit karena sedang dalam proses review atau sudah disetujui.');
        }

        $rabStatus = Proker::where('id', $rab->proker_id)->value('status_rab');
        if ($rabStatus == 'Menunggu' || $rabStatus == 'Disetujui') {
            toast()->error('Error', 'RAB tidak dapat diedit karena sedang dalam proses review atau sudah disetujui.');
            return redirect()->back()->with('error', 'RAB tidak dapat diedit karena sedang dalam proses review atau sudah disetujui.');
        }   

        return view('pages.pengajuan.rab.edit', compact('rab'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'uraian_belanja' => 'required|string|max:255',
            'volume'         => 'required|numeric|min:1',
            'frekuensi'      => 'required|numeric|min:1',
            'harga_satuan'   => 'required|numeric|min:0',
        ]);

        $rab = RABModel::findOrFail($id);
        
        // Hitung ulang total biaya
        $perhitungan = $request->volume * $request->frekuensi;
        $total_biaya = $perhitungan * $request->harga_satuan;

        $rab->update([
            'uraian_belanja' => $request->uraian_belanja,
            'volume'         => $request->volume,
            'frekuensi'      => $request->frekuensi,
            'perhitungan'    => $perhitungan,
            'harga_satuan'   => $request->harga_satuan,
            'total_biaya'    => $total_biaya,
            'catatan'        => $request->catatan,
        ]);

        return redirect()->route('user.ajuan.rab.index', $rab->proker_id)
                        ->with('success', 'Item belanja berhasil diperbarui.');
    }
}
