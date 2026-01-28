<?php

namespace App\Http\Controllers;

use App\Models\jenisKegiatan;
use App\Models\Luaran;
use App\Models\Skim;
use App\Models\Anggota;
use App\Models\Mekanisme;
use App\Models\Ormawa;
use Illuminate\Support\Facades\Auth;
use App\Models\Proker;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Exception;

class AjuanController extends Controller
{
    public function ajuanProker()
    {
        $sasaran = [
            1 => 'Mahasiswa Internal', 
            2 => 'Mahasiswa dan Umum', 
            3 => 'Mahasiswa Internal dan Eksternal', 
            4 => 'Lainnya'
        ];

        $proker = Proker::all();
        $jenisKegiatan = jenisKegiatan::all();
        $luaran = Luaran::all();
        $skims = Skim::all();
        $dataAnggota = Anggota::join('users', 'users.id', '=', 'anggota.user_id')
            ->join('ormawa', 'ormawa.id', '=', 'anggota.ormawa_id')
            ->where('user_id', '=', Auth::user()->id)
            ->get(['anggota.*', 'users.name', 'ormawa.nama_id', 'ormawa.id']);
        return view('pages.pengajuan.proker.index', compact('proker', 'jenisKegiatan', 'luaran', 'skims', 'dataAnggota', 'sasaran'));
    }

    public function createProker()
    {
        return view('pages.pengajuan.proker.create');
    }

    public function storeProker(Request $request)
    {
        $validatedData = $request->validate([
                'nama_proker'           => 'required|string|max:255',
                'skim'                  => 'required',
                'jenis_kegiatan'        => 'required',
                'id_ormawa'             => 'required',
                'id_luaran_kegiatan'    => 'required|array',
                'id_luaran_kegiatan.*'  => 'exists:luaran,id',
                'target_luaran'         => 'required|array',
                'target_luaran.*'       => 'required|numeric|min:1',
                'no_hp_pic'             => 'required|string|min:10|max:14',
                'nama_pic'              => 'required|string|max:100',
                'nim_pic'               => 'required|string|max:20',
                'sasaran'               => 'required|string',
                'lainnya'               => 'nullable|string',
                'tanggal_mulai'         => 'required|date',
                'tanggal_selesai'       => 'required|date|after_or_equal:tanggal_mulai',
                'latarbelakang_kegiatan'=> 'required|string',
                'tujuan_kegiatan'       => 'required|string',
                'rasionalisasi_kegiatan'=> 'required|string',
                'keberlanjutan_kegiatan'=> 'required|string',
                'setuju'                => 'required|accepted',
                'persiapan_tanggal'      => 'required|date',
                'persiapan_tempat'       => 'required|string|max:255',
                'persiapan_waktu'        => 'required',
                'persiapan_deskripsi'    => 'nullable|string',
                'pelaksanaan_tanggal'    => 'required|date',
                'pelaksanaan_tempat'     => 'required|string|max:255',
                'pelaksanaan_waktu'      => 'required',
                'pelaksanaan_deskripsi'  => 'nullable|string',
                'evaluasi_tanggal'       => 'required|date',
                'evaluasi_tempat'        => 'required|string|max:255',
                'evaluasi_waktu'         => 'required',
                'evaluasi_deskripsi'     => 'nullable|string',
                'pelaporan_tanggal'      => 'required|date',
                'pelaporan_tempat'       => 'required|string|max:255',
                'pelaporan_waktu'        => 'required',
                'pelaporan_deskripsi'    => 'nullable|string',
            ]);
            
            DB::beginTransaction();

        try {

            $mekanisme = new Mekanisme();
            $mekanisme->persiapan_tanggal = $validatedData['persiapan_tanggal'];
            $mekanisme->persiapan_tempat = $validatedData['persiapan_tempat'];
            $mekanisme->persiapan_waktu = $validatedData['persiapan_waktu'];
            $mekanisme->persiapan_deskripsi = $validatedData['persiapan_deskripsi'];
            $mekanisme->pelaksanaan_tanggal = $validatedData['pelaksanaan_tanggal'];
            $mekanisme->pelaksanaan_tempat = $validatedData['pelaksanaan_tempat'];
            $mekanisme->pelaksanaan_waktu = $validatedData['pelaksanaan_waktu'];
            $mekanisme->pelaksanaan_deskripsi = $validatedData['pelaksanaan_deskripsi'];
            $mekanisme->evaluasi_tanggal = $validatedData['evaluasi_tanggal'];
            $mekanisme->evaluasi_tempat = $validatedData['evaluasi_tempat'];
            $mekanisme->evaluasi_waktu = $validatedData['evaluasi_waktu'];
            $mekanisme->evaluasi_deskripsi = $validatedData['evaluasi_deskripsi'];
            $mekanisme->pelaporan_tanggal = $validatedData['pelaporan_tanggal'];
            $mekanisme->pelaporan_tempat = $validatedData['pelaporan_tempat'];
            $mekanisme->pelaporan_waktu = $validatedData['pelaporan_waktu'];
            $mekanisme->pelaporan_deskripsi = $validatedData['pelaporan_deskripsi'];
            $mekanisme->created_at = now('Asia/Jakarta');
            $mekanisme->updated_at = now('Asia/Jakarta');

            $mekanisme->save();

            // 1. Validasi Data
            if ($validatedData['sasaran'] !== 'Lainnya') {
                $validatedData['lainnya'] = null;
            }


            $ormawa = Ormawa::findOrFail($validatedData['id_ormawa']);
            $mekanismeRancangan = Mekanisme::latest()->first();

            $jumlahProkerSaatIni = Proker::whereYear('created_at', date('Y'))
                ->where('id_ormawa', $ormawa->id) // Ganti '$ormawa->nama_id' jadi '$ormawa->id' (biasanya relasi pakai ID utama)
                ->count();

            $nextNumber = $jumlahProkerSaatIni + 1;
            $nomorUrut = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            // Pastikan kolom UID ada di tabel ormawa
            $idKegiatan = $ormawa->UID . '.' . $nomorUrut;

            // 3. Simpan Data
            $proker = new Proker();
            $proker->id_kegiatan = $idKegiatan;
            $proker->id_ormawa = $ormawa->id;
            $proker->id_skim = $validatedData['skim'];
            $proker->id_jenis_kegiatan = $validatedData['jenis_kegiatan'];
            $proker->id_mekanisme_rancangan = $mekanismeRancangan->id;
            $proker->sasaran_kegiatan = $validatedData['sasaran'];
            $proker->lainnya = $validatedData['lainnya'];
            $proker->tanggal_mulai = $validatedData['tanggal_mulai'];
            $proker->tanggal_selesai = $validatedData['tanggal_selesai'];
            $proker->nama_pic = $validatedData['nama_pic'];
            $proker->nim_pic = $validatedData['nim_pic'];
            $proker->kontak_pic = $validatedData['no_hp_pic'];
            $proker->latar_belakang = $validatedData['latarbelakang_kegiatan'];
            $proker->tujuan_kegiatan = $validatedData['tujuan_kegiatan'];
            $proker->rasionalisasi_kegiatan = $validatedData['rasionalisasi_kegiatan'];
            $proker->keberlanjutan_kegiatan = $validatedData['keberlanjutan_kegiatan'];
            $proker->nama_kegiatan = $validatedData['nama_proker'];
            $proker->id_luaran_kegiatan = implode(',', $request->id_luaran_kegiatan);
            $proker->target_luaran = json_encode($request->target_luaran);
            $proker->tahun_anggaran = date('Y');
            $proker->created_at = now('Asia/Jakarta');
            $proker->updated_at = now('Asia/Jakarta');
            
            $proker->save();

            DB::commit();

            toast()->success('Success', 'Program kerja berhasil diajukan.');
            return redirect()->route('user.ajuan.proker');

        } catch (ValidationException $e) {
        // Tangkap error validasi spesifik dan kembalikan
            DB::rollBack();

            toast()->error('Gagal', 'Validasi gagal. Periksa kembali inputan Anda.');
            return redirect()->back()->withErrors($e->errors())->withInput();
        
        } catch (\Exception $e) {
            // KHUSUS ERROR SISTEM (Database mati, Typo kodingan, dll)
            DB::rollBack();
            
            // 1. Catat error asli di file log (storage/logs/laravel.log) agar Anda bisa cek
            Log::error('System Error storeProker: ' . $e->getMessage());
            Log::error($e->getTraceAsString()); // Cek baris mana yang error

            // 2. Tampilkan pesan ke user (Jangan tampilkan $e->getMessage() mentah ke user di production, bahaya)
            toast()->error('Gagal', 'Terjadi kesalahan sistem: ' . $e->getMessage());
            
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        try {
            // Ambil data proker beserta relasinya (Ormawa & Mekanisme)
            $proker = Proker::with(['ormawa', 'mekanisme'])->findOrFail($id);

            // Ambil data Master untuk Dropdown (Sama seperti di function create/index)
            $skims = Skim::all();
            $jenisKegiatan = JenisKegiatan::all();
            $luaran = Luaran::all();
            $sasaran = [
                1 => 'Mahasiswa Internal', 
                2 => 'Mahasiswa dan Umum', 
                3 => 'Mahasiswa Internal dan Eksternal', 
                4 => 'Lainnya'
            ]; // Sesuaikan dengan data Anda

            return view('pages.pengajuan.proker.edit', compact(
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

    public function update(Request $request, $id)
    {
        // 1. Validasi (Sama dengan store, tapi ID Ormawa biasanya tidak diubah saat edit)
        $validatedData = $request->validate([
            'nama_proker'           => 'required|string|max:255',
            'skim'                  => 'required',
            'jenis_kegiatan'        => 'required',
            // 'id_ormawa' => 'required', // Biasanya ormawa tidak berubah saat edit, ambil dari existing
            'id_luaran_kegiatan'    => 'required|array',
            'id_luaran_kegiatan.*'  => 'exists:luaran,id',
            'target_luaran'         => 'required|array',
            'target_luaran.*'       => 'required|numeric|min:1',
            'no_hp_pic'             => 'required|string|min:10|max:14',
            'nama_pic'              => 'required|string|max:100',
            'nim_pic'               => 'required|string|max:20',
            'sasaran'               => 'required|string',
            'lainnya'               => 'nullable|string',
            'tanggal_mulai'         => 'required|date',
            'tanggal_selesai'       => 'required|date|after_or_equal:tanggal_mulai',
            'latarbelakang_kegiatan'=> 'required|string',
            'tujuan_kegiatan'       => 'required|string',
            'rasionalisasi_kegiatan'=> 'required|string',
            'keberlanjutan_kegiatan'=> 'required|string',
            'setuju'                => 'required|accepted',
            
            // Validasi Mekanisme
            'persiapan_tanggal'      => 'required|date',
            'persiapan_tempat'       => 'required|string|max:255',
            'persiapan_waktu'        => 'required',
            'persiapan_deskripsi'    => 'nullable|string',
            'pelaksanaan_tanggal'    => 'required|date',
            'pelaksanaan_tempat'     => 'required|string|max:255',
            'pelaksanaan_waktu'      => 'required',
            'pelaksanaan_deskripsi'  => 'nullable|string',
            'evaluasi_tanggal'       => 'required|date',
            'evaluasi_tempat'        => 'required|string|max:255',
            'evaluasi_waktu'         => 'required',
            'evaluasi_deskripsi'     => 'nullable|string',
            'pelaporan_tanggal'      => 'required|date',
            'pelaporan_tempat'       => 'required|string|max:255',
            'pelaporan_waktu'        => 'required',
            'pelaporan_deskripsi'    => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Ambil Data Proker Lama
            $proker = Proker::findOrFail($id);

            // Ambil Data Mekanisme Lama yang terhubung
            $mekanisme = Mekanisme::findOrFail($proker->id_mekanisme_rancangan);

            // 2. Update Tabel Mekanisme
            $mekanisme->persiapan_tanggal = $validatedData['persiapan_tanggal'];
            $mekanisme->persiapan_tempat = $validatedData['persiapan_tempat'];
            $mekanisme->persiapan_waktu = $validatedData['persiapan_waktu'];
            $mekanisme->persiapan_deskripsi = $validatedData['persiapan_deskripsi'];
            
            $mekanisme->pelaksanaan_tanggal = $validatedData['pelaksanaan_tanggal'];
            $mekanisme->pelaksanaan_tempat = $validatedData['pelaksanaan_tempat'];
            $mekanisme->pelaksanaan_waktu = $validatedData['pelaksanaan_waktu'];
            $mekanisme->pelaksanaan_deskripsi = $validatedData['pelaksanaan_deskripsi'];
            
            $mekanisme->evaluasi_tanggal = $validatedData['evaluasi_tanggal'];
            $mekanisme->evaluasi_tempat = $validatedData['evaluasi_tempat'];
            $mekanisme->evaluasi_waktu = $validatedData['evaluasi_waktu'];
            $mekanisme->evaluasi_deskripsi = $validatedData['evaluasi_deskripsi'];
            
            $mekanisme->pelaporan_tanggal = $validatedData['pelaporan_tanggal'];
            $mekanisme->pelaporan_tempat = $validatedData['pelaporan_tempat'];
            $mekanisme->pelaporan_waktu = $validatedData['pelaporan_waktu'];
            $mekanisme->pelaporan_deskripsi = $validatedData['pelaporan_deskripsi'];
            
            $mekanisme->updated_at = now('Asia/Jakarta');
            $mekanisme->save();

            // 3. Logic Sasaran (Sama seperti store)
            if ($validatedData['sasaran'] !== 'Lainnya') {
                $validatedData['lainnya'] = null;
            }

            // 4. Update Tabel Proker
            // Catatan: id_kegiatan dan id_ormawa TIDAK diupdate agar konsistensi data terjaga
            
            $proker->id_skim = $validatedData['skim'];
            $proker->id_jenis_kegiatan = $validatedData['jenis_kegiatan'];
            // id_mekanisme_rancangan tidak perlu diupdate karena kita mengupdate record mekanismenya langsung
            
            $proker->sasaran_kegiatan = $validatedData['sasaran'];
            $proker->lainnya = $validatedData['lainnya'];
            $proker->tanggal_mulai = $validatedData['tanggal_mulai'];
            $proker->tanggal_selesai = $validatedData['tanggal_selesai'];
            
            $proker->nama_pic = $validatedData['nama_pic'];
            $proker->nim_pic = $validatedData['nim_pic'];
            $proker->kontak_pic = $validatedData['no_hp_pic'];
            
            $proker->latar_belakang = $validatedData['latarbelakang_kegiatan'];
            $proker->tujuan_kegiatan = $validatedData['tujuan_kegiatan'];
            $proker->rasionalisasi_kegiatan = $validatedData['rasionalisasi_kegiatan'];
            $proker->keberlanjutan_kegiatan = $validatedData['keberlanjutan_kegiatan'];
            
            $proker->nama_kegiatan = $validatedData['nama_proker'];
            
            // Update Array/JSON fields
            $proker->id_luaran_kegiatan = implode(',', $request->id_luaran_kegiatan);
            $proker->target_luaran = json_encode($request->target_luaran);
            
            $proker->updated_at = now('Asia/Jakarta');
            
            $proker->save();

            DB::commit();

            toast()->success('Berhasil', 'Program kerja berhasil diperbarui.');
            return redirect()->route('user.ajuan.proker');

        } catch (ValidationException $e) {
            DB::rollBack();
            toast()->error('Gagal', 'Validasi gagal. Periksa kembali inputan Anda.');
            return redirect()->back()->withErrors($e->errors())->withInput();
        
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('System Error updateProker: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            toast()->error('Gagal', 'Terjadi kesalahan sistem saat memperbarui data.'. $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
