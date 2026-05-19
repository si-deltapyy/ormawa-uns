@extends('layouts.dashboard')

@section('title')
    Pengajuan Program Kerja - MAWA UNS
@endsection

@section('head')
<link href="{{ asset('assets/css/inputpage.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')

@can('ketua-ormawa')
    <div>
        <h4 class="page-title">Pengajuan Proker</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Halaman untuk mengajukan program kerja baru</li>
        </ol>
    </div>
@endcan

@can('pembina-ormawa')
    <div>
        <h4 class="page-title">Review Proker</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Halaman untuk review list proker program kerja baru</li>
        </ol>
    </div>
@endcan

@can('ketua-ormawa')
    <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#modalProkerBaru">
        <i class="mdi mdi-plus-circle mr-2"></i> Ajukan Proker Baru
    </button>
@endcan

{{-- <div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4 text-center">Waktu Pengisian Proker</h4>

        <div class="d-flex justify-content-center gap-3 text-center" id="countdown-wrapper">
        
            <div class="timer-box mr-3" id="box-days">
                <div id="days" class="h2 fw-bold mb-0 text-primary">00</div>
                <small class="text-muted">Hari</small>
            </div>
            
            <div class="timer-box mr-3">
                <div id="hours" class="h2 fw-bold mb-0 text-primary">00</div>
                <small class="text-muted">Jam</small>
            </div>

            <div class="timer-box mr-3">
                <div id="minutes" class="h2 fw-bold mb-0 text-primary">00</div>
                <small class="text-muted">Menit</small>
            </div>

            <div class="timer-box mr-3">
                <div id="seconds" class="h2 fw-bold mb-0 text-primary">00</div>
                <small class="text-muted">Detik</small>
            </div>
        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Logs Ajuan Proker</h4>

                <table id="dataproker-ajuan" class="table ">
                    <thead>
                        <tr>
                            <th>ID Kegiatan</th>
                            <th>Nama Proker</th>
                            <th>Tanggal Ajuan</th>
                            @can('ketua-ormawa')
                            <th>Status Ajuan</th>
                            <th>Catatan TOR</th>
                            <th>Catatan RAB</th>
                            @endcan
                            @can('pembina-ormawa')
                            {{-- <th>Status Ajuan</th> --}}
                            @endcan
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    @can('ketua-ormawa')
                    <tbody>
                        @forelse($prokerAjuan as $data)
                        <tr>
                            <td>{{ $data->id_kegiatan }}</td>
                            <td>
                                <div class="text-dark fw-bold">
                                    {{ $data->nama_kegiatan }}
                                </div>
                                <span class="badge badge-soft-secondary mt-1">
                                    <a href="{{ route('user.ajuan.proker.lacak', $data->id) }}" class="text-secondary">
                                        <i class="mdi mdi-map-marker mr-1"></i>
                                        Lacak Ajuan
                                    </a>
                                </span>
                            </td>
                            <td>
                                {{-- Tanggal Dibuat --}}
                                <div class="text-dark fw-bold">
                                    {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y') }}
                                </div>

                                {{-- Jam Dibuat --}}
                                <span class="badge badge-soft-success text-success mt-1">
                                    <i class="mdi mdi-clock-outline mr-1"></i> 
                                    {{ \Carbon\Carbon::parse($data->created_at)->format('H:i') }} WIB
                                </span>

                                {{-- Keterangan Diperbarui (Hanya muncul jika pernah diedit) --}}
                                @if($data->updated_at > $data->created_at)
                                    <div class="text-muted mt-1" style="font-size: 11px; font-style: italic;">
                                        <i class="mdi mdi-pencil-outline mr-1"></i>
                                        Diperbarui {{ \Carbon\Carbon::parse($data->updated_at)->locale('id')->diffForHumans() }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    
                                    <div class="mb-1">
                                        @if($data->status_proker == 'Diajukan')
                                            <span class="badge badge-info">Proker Diajukan</span>
                                        @elseif($data->status_proker == 'Disetujui')
                                            <span class="badge badge-success">Proker Disetujui</span>
                                        @elseif($data->status_proker == 'Review')
                                            <span class="badge badge-soft-warning">Sedang Review TOR</span>
                                        @elseif ($data->status_proker == 'Proses Pembina')
                                            <span class="badge badge-primary">Proker Dalam Peninjauan Pembina</span>
                                        @elseif($data->status_proker == 'Ajuan RAB')
                                            <span class="badge badge-soft-warning">Lengkapi Data RAB</span>
                                        @elseif($data->status_proker == 'Revisi')
                                            <span class="badge badge-warning">Revisi TOR Proker</span>
                                        @elseif($data->status_proker == 'Ditolak')
                                            <span class="badge badge-danger">Proker Ditolak</span>
                                        @endif
                                    </div>

                                    <div class="mb-1">
                                        @if($data->status_rab == 'Disetujui')
                                            <span class="badge badge-success">RAB Disetujui</span>
                                        @elseif($data->status_rab == 'Ditolak')
                                            <span class="badge badge-danger">RAB Ditolak</span>
                                        @elseif($data->status_rab == 'Menunggu')
                                            <span class="badge badge-soft-warning">Sedang Review RAB</span>
                                        @elseif($data->status_rab == 'Revisi')
                                            <span class="badge badge-warning">Revisi RAB</span>
                                        @else
                                            <span class="badge badge-soft-info ">Belum Mengajukan RAB</span>
                                        @endif
                                    </div>

                                    <div class="mb-1">
                                        @if($data->verifikasi_admin == 'Terverifikasi')
                                            <span class="badge badge-success">Terverifikasi Admin</span>
                                        @else
                                            <span class="badge badge-soft-info">Belum Terverifikasi Admin</span>
                                        @endif
                                    </div>

                                    <div class="mb-1">
                                        @if($data->status_pelaksanaan == 'Selesai')
                                            <span class="badge badge-success">Proker Selesai</span>
                                        @elseif($data->status_pelaksanaan == 'Sedang Dilaksanakan')
                                            <span class="badge badge-primary">Sedang Dilaksanakan</span>
                                        @else
                                            <span class="badge badge-soft-info">Proker Belum Dilaksanakan</span>
                                        @endif
                                    </div>

                                    <div class="mb-1">
                                        @if($data->status_laporan == 'Sudah Diupload')
                                            <span class="badge badge-success">Sudah Upload LPJ / SPJ</span>
                                        @else
                                            <span class="badge badge-soft-info ">Belum Upload LPJ / SPJ</span>
                                        @endif
                                    </div>

                                    <div>
                                        @if($data->status_aktif == 'Aktif')
                                            <span class="badge badge-success">Proker Aktif</span>
                                        @elseif($data->status_aktif == 'Tidak Aktif')
                                            <span class="badge badge-danger">Proker Kadaluwarsa</span>
                                        @else
                                            <span class="badge badge-soft-danger">Proker Belum Aktif</span>
                                        @endif
                                    </div>

                                </div>
                            </td>
                            <td>
                                @if($data->notes)
                                    <div style="max-width: 300px; white-space: pre-wrap;">{{ $data->notes }}</div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($catatan_rab && $catatan_rab->proker_id == $data->id)
                                    <div style="max-width: 300px; white-space: pre-wrap;">{{ $catatan_rab->catatan }}</div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            <td>
                                <div class="d-flex flex-column gap-3 align-items-start">
                                @if( $data->status_proker == 'Revisi' && $data->status_rab == 'Revisi' )
                                    <a href="{{ route('user.ajuan.proker.edit', $data->id) }}" class="badge badge-soft-warning w-100 text-start py-2">
                                        <i class="mdi font-size-18 mdi-pencil-outline mr-1 align-middle"></i>
                                        <span class="font-size-12 align-middle">Revisi Pengajuan</span>
                                    </a>
                                    <a href="{{ route('user.ajuan.rab.index', $data->id) }}" class="badge badge-soft-primary w-100 text-start py-2">
                                        <i class="mdi font-size-18 mdi-pencil-outline mr-1 align-middle"></i>
                                        <span class="font-size-12 align-middle">Revisi RAB</span>
                                    </a>
                                @elseif( $data->status_proker == 'Ajuan RAB' && $data->status_rab == 'Revisi' )
                                    <a href="#" class="badge badge-soft-success w-100 text-start py-2 mb-2" muted>
                                        <i class="mdi font-size-18 mdi-check-outline mr-1 align-middle"></i>
                                        <span class="font-size-12 align-middle" muted>Sudah Direvisi</span>
                                    </a>
                                    <a href="{{ route('user.ajuan.rab.index', $data->id) }}" class="badge badge-soft-primary w-100 text-start py-2">
                                        <i class="mdi font-size-18 mdi-pencil-outline mr-1 align-middle"></i>
                                        <span class="font-size-12 align-middle">Revisi RAB</span>
                                    </a>
                                @elseif ($data->status_proker == 'Ajuan RAB' && $data->status_rab == 'Belum Mengajukan')
                                    <a href="{{ route('user.ajuan.rab.index', $data->id) }}" class="badge badge-soft-primary w-100 text-start py-2">
                                        <i class="mdi font-size-18 mdi-file-document-outline mr-1 align-middle"></i>
                                        <span class="font-size-12 align-middle">Lengkapi Data RAB</span>
                                    </a>
                                @elseif ($data->status_rab == 'Menunggu' && $data->status_proker == 'Review')
                                        <span class="badge badge-soft-success w-100 text-start py-2" muted>
                                            <i class="mdi font-size-18 mdi-file-document-outline mr-1 align-middle"></i>
                                            Sudah Lengkap
                                        </span>
                                @endif
                            </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada pengajuan proker.</td>
                        </tr>
                        @endforelse
                    </tbody>
                    @endcan
                    @can('pembina-ormawa')
                    <tbody>
                        @forelse($prokerFiltered as $data)
                        <tr>
                            <td>{{ $data->id_kegiatan }}</td>
                            <td>{{ $data->nama_kegiatan }}</td>
                            <td>
                                {{-- Tanggal Dibuat --}}
                                <div class="text-dark fw-bold">
                                    {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y') }}
                                </div>

                                {{-- Jam Dibuat --}}
                                <span class="badge badge-soft-success mt-1">
                                    <i class="mdi mdi-clock-outline mr-1"></i> 
                                    {{ \Carbon\Carbon::parse($data->created_at)->format('H:i') }} WIB
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-row gap-3">
                                    
                                    @if ($data->status_proker === 'Diajukan')
                                    <form method="POST" action="{{ route('pembina.assign.proker', ['id' => $data->id]) }}">
                                        @csrf
                                        <button type="submit" class="badge badge-soft-success border-0" style="cursor: pointer; background-color: rgba(52, 195, 143, 0.18); color: #34c38f;">
                                            <i class="mdi font-size-18 mdi-file-eye-outline align-middle"></i>
                                            <span class="font-size-12 mr-2">Tugaskan ke Saya</span>
                                        </button>
                                    </form>
                                    @elseif ($data->status_proker === 'Proses Pembina')
                                    <a href="{{ route('pembina.review.proker', $data->id) }}" class=" mb-1 badge badge-soft-info mr-1">
                                        <i class="mdi font-size-18 mdi-file-eye-outline">
                                        </i>
                                        <span class="font-size-12 mr-2"> Review Ajuan</span>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada pengajuan proker yang sedang diproses.</td>
                        </tr>
                        @endforelse
                    </tbody>
                    @endcan
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<div class="modal fade" id="modalProkerBaru" tabindex="-1" aria-labelledby="modalProkerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        
        <form class="modal-content" id="formProkerWizard" action="{{ route('user.ajuan.proker.store') }}" method="POST" enctype="multipart/form-data" onsubmit="this.submitButton.disabled=true;">
            @csrf
            
            <div class="modal-header">
                <h5 class="modal-title" id="modalProkerLabel">Form Ajuan Proker Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="step-indicators">
                    <div class="step-indicator active" id="indicator-1">1</div>
                    <div class="step-line" id="line-1"></div>
                    <div class="step-indicator" id="indicator-2">2</div>
                    <div class="step-line" id="line-2"></div>
                    <div class="step-indicator" id="indicator-3">3</div>
                    <div class="step-line" id="line-3"></div>
                    <div class="step-indicator" id="indicator-4">4</div>
                    <div class="step-line" id="line-4"></div>
                    <div class="step-indicator" id="indicator-5">5</div>
                </div>

                <div class="form-step active" id="step-1">
                    <h6 class="mb-3 text-primary">1. Data Kegiatan</h6>
                    <div class="mb-3">
                        <label for="nama_proker" class="form-label fw-bold text-dark">Nama Proker</label>
                        <input type="text" class="form-control @error('nama_proker') is-invalid @enderror" 
                        id="nama_proker" name="nama_proker" value="{{ old('nama_proker') }}" required>

                        @error('nama_proker')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_ormawa" class="form-label fw-bold text-dark">Ormawa</label>
                        <input type="text" class="form-control" id="nama_ormawa" name="nama_ormawa" readonly
                            value="{{ $dataAnggota->first()->nama_id }}">
                        <input type="hidden" name="id_ormawa" value="{{ $dataAnggota->first()->ormawa_id }}">
                    </div>
                    <div class="mb-3">
                        <label for="skim" class="form-label fw-bold text-dark">Skim Kegiatan</label>
                        <select class="form-control" id="skim" name="skim" required>
                            <option value="" disabled selected>Pilih Skim</option>
                            @foreach($skims as $skim)
                                <option value="{{ $skim->id }}">{{ $skim->nama_skim }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kegiatan" class="form-label fw-bold text-dark">Jenis Kegiatan</label>
                        <select class="form-control" id="jenis_kegiatan" name="jenis_kegiatan" required>
                            <option value="" disabled selected>Pilih Jenis Kegiatan</option>
                            @foreach($jenisKegiatan as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->jenis_kegiatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="luaran" class="form-label fw-bold text-dark">Luaran (Bisa pilih lebih dari satu)</label>
                        
                        <select class="form-control" id="luaran" name="id_luaran_kegiatan[]" multiple required style="height: 150px;">
                            @foreach($luaran as $l)
                                <option value="{{ $l->id }}">{{ $l->nama_luaran }}</option>
                            @endforeach
                        </select>
                        
                        <small class="text-muted">Tahan tombol <b>CTRL</b> (Windows) atau <b>Command</b> (Mac) untuk memilih lebih dari satu.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Indikator SDGs (Bisa pilih lebih dari satu, Atau dikosongkan)</label>
                        
                        {{-- Checkbox Pilih Semua --}}
                        <div class="form-check mb-2 ps-1">
                            <input type="checkbox" class="form-check-input" id="select-all-sdgs">
                            <label for="select-all-sdgs" class="form-check-label fw-bold">Pilih Semua</label>
                        </div>

                        {{-- Container Scrollable untuk Daftar SDGs --}}
                        <div class="border rounded p-3" style="height: 150px; overflow-y: auto; background-color: #fff;">
                            @foreach($sdgs as $item) {{-- Ganti alias jadi $item agar tidak bentrok --}}
                                <div class="form-check">
                                    {{-- name="indikator_sdgs[]" array agar bisa dikirim multiple ke controller --}}
                                    <input class="form-check-input sdgs-item" type="checkbox" 
                                        value="{{ $item->id }}" 
                                        id="sdg_{{ $item->id }}" 
                                        name="indikator_sdgs[]">
                                    
                                    <label class="form-check-label" for="sdg_{{ $item->id }}">
                                        {{ $item->nama_sdgs }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        
                        <small class="text-muted mt-1 d-block">Gulir ke bawah untuk melihat lebih banyak.</small>
                    </div>

                    <div class="mb-3">
                        <label for="detail_sdgs" class="form-label fw-bold text-dark">Detail SDGs</label>
                        <textarea class="form-control" id="detail_sdgs" name="detail_sdgs" rows="3" 
                            placeholder="Berikan Detail SDGs yang dipilih...">{{ old('detail_sdgs') }}</textarea>    
                    </div>

                    <div class="mb-3">
                        <label for="sasaran" class="form-label fw-bold text-dark">Sasaran Peserta</label>
                        <select class="form-control" id="sasaran" name="sasaran" required onchange="cekSasaran(this)">
                            <option value="" disabled selected>Pilih Sasaran</option>
                            @foreach($sasaran as $key => $value)
                                <option value="{{ $value }}" {{ old('sasaran') == $value ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 d-none" id="div-lainnya">
                        <label for="lainnya" class="form-label fw-bold text-dark">Sebutkan Sasaran Lainnya</label>
                        <input type="text" class="form-control" id="lainnya" name="lainnya" placeholder="Masukkan sasaran peserta..." disabled>
                    </div>
                </div>

                <div class="form-step" id="step-5">
                    <h6 class="mb-3 text-primary">5. PIC & Waktu Pelaksanaan</h6>

                    <div class="mb-3">
                        <label for="nim_pic" class="form-label fw-bold text-dark">NIM PIC Proker</label>
                        <input type="text" class="form-control" id="nim_pic" name="nim_pic" required 
                            placeholder="Ketik NIM lalu tekan Enter/Tab" onchange="cariMahasiswa(this.value)">
                        <small class="text-danger d-none" id="error-nim">Mahasiswa tidak ditemukan!</small>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pic" class="form-label fw-bold text-dark">Nama PIC Proker</label>
                        <input type="text" class="form-control" id="nama_pic_display" readonly placeholder="Nama akan muncul otomatis..." readonly>
                        <input type="hidden" name="nama_pic" id="nama_pic_value">
                    </div>

                    <div class="mb-3">
                        <label for="no_hp_pic" class="form-label fw-bold text-dark">No. Whatsapp PIC</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="mdi mdi-whatsapp"></i></span>
                            
                            <input type="tel" class="form-control" id="no_hp_pic" name="no_hp_pic" 
                                placeholder="Contoh: 812xxxx (Otomatis 62)" required>
                        </div>
                        <small class="text-muted">Nomor akan otomatis diformat menjadi 62...</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_mulai" class="form-label fw-bold text-dark">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_selesai" class="form-label fw-bold text-dark">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                        </div>
                    </div>
                    <div class="alert alert-info">
                        Silakan cek kembali data yang Anda masukkan sebelum menyimpan.
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="setuju" name="setuju" required>
                        <label for="setuju" class="form-check-label">Saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan.</label>
                    </div>
                </div>

                <div class="form-step" id="step-2">
                    <h6 class="mb-3 text-primary">2. Detail Proker</h6>
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-1">
                            <label for="latarbelakang_kegiatan" class="form-label fw-bold text-dark mb-0 me-2">Latar Belakang Kegiatan</label>
                            <a href="javascript:void(0)" class="text-primary" 
                            data-toggle="modal" 
                            data-target="#guideModal" 
                            data-title="Panduan: Latar Belakang" 
                            data-content="Jelaskan alasan mendasar mengapa kegiatan ini perlu dilaksanakan. Sertakan data atau kondisi aktual yang menjadi dasar pemikiran.">
                                <i class="mdi font-size-18 mdi-help-circle mr-2" style="font-size: 1.1rem;"></i>
                            </a>
                        </div>
                        <textarea class="form-control" id="latarbelakang_kegiatan" name="latarbelakang_kegiatan" rows="4" required></textarea>
                        <div class="invalid-feedback">
                            Latar belakang kegiatan wajib diisi minimal 50 karakter.
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-1">
                            <label for="tujuan_kegiatan" class="form-label fw-bold text-dark mb-0 me-2">Tujuan Kegiatan</label>
                            <a href="javascript:void(0)" class="text-primary" 
                            data-toggle="modal" 
                            data-target="#guideModal"
                            data-title="Panduan: Tujuan Kegiatan" 
                            data-content="Uraikan target spesifik yang ingin dicapai melalui kegiatan ini. Tujuan harus realistis dan dapat diukur (SMART).">
                                <i class="mdi font-size-18 mdi-help-circle mr-2" style="font-size: 1.1rem;"></i>
                            </a>
                        </div>
                        <textarea class="form-control" id="tujuan_kegiatan" name="tujuan_kegiatan" rows="4" required></textarea>
                        <div class="invalid-feedback">
                            Tujuan kegiatan wajib diisi.
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-1">
                            <label for="rasionalisasi_kegiatan" class="form-label fw-bold text-dark mb-0 me-2">Rasionalisasi Kegiatan</label>
                            <a href="javascript:void(0)" class="text-primary" 
                            data-toggle="modal" 
                            data-target="#guideModal"
                            data-title="Panduan: Rasionalisasi Kegiatan" 
                            data-content="Jelaskan hubungan logis antara masalah yang ada (latar belakang) dengan solusi yang ditawarkan (kegiatan ini). Mengapa kegiatan ini adalah solusi terbaik?">
                                <i class="mdi font-size-18 mdi-help-circle mr-2" style="font-size: 1.1rem;"></i>
                            </a>
                        </div>
                        <textarea class="form-control" id="rasionalisasi_kegiatan" name="rasionalisasi_kegiatan" rows="4" required></textarea>
                        <div class="invalid-feedback">
                            Rasionalisasi kegiatan wajib diisi.
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-1">
                            <label for="keberlanjutan_kegiatan" class="form-label fw-bold text-dark mb-0 me-2">Keberlanjutan Kegiatan</label>
                            <a href="javascript:void(0)" class="text-primary" 
                            data-toggle="modal" 
                            data-target="#guideModal"
                            data-title="Panduan: Keberlanjutan Kegiatan" 
                            data-content="Jelaskan rencana tindak lanjut setelah kegiatan selesai. Bagaimana dampak kegiatan ini dapat terus dirasakan kedepannya?">
                                <i class="mdi font-size-18 mdi-help-circle mr-2" style="font-size: 1.1rem;"></i>
                            </a>
                        </div>
                        <textarea class="form-control" id="keberlanjutan_kegiatan" name="keberlanjutan_kegiatan" rows="4" required></textarea>
                        <div class="invalid-feedback">
                            Rencana keberlanjutan wajib diisi.
                        </div>
                    </div>
                    
                </div>

                <div class="form-step" id="step-3">
                    <h6 class="mb-3 text-primary">3. Detail Luaran</h6>
                    <div id="container-detail-luaran"></div>
                </div>

                <div class="form-step" id="step-4">
                    <h6 class="mb-3 text-primary">4. Mekanisme dan Rancangan</h6>
                    
                    <br>
                    <h4 class="mb-3 text-dark">A. Persiapan</h4>
                    <div class="mb-3">
                        <label for="persiapan_tempat" class="form-label fw-bold text-dark">Tempat</label>
                        <input type="text" class="form-control" id="persiapan_tempat" name="persiapan_tempat" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="persiapan_tanggal_mulai" class="form-label fw-bold text-dark">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="persiapan_tanggal_mulai" name="persiapan_tanggal_mulai" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="persiapan_tanggal_selesai" class="form-label fw-bold text-dark">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="persiapan_tanggal_selesai" name="persiapan_tanggal_selesai" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="persiapan_deskripsi" class="form-label fw-bold text-dark">Deskripsi</label>
                        <textarea class="form-control" id="persiapan_deskripsi" name="persiapan_deskripsi" rows="3" required></textarea>
                    </div>

                    <br>
                    <h4 class="mb-3 text-dark">B. Pelaksanaan</h4>
                    <div class="mb-3">
                        <label for="pelaksanaan_tempat" class="form-label fw-bold text-dark">Tempat</label>
                        <input type="text" class="form-control" id="pelaksanaan_tempat" name="pelaksanaan_tempat" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="pelaksanaan_tanggal_mulai" class="form-label fw-bold text-dark">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="pelaksanaan_tanggal_mulai" name="pelaksanaan_tanggal_mulai" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pelaksanaan_tanggal_selesai" class="form-label fw-bold text-dark">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="pelaksanaan_tanggal_selesai" name="pelaksanaan_tanggal_selesai" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="pelaksanaan_deskripsi" class="form-label fw-bold text-dark">Deskripsi</label>
                        <textarea class="form-control" id="pelaksanaan_deskripsi" name="pelaksanaan_deskripsi" rows="3" required></textarea>
                    </div>

                    <br>
                    <h4 class="mb-3 text-dark">C. Evaluasi</h4>
                    <div class="mb-3">
                        <label for="evaluasi_tempat" class="form-label fw-bold text-dark">Tempat</label>
                        <input type="text" class="form-control" id="evaluasi_tempat" name="evaluasi_tempat" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="evaluasi_tanggal_mulai" class="form-label fw-bold text-dark">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="evaluasi_tanggal_mulai" name="evaluasi_tanggal_mulai" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="evaluasi_tanggal_selesai" class="form-label fw-bold text-dark">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="evaluasi_tanggal_selesai" name="evaluasi_tanggal_selesai" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="evaluasi_deskripsi" class="form-label fw-bold text-dark">Deskripsi</label>
                        <textarea class="form-control" id="evaluasi_deskripsi" name="evaluasi_deskripsi" rows="3" required></textarea>
                    </div>

                    <br>
                    <h4 class="mb-3 text-dark">D. Pelaporan</h4>
                    <div class="mb-3">
                        <label for="pelaporan_tempat" class="form-label fw-bold text-dark">Tempat</label>
                        <input type="text" class="form-control" id="pelaporan_tempat" name="pelaporan_tempat" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="pelaporan_tanggal_mulai" class="form-label fw-bold text-dark">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="pelaporan_tanggal_mulai" name="pelaporan_tanggal_mulai" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pelaporan_tanggal_selesai" class="form-label fw-bold text-dark">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="pelaporan_tanggal_selesai" name="pelaporan_tanggal_selesai" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="pelaporan_deskripsi" class="form-label fw-bold text-dark">Deskripsi</label>
                        <textarea class="form-control" id="pelaporan_deskripsi" name="pelaporan_deskripsi" rows="3" required></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary d-none" id="btn-prev" onclick="changeStep(-1)">Kembali</button>
                <button type="button" class="btn btn-primary" id="btn-next" onclick="changeStep(1)">Lanjut</button>
                <button type="submit" name="submitButton" class="btn btn-success d-none" id="btn-submit">Simpan Pengajuan</button>
            </div>
            
        </form>
        
    </div>
</div>

<div class="modal fade" id="guideModal" tabindex="-1" role="dialog" aria-labelledby="guideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="guideModalLabel"><i class="mdi mdi-information-outline mr-2"></i>Panduan Pengisian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="guideModalContent" class="text-muted">Isi panduan akan muncul di sini.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Mengerti</button>
            </div>
        </div>
    </div>
</div>


@endsection


@section('scripts')
<script src="{{ asset('assets/js/inputprokerpage.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('assets/js/countdown.js') }}"></script>
@endsection