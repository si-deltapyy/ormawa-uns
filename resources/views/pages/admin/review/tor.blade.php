@extends('layouts.dashboard')

@section('title')
    Review Program Kerja - MAWA UNS
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Review Program Kerja</h3>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Review Proker</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Kolom Kiri: Detail Utama --}}
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title text-white mb-0">3. Mekanisme & Rancangan</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="fw-bold" width="30%">Indikator</th>
                                <th class="text-center fw-bold" width="35%">Target Awal {{ date('Y')-1 }}</th>
                                <th class="text-center fw-bold" width="35%">Realisasi {{ date('Y') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">Pendelegasian Kompetisi</td>
                                <td class="text-center">{{ $proker->indikator->pendelegasian_kompetisi_target }}</td>
                                <td class="text-center">{{ $proker->indikator->pendelegasian_kompetisi_realisasi }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Pendelegasian Non Kompetisi</td>
                                <td class="text-center">{{ $proker->indikator->pendelegasian_non_kompetisi_target }}</td>
                                <td class="text-center">{{ $proker->indikator->pendelegasian_non_kompetisi_realisasi }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Penyelenggaraan Kompetisi</td>
                                <td class="text-center">{{ $proker->indikator->penyelenggaraan_kompetisi_target }}</td>
                                <td class="text-center">{{ $proker->indikator->penyelenggaraan_kompetisi_realisasi }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Penyelenggaraan Non Kompetisi</td>
                                <td class="text-center">{{ $proker->indikator->penyelenggaraan_non_kompetisi_target }}</td>
                                <td class="text-center">{{ $proker->indikator->penyelenggaraan_non_kompetisi_realisasi }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">SDGs</td>
                                <td class="text-center">{{ $proker->indikator->sdg_target }}</td>
                                <td class="text-center">{{ $proker->indikator->sdg_realisasi }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0 text-white">1. Informasi Kegiatan</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="text-muted mb-0">Judul Program Kerja</label>
                        <h4 class="fw-bold">{{ $proker->nama_kegiatan }}</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-0">Organisasi Mahasiswa (Ormawa)</label>
                        <div class="fw-bold font-size-16">{{ $proker->ormawa->nama_id ?? '-' }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-0">Status Pengajuan</label>
                        <div>
                            @if($proker->status_proker == 'Proses Pembina')
                                <span class="badge badge-info font-size-12">Sedang Di Review Pembina</span>
                            @elseif($proker->status_proker == 'Disetujui')
                                <span class="badge badge-success font-size-12">Disetujui</span>
                            @elseif($proker->status_proker == 'Review')
                                <span class="badge badge-warning font-size-12">Tahap Revisi Oleh Reviewer</span>
                            @elseif($proker->status_proker == 'Ditolak')
                                <span class="badge badge-danger font-size-12">Ditolak</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <hr>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="text-muted mb-0">Skim Kegiatan</label>
                        {{-- Asumsi relasi skim ada --}}
                        <div class="text-dark">
                            {{ $proker->skim->nama_skim ?? '-' }}
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="text-muted mb-0">Jenis Kegiatan</label>
                        {{-- Asumsi relasi jenisKegiatan ada --}}
                        <div class="text-dark">{{ $proker->jenisKegiatan->jenis_kegiatan ?? '-' }}</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="text-muted mb-0">Sasaran Peserta</label>
                        <div class="text-dark">
                            {{ $proker->sasaran_kegiatan }}
                            @if($proker->sasaran_kegiatan == 'Lainnya')
                                <span class="text-muted">({{ $proker->lainnya }})</span>
                            @endif
                        </div>
                    </div>
                </div>

                @php
                    $sdgs = explode(',', $proker->indikator_sdgs);
                    $sdgsList = \App\Models\SDG::whereIn('id', $sdgs)->get();
                @endphp

                <div class="row">
                     <div class="col-md-6 mb-3">
                        <label class="text-muted mb-0">Indikator SDGs</label>
                        <div class="text-dark">
                            @foreach($sdgsList as $item)
                                <span class="badge badge-soft-primary font-size-12 mb-1">{{ $item->nama_sdgs }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-0">Detail SDGs</label>
                        <div class="text-dark">{{ $proker->detail_sdgs }}</div>
                    </div>
                </div>

                
                
                <div class="row">
                     <div class="col-md-6 mb-3">
                        <label class="text-muted mb-0">Tanggal Mulai</label>
                        <div class="fw-bold"><i class="mdi mdi-calendar mr-1"></i> {{ \Carbon\Carbon::parse($proker->tanggal_mulai)->isoFormat('D MMMM Y') }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-0">Tanggal Selesai</label>
                        <div class="fw-bold"><i class="mdi mdi-calendar mr-1"></i> {{ \Carbon\Carbon::parse($proker->tanggal_selesai)->isoFormat('D MMMM Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section Narasi --}}
        <div class="card">
             <div class="card-header bg-dark text-white">
                <h5 class="card-title text-white mb-0">2. Detail Deskriptif</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="font-weight-bold text-primary">Latar Belakang</h6>
                    <p class="text-justify bg-light p-3 rounded">{{ $proker->latar_belakang }}</p>
                </div>

                <div class="mb-4">
                    <h6 class="font-weight-bold text-primary">Tujuan Kegiatan</h6>
                    <p class="text-justify bg-light p-3 rounded">{{ $proker->tujuan_kegiatan }}</p>
                </div>

                <div class="mb-4">
                    <h6 class="font-weight-bold text-primary">Rasionalisasi</h6>
                    <p class="text-justify bg-light p-3 rounded">{{ $proker->rasionalisasi_kegiatan }}</p>
                </div>

                <div class="mb-0">
                    <h6 class="font-weight-bold text-primary">Keberlanjutan</h6>
                    <p class="text-justify bg-light p-3 rounded">{{ $proker->keberlanjutan_kegiatan }}</p>
                </div>
            </div>
        </div>
        
        {{-- Section Mekanisme (Tabel) --}}
        
    </div>

    {{-- Kolom Kanan: Info Pendukung & Aksi --}}
    <div class="col-lg-4">
        
        {{-- Card PIC --}}
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title text-white mb-0">Penanggung Jawab (PIC)</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="avatar-sm mx-auto mb-2">
                        <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-20">
                            {{ substr($proker->nama_pic, 0, 1) }}
                        </span>
                    </div>
                    <h5 class="font-size-16 mb-1">{{ $proker->nama_pic }}</h5>
                    <p class="text-muted mb-0">NIM: {{ $proker->nim_pic }}</p>
                </div>
                <hr>
                <a href="https://wa.me/{{ $proker->kontak_pic }}" target="_blank" class="btn btn-success btn-block waves-effect waves-light">
                    <i class="mdi mdi-whatsapp mr-1"></i> Hubungi PIC
                </a>
            </div>
        </div>

        {{-- Card Luaran --}}
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0 text-white">Target Luaran</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Luaran</th>
                            <th class="text-center">Target</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // 1. Decode JSON target luaran dari database (contoh: {"1":"10", "2":"5"})
                            $targets = json_decode($proker->target_luaran, true) ?? [];

                            // 2. Ambil SEMUA luaran yang ada di sistem
                            $allLuaran = \App\Models\Luaran::all(); 
                        @endphp

                        @foreach($allLuaran as $item)
                            <tr>
                                <td>{{ $item->nama_luaran }}</td>
                                <td class="text-center fw-bold">
                                    {{-- 
                                    Cek apakah ID luaran ini ada di dalam array $targets. 
                                    Jika ada, tampilkan nilainya. Jika tidak, tampilkan 0.
                                    --}}
                                    {{ isset($targets[$item->id]) ? $targets[$item->id] : 0 }}
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Card Aksi Pembina --}}
        <div class="card">
            <div class="card-header bg-dark text-white">
                @role('user')
                <h5 class="card-title mb-0 text-white"><i class="mdi mdi-gavel mr-1"></i> Aksi Pembina</h5>
                @endrole
                @role('admin')
                <h5 class="card-title mb-0 text-white"><i class="mdi mdi-gavel mr-1"></i> Keputusan Reviewer TOR</h5>
                @endrole
            </div>
            <div class="card-body">
                <p class="text-muted">Silakan berikan keputusan terhadap pengajuan program kerja ini.</p>
                
                <div class="d-grid gap-1">
                    <div class="row mb-3">
                        <div class="col-4">
                            <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalApprove">
                                <i class="mdi mdi-check-circle-outline mr-1"></i> Setujui
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#modalRevisi">
                                <i class="mdi mdi-pencil-outline mr-1"></i> Revisi
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modalReject">
                                <i class="mdi mdi-close-circle-outline mr-1"></i> Tolak
                            </button>
                        </div>
                    </div>
                    <a href="{{ route('admin.review.proker') }}" class="btn btn-secondary btn-block">
                        <i class="mdi mdi-arrow-left mr-1"></i> Kembali ke Daftar
                    </a>
                    <a href="{{ route('admin.user.pdfView.tor', $proker->id ) }}" target="_blank" class="btn btn-secondary btn-block">
                        <i class="mdi mdi-arrow-left mr-1"></i> Lihat Dalam Template
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mb-4">
        @role('admin')
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0 text-white">Indikator Kinerja</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th width="8%">IK</th>
                            <th>Nama IK</th>
                            <th width="8%">P</th>
                            <th>Nama Program</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($indikator->where('group_skim_id', $proker->id_skim) as $item)
                            <tr>
                                <td>{{ $item->kode_kinerja }}</td>
                                <td>{{ $item->nama_kinerja }}</td>
                                <td>{{ $item->kode_program ?? '-' }}</td>
                                <td>{{ $item->nama_program ?? '-' }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        @endrole
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title text-white mb-0">3. Mekanisme & Rancangan</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="20%">Tahapan</th>
                                <th width="20%">Tanggal Mulai</th>
                                <th width="20%">Tanggal Selesai</th>
                                <th width="20%">Tempat</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- A. Persiapan --}}
                            <tr>
                                <td class="fw-bold">A. Persiapan</td>
                                <td>{{ \Carbon\Carbon::parse($proker->mekanisme->persiapan_tanggal_mulai)->isoFormat('D MMM Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($proker->mekanisme->persiapan_tanggal_selesai)->isoFormat('D MMM Y') }}</td>
                                <td>{{ $proker->mekanisme->persiapan_tempat }}</td>
                                <td>{{ $proker->mekanisme->persiapan_deskripsi ?? '-' }}</td>
                            </tr>
                            {{-- B. Pelaksanaan --}}
                            <tr>
                                <td class="fw-bold">B. Pelaksanaan</td>
                                <td>{{ \Carbon\Carbon::parse($proker->mekanisme->pelaksanaan_tanggal_mulai)->isoFormat('D MMM Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($proker->mekanisme->pelaksanaan_tanggal_selesai)->isoFormat('D MMM Y') }}</td>
                                <td>{{ $proker->mekanisme->pelaksanaan_tempat }}</td>
                                <td>{{ $proker->mekanisme->pelaksanaan_deskripsi ?? '-' }}</td>
                            </tr>
                             {{-- C. Evaluasi --}}
                            <tr>
                                <td class="fw-bold">C. Evaluasi</td>
                                <td>{{ \Carbon\Carbon::parse($proker->mekanisme->evaluasi_tanggal_mulai)->isoFormat('D MMM Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($proker->mekanisme->evaluasi_tanggal_selesai)->isoFormat('D MMM Y') }}</td>
                                <td>{{ $proker->mekanisme->evaluasi_tempat }}</td>
                                <td>{{ $proker->mekanisme->evaluasi_deskripsi ?? '-' }}</td>
                            </tr>
                             {{-- D. Pelaporan --}}
                            <tr>
                                <td class="fw-bold">D. Pelaporan</td>
                                <td>{{ \Carbon\Carbon::parse($proker->mekanisme->pelaporan_tanggal_mulai)->isoFormat('D MMM Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($proker->mekanisme->pelaporan_tanggal_selesai)->isoFormat('D MMM Y') }}</td>
                                <td>{{ $proker->mekanisme->pelaporan_tempat }}</td>
                                <td>{{ $proker->mekanisme->pelaporan_deskripsi ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- MODAL APPROVE --}}
<div class="modal fade" id="modalApprove" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('admin.review.tor.approve', $proker->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title text-white">Konfirmasi Persetujuan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menyetujui program kerja <b>{{ $proker->nama_kegiatan }}</b>?</p>
                <div class="form-group">
                    <label>Catatan (Opsional)</label>
                    <textarea name="catatan" class="form-control" rows="2" placeholder="Berikan catatan semangat atau arahan..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Ya, Setujui</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL REJECT --}}
<div class="modal fade" id="modalReject" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('admin.review.tor.reject', $proker->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title text-white">Tolak </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Program kerja <b>{{ $proker->nama_kegiatan }}</b> akan dikembalikan ke status revisi/ditolak.</p>
                <div class="form-group">
                    <label class="text-danger fw-bold">Alasan Penolakan *</label>
                    <textarea name="catatan" class="form-control" rows="4" required placeholder="Jelaskan bagian mana yang perlu diperbaiki..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalRevisi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('admin.review.tor.revisi', $proker->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title text-white">Minta Revisi</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Program kerja <b>{{ $proker->nama_kegiatan }}</b> akan dikembalikan ke status revisi.</p>
                <div class="form-group">
                    <label class="text-warning fw-bold">Catatan Revisi TOR*</label>
                    <textarea name="catatan_tor" class="form-control" rows="4" required placeholder="Jelaskan bagian mana yang perlu diperbaiki..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning">Kirim Revisi</button>
            </div>
        </form>
    </div>
</div>

@endsection