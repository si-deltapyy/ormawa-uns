<?php

namespace App\Http\Controllers;

use App\Models\jenisKegiatan;
use App\Models\Luaran;
use App\Models\Skim;
use App\Models\Anggota;
use App\Models\Indikator;
use App\Models\IndikatorKinerja;
use App\Models\LogsAjuan;
use App\Models\Mekanisme;
use App\Models\Ormawa;
use App\Models\RABModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Proker;
use App\Models\SDG;
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
        $now = now('Asia/Jakarta');
        $open = \Carbon\Carbon::create(2026, 2, 8, 10, 0, 0);
        $close = \Carbon\Carbon::create(2026, 2, 9, 23, 59, 59);

        if ($now->lt($open)) {
            toast()->error('Akses belum dibuka.', 'Sesi revisi proker belum Dibuka.');
            return redirect()->back()->with('error', 'Akses belum dibuka.');
        }

        if ($now->gt($close)) {
            toast()->error('Masa Pengajuan Sudah selesai', 'Bukan saat nya input proker.');
            return redirect()->back()->with('error', 'Masa pengisian telah berakhir.');
        }
        
        $indikator = Indikator::where('ormawa_id', Auth::user()->anggota->ormawa_id)->get();

        if($indikator->isEmpty()){
            toast()->warning('Peringatan', 'Indikator utama belum ditambahkan. Silakan tambahkan indikator utama terlebih dahulu.');
            return redirect()->route('user.input.indikator');
        } else{
            $sasaran = [
                1 => 'Mahasiswa Internal', 
                2 => 'Mahasiswa dan Umum', 
                3 => 'Mahasiswa Internal dan Eksternal', 
                4 => 'Lainnya'
            ];

            $proker = Proker::all();
            $jenisKegiatan = jenisKegiatan::all();
            $catatan_rab = RABModel::whereIn('proker_id', $proker->pluck('id'))
            ->whereNotNull('catatan')
            ->first();
            $luaran = Luaran::all();
            $skims = Skim::all();
            $sdgs = SDG::all();

            $dataAnggota = Anggota::join('users', 'users.id', '=', 'anggota.user_id')
                ->join('ormawa', 'ormawa.id', '=', 'anggota.ormawa_id')
                ->where('user_id', '=', Auth::user()->id)
                ->get(['anggota.*', 'users.name', 'ormawa.nama_id', 'ormawa.id']);

            $ormawaId = $dataAnggota->first()->ormawa_id;

            $prokerFiltered = $proker->where('id_ormawa', $ormawaId)
                                    ->whereIn('status_proker', ['Proses Pembina', 'Diajukan']);
            $prokerAjuan = $proker->where('id_ormawa', $ormawaId);

            return view('pages.pengajuan.proker.index', compact(
                'proker', 
                'jenisKegiatan', 
                'luaran', 
                'skims', 
                'dataAnggota', 
                'sasaran', 
                'sdgs', 
                'prokerFiltered',
                'prokerAjuan',
                'catatan_rab'
                ));
        }
    }

    public function createProker()
    {
        return view('pages.pengajuan.proker.create');
    }

    public function storeProker(Request $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'nama_proker'           => 'required|string|max:255',
                'skim'                  => 'required',
                'jenis_kegiatan'        => 'required',
                'id_ormawa'             => 'required',
                'id_luaran_kegiatan'    => 'required|array',
                'id_luaran_kegiatan.*'  => 'exists:luaran,id',
                
                // MODIFIKASI 1: Ubah ke nullable
                'indikator_sdgs'        => 'nullable|array', 
                'indikator_sdgs.*'      => 'nullable',
                'detail_sdgs'           => 'nullable|string',
                
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
                'persiapan_tempat'      => 'required|string|max:255',
                'persiapan_deskripsi'   => 'nullable|string',
                'persiapan_tanggal_mulai'   => 'required',
                'persiapan_tanggal_selesai' => 'required',
                'pelaksanaan_tempat'     => 'required|string|max:255',
                'pelaksanaan_deskripsi'  => 'nullable|string',
                'pelaksanaan_tanggal_mulai' => 'required',
                'pelaksanaan_tanggal_selesai' => 'required',
                'evaluasi_tempat'        => 'required|string|max:255',
                'evaluasi_deskripsi'     => 'nullable|string',
                'evaluasi_tanggal_mulai'   => 'required',
                'evaluasi_tanggal_selesai' => 'required',
                'pelaporan_tempat'       => 'required|string|max:255',
                'pelaporan_deskripsi'    => 'nullable|string',
                'pelaporan_tanggal_mulai'   => 'required',
                'pelaporan_tanggal_selesai' => 'required',
            ]);

            // Simpan Mekanisme
            $mekanisme = new Mekanisme();
            $mekanisme->fill([
                'persiapan_tempat' => $validatedData['persiapan_tempat'],
                'persiapan_deskripsi' => $validatedData['persiapan_deskripsi'],
                'persiapan_tanggal_mulai' => $validatedData['persiapan_tanggal_mulai'],
                'persiapan_tanggal_selesai' => $validatedData['persiapan_tanggal_selesai'],
                'pelaksanaan_tempat' => $validatedData['pelaksanaan_tempat'],
                'pelaksanaan_deskripsi' => $validatedData['pelaksanaan_deskripsi'],
                'pelaksanaan_tanggal_mulai' => $validatedData['pelaksanaan_tanggal_mulai'],
                'pelaksanaan_tanggal_selesai' => $validatedData['pelaksanaan_tanggal_selesai'],
                'evaluasi_tempat' => $validatedData['evaluasi_tempat'],
                'evaluasi_deskripsi' => $validatedData['evaluasi_deskripsi'],
                'evaluasi_tanggal_mulai' => $validatedData['evaluasi_tanggal_mulai'],
                'evaluasi_tanggal_selesai' => $validatedData['evaluasi_tanggal_selesai'],
                'pelaporan_tempat' => $validatedData['pelaporan_tempat'],
                'pelaporan_tanggal_mulai' => $validatedData['pelaporan_tanggal_mulai'],
                'pelaporan_tanggal_selesai' => $validatedData['pelaporan_tanggal_selesai'],
                'pelaporan_deskripsi' => $validatedData['pelaporan_deskripsi'],
                'created_at' => now('Asia/Jakarta'),
                'updated_at' => now('Asia/Jakarta'),
            ]);
            $mekanisme->save();

            if ($validatedData['sasaran'] !== 'Lainnya') {
                $validatedData['lainnya'] = null;
            }

            $ormawa = Ormawa::findOrFail($validatedData['id_ormawa']);
            
            // Perbaikan: Gunakan ID langsung dari objek yang baru disimpan
            $mekanismeId = $mekanisme->id;

            $jumlahProkerSaatIni = Proker::whereYear('created_at', date('Y'))
                ->where('id_ormawa', $ormawa->id)
                ->count();

            $nextNumber = $jumlahProkerSaatIni + 1;
            $nomorUrut = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            $idKegiatan = $ormawa->UID . '.' . $nomorUrut;
            
            $indikator = Indikator::where('ormawa_id', $ormawa->id)->latest()->first();

            // MODIFIKASI 2: Logika SDGS Kosong
            $sdgsValue = '0';
            $isSdgsEmpty = false;

            if (!empty($request->indikator_sdgs)) {
                $sdgsValue = implode(',', $request->indikator_sdgs);
            } else {
                $isSdgsEmpty = true;
            }

            $proker = new Proker();
            $proker->id_kegiatan = $idKegiatan;
            $proker->id_ormawa = $ormawa->id;
            $proker->id_skim = $validatedData['skim'];
            $proker->id_jenis_kegiatan = $validatedData['jenis_kegiatan'];
            $proker->id_indikator = $indikator->id ?? null;
            $proker->id_mekanisme_rancangan = $mekanismeId;
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
            
            // MODIFIKASI 3: Masukkan nilai SDGS (0 atau hasil implode)
            $proker->indikator_sdgs = $sdgsValue;
            $proker->detail_sdgs = $validatedData['detail_sdgs'];
            
            $proker->tahun_anggaran = date('Y');
            $proker->created_at = now('Asia/Jakarta');
            $proker->updated_at = now('Asia/Jakarta');
            $proker->save();

            // Log Ajuan
            $logs = new LogsAjuan();
            $logs->proker_id = $proker->id;
            $logs->action = 'Pengajuan Proker';
            $logs->description = 'Proker telah diajukan oleh ' . Auth::user()->name;
            $logs->status = 'Diajukan';
            $logs->updated_by = auth()->user()->id;
            $logs->save();

            DB::commit();

            // MODIFIKASI 4: Handling Toast
            if ($isSdgsEmpty) {
                toast()->warning('Info', 'Proker disimpan tanpa Indikator SDGS.');
            } else {
                toast()->success('Success', 'Program kerja berhasil diajukan.');
            }

            return redirect()->route('user.ajuan.proker');

        } catch (ValidationException $e) {
            DB::rollBack();
            toast()->error('Gagal', 'Validasi gagal.');
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            toast()->error('Gagal', 'Terjadi kesalahan sistem. Silakan coba lagi. Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $prokerstatus = Proker::where('id', $id)->value('status_proker');
        if($prokerstatus == 'Review' || $prokerstatus == 'Disetujui' || $prokerstatus == 'Ajuan RAB' || $prokerstatus == 'Proses Pembina'){
            toast()->warning('Peringatan', 'Proker tidak dapat diedit karena sedang dalam proses review atau telah disetujui.');
            return redirect()->route('user.index');
        }else{
        
            try {
                // Ambil data proker beserta relasinya (Ormawa & Mekanisme)
                $proker = Proker::with(['ormawa', 'mekanisme'])->findOrFail($id);

                // Ambil data Master untuk Dropdown (Sama seperti di function create/index)
                $skims = Skim::all();
                $jenisKegiatan = JenisKegiatan::all();
                $luaran = Luaran::all();
                $sdgs = SDG::all();
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
                    'sasaran',
                    'sdgs'
                ));

            } catch (\Exception $e) {
                toast()->error('Error', 'Data tidak ditemukan.');
                return redirect()->back();
            }
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

            'indikator_sdgs'        => 'nullable|array', 
            'indikator_sdgs.*'      => 'nullable',
            'detail_sdgs'           => 'nullable|string',

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
            'persiapan_tempat'       => 'required|string|max:255',
            'persiapan_deskripsi'    => 'nullable|string',
            'persiapan_tanggal_mulai'  => 'required',
            'persiapan_tanggal_selesai' => 'required',
            'pelaksanaan_tempat'     => 'required|string|max:255',
            'pelaksanaan_deskripsi'  => 'nullable|string',
            'pelaksanaan_tanggal_mulai' => 'required',
            'pelaksanaan_tanggal_selesai' => 'required',
            'evaluasi_tempat'        => 'required|string|max:255',
            'evaluasi_deskripsi'     => 'nullable|string',
            'evaluasi_tanggal_mulai'   => 'required',
            'evaluasi_tanggal_selesai' => 'required',
            'pelaporan_tempat'       => 'required|string|max:255',
            'pelaporan_deskripsi'    => 'nullable|string',
            'pelaporan_tanggal_mulai'  => 'required',
            'pelaporan_tanggal_selesai' => 'required',
        ]);

        DB::beginTransaction();

        try {
            // Ambil Data Proker Lama
            $proker = Proker::findOrFail($id);

            // Ambil Data Mekanisme Lama yang terhubung
            $mekanisme = Mekanisme::findOrFail($proker->id_mekanisme_rancangan);

            // 2. Update Tabel Mekanisme
            $mekanisme->persiapan_tempat = $validatedData['persiapan_tempat'];
            $mekanisme->persiapan_deskripsi = $validatedData['persiapan_deskripsi'];
            $mekanisme->persiapan_tanggal_mulai = $validatedData['persiapan_tanggal_mulai'];
            $mekanisme->persiapan_tanggal_selesai = $validatedData['persiapan_tanggal_selesai'];
            $mekanisme->pelaksanaan_tempat = $validatedData['pelaksanaan_tempat'];
            $mekanisme->pelaksanaan_deskripsi = $validatedData['pelaksanaan_deskripsi'];
            $mekanisme->pelaksanaan_tanggal_mulai = $validatedData['pelaksanaan_tanggal_mulai'];
            $mekanisme->pelaksanaan_tanggal_selesai = $validatedData['pelaksanaan_tanggal_selesai'];
            $mekanisme->evaluasi_tempat = $validatedData['evaluasi_tempat'];
            $mekanisme->evaluasi_deskripsi = $validatedData['evaluasi_deskripsi'];
            $mekanisme->evaluasi_tanggal_mulai = $validatedData['evaluasi_tanggal_mulai'];
            $mekanisme->evaluasi_tanggal_selesai = $validatedData['evaluasi_tanggal_selesai'];
            $mekanisme->pelaporan_tempat = $validatedData['pelaporan_tempat'];
            $mekanisme->pelaporan_deskripsi = $validatedData['pelaporan_deskripsi'];
            $mekanisme->pelaporan_tanggal_mulai = $validatedData['pelaporan_tanggal_mulai'];
            $mekanisme->pelaporan_tanggal_selesai = $validatedData['pelaporan_tanggal_selesai'];
            
            $mekanisme->updated_at = now('Asia/Jakarta');
            $mekanisme->save();

            // 3. Logic Sasaran (Sama seperti store)
            if ($validatedData['sasaran'] !== 'Lainnya') {
                $validatedData['lainnya'] = null;
            }

            $sdgsValue = '0';
            $isSdgsEmpty = false;

            if (!empty($request->indikator_sdgs)) {
                $sdgsValue = implode(',', $request->indikator_sdgs);
            } else {
                $isSdgsEmpty = true;
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

            // Update Indikator SDGS
            $proker->indikator_sdgs = $sdgsValue;
            $proker->detail_sdgs = $validatedData['detail_sdgs'];
            
            $proker->updated_at = now('Asia/Jakarta');
            $proker->status_proker = 'Review';
            
            $proker->save();

            DB::commit();

            toast()->success('Berhasil', 'Program kerja berhasil diperbarui.');
            return redirect()->route('user.index');

        } catch (ValidationException $e) {
            DB::rollBack();
            toast()->error('Gagal', 'Validasi gagal. Periksa kembali inputan Anda.');
            return redirect()->back()->withErrors($e->errors())->withInput();
        
        } catch (\Exception $e) {
            DB::rollBack();

            toast()->error('Gagal', 'Terjadi kesalahan sistem saat memperbarui data.');
            return redirect()->back()->withInput();
        }
    }

    public function lacakProker($id)
    {
        $proker = Proker::findOrFail($id);
        $logs = LogsAjuan::where('proker_id', $proker->id)->orderBy('created_at', 'desc')->get();

        return view('pages.pengajuan.proker.lacak', compact('proker', 'logs'));
    }

    public function reviewProker($id)
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

            return view('pages.pengajuan.proker.review', compact(
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

    public function approveProker($id, Request $request)
    {
        try {
           
            $proker = Proker::findOrFail($id);
            $proker->status_proker = 'Ajuan RAB';
            $proker->notes = $request->input('catatan');
            $proker->updated_at = now('Asia/Jakarta');
            
            $proker->save();

            $logs = new LogsAjuan();
            $logs->proker_id = $id;
            $logs->action = 'Ajukan RAB Proker';
            $logs->description = 'Proker telah disetujui oleh pembina. Silakan ajukan RAB. Catatan: ' . $request->input('catatan');
            $logs->status = 'Ajuan RAB';
            $logs->updated_by = auth()->user()->id;
            $logs->created_at = now('Asia/Jakarta');
            $logs->updated_at = now('Asia/Jakarta');
            $logs->save();

            toast()->success('Berhasil', 'Program kerja telah disetujui.');
            return redirect()->route('user.ajuan.proker');

        } catch (\Exception $e) {
            Log::error('System Error approveProker: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            toast()->error('Gagal', 'Terjadi kesalahan sistem saat menyetujui program kerja.'. $e->getMessage());
            return redirect()->route('user.ajuan.proker');
        }
    }

    public function rejectProker(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);

        try {
            $proker = Proker::findOrFail($id);
            $proker->status_proker = 'Ditolak';
            $proker->notes = "Pembina: " . $request->input('catatan');
            $proker->updated_at = now('Asia/Jakarta');
            $proker->save();

            $logs = new LogsAjuan();
            $logs->proker_id = $id;
            $logs->action = 'Proker Ditolak';
            $logs->description = 'Proker telah ditolak oleh pembina. Alasan: ' . $request->input('catatan');
            $logs->status = 'Ditolak';
            $logs->updated_by = auth()->user()->id;
            $logs->created_at = now('Asia/Jakarta');
            $logs->updated_at = now('Asia/Jakarta');
            $logs->save();

            toast()->success('Berhasil', 'Program kerja telah ditolak.');
            return redirect()->route('user.ajuan.proker');

        } catch (\Exception $e) {
            Log::error('System Error rejectProker: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            toast()->error('Gagal', 'Terjadi kesalahan sistem saat menolak program kerja.'. $e->getMessage());
            return redirect()->back();
        }
    }

    public function revisiProker(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);

        try {
            $proker = Proker::findOrFail($id);
            $proker->status_proker = 'Revisi';
            $proker->notes = "Pembina: " . $request->input('catatan');
            $proker->updated_at = now('Asia/Jakarta');
            $proker->save();

            $logs = new LogsAjuan();
            $logs->proker_id = $id;
            $logs->action = 'Permintaan Revisi Proker';
            $logs->description = 'Proker memerlukan revisi. Catatan: ' . $request->input('catatan');
            $logs->status = 'Revisi';
            $logs->updated_by = auth()->user()->id;
            $logs->created_at = now('Asia/Jakarta');
            $logs->updated_at = now('Asia/Jakarta');
            $logs->save();

            // Simpan catatan revisi (implementasi sesuai kebutuhan Anda)

            toast()->success('Berhasil', 'Permintaan revisi telah dikirim.');
            return redirect()->route('user.ajuan.proker');

        } catch (\Exception $e) {
            Log::error('System Error revisiProker: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            toast()->error('Gagal', 'Terjadi kesalahan sistem saat mengirim permintaan revisi.'. $e->getMessage());
            return redirect()->back();
        }
    }
}

