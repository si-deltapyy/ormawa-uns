@extends('layouts.dashboard')

@section('head')
<link href="{{ asset('assets/css/inputpage.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
<div>
    <h4 class="page-title">Pengajuan Proker</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Halaman untuk mengajukan program kerja baru</li>
    </ol>
</div>

<button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#modalProkerBaru">
    <i class="mdi mdi-plus-circle mr-2"></i> Ajukan Proker Baru
</button>

{{-- Main --}}
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
                            <th>Status Ajuan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($proker as $data)
                        <tr>
                            <td>{{ $data->id_kegiatan }}</td>
                            <td>{{ $data->nama_kegiatan }}</td>
                            <td>
                                {{-- Tanggal Dibuat --}}
                                <div class="text-dark fw-bold">
                                    {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y') }}
                                </div>

                                {{-- Jam Dibuat --}}
                                <span class="badge badge-soft-primary mt-1">
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
                                        @elseif($data->status_proker == 'Ditolak')
                                            <span class="badge badge-danger">Proker Ditolak</span>
                                        @endif
                                    </div>

                                    <div class="mb-1">
                                        @if($data->status_rab == 'Disetujui')
                                            <span class="badge badge-success">RABDisetujui</span>
                                        @elseif($data->status_rab == 'Ditolak')
                                            <span class="badge badge-danger">RAB Ditolak</span>
                                        @elseif($data->status_rab == 'Menunggu')
                                            <span class="badge badge-warning">Menunggu RAB</span>
                                        @else
                                            <span class="badge badge-secondary">Belum Mengajukan RAB</span>
                                        @endif
                                    </div>

                                    <div class="mb-1">
                                        @if($data->verifikasi_admin == 'Terverifikasi')
                                            <span class="badge badge-success">Terverifikasi Admin</span>
                                        @else
                                            <span class="badge badge-warning">Belum Terverifikasi Admin</span>
                                        @endif
                                    </div>

                                    <div class="mb-1">
                                        @if($data->status_pelaksanaan == 'Selesai')
                                            <span class="badge badge-success">Proker Selesai</span>
                                        @elseif($data->status_pelaksanaan == 'Sedang Dilaksanakan')
                                            <span class="badge badge-primary">Sedang Dilaksanakan</span>
                                        @else
                                            <span class="badge badge-secondary">Proker Belum Dilaksanakan</span>
                                        @endif
                                    </div>

                                    <div class="mb-1">
                                        @if($data->status_laporan == 'Sudah Diupload')
                                            <span class="badge badge-success">Sudah Upload LPJ / SPJ</span>
                                        @else
                                            <span class="badge badge-danger ">Belum Upload LPJ / SPJ</span>
                                        @endif
                                    </div>

                                    <div>
                                        @if($data->status_aktif == 'Aktif')
                                            <span class="badge badge-success">Proker Aktif</span>
                                        @elseif($data->status_aktif == 'Tidak Aktif')
                                            <span class="badge badge-danger">Proker Kadaluwarsa</span>
                                        @else
                                            <span class="badge badge-secondary">Proker Belum Aktif</span>
                                        @endif
                                    </div>

                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-row gap-1">
                                    {{-- <a href="" class=" mb-1">
                                        <i class="mdi font-size-18 mdi-eye-outline mr-3"></i>
                                    </a> --}}
                                    {{-- <a href="" class=" mb-1">
                                        <i class="mdi font-size-18 mdi-file-document-outline mr-3"></i>
                                    </a> --}}
                                    <a href="{{ route('user.ajuan.proker.edit', $data->id) }}" class="mb-1">
                                        <i class="mdi font-size-18 mdi-pencil-outline mr-3"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<div class="modal fade" id="modalProkerBaru" tabindex="-1" aria-labelledby="modalProkerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        
        <form class="modal-content" id="formProkerWizard" action="{{ route('user.ajuan.proker.store') }}" method="POST" enctype="multipart/form-data">
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
                                <option value="{{ $skim->id }}">{{ $skim->kode_skim }}.{{ $skim->nama_skim }}</option>
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
                        <label for="persiapan_tanggal" class="form-label fw-bold text-dark">Tanggal</label>
                        <input type="date" class="form-control" id="persiapan_tanggal" name="persiapan_tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="persiapan_tempat" class="form-label fw-bold text-dark">Tempat</label>
                        <input type="text" class="form-control" id="persiapan_tempat" name="persiapan_tempat" required>
                    </div>
                    <div class="mb-3">
                        <label for="persiapan_waktu" class="form-label fw-bold text-dark">Waktu</label>
                        <input type="text" class="form-control" id="persiapan_waktu" name="persiapan_waktu" placeholder="Pilih waktu..." required>
                    </div>
                    <div class="mb-3">
                        <label for="persiapan_deskripsi" class="form-label fw-bold text-dark">Deskripsi</label>
                        <textarea class="form-control" id="persiapan_deskripsi" name="persiapan_deskripsi" rows="3" required></textarea>
                    </div>

                    <br>
                    <h4 class="mb-3 text-dark">B. Pelaksanaan</h4>
                    <div class="mb-3">
                        <label for="pelaksanaan_tanggal" class="form-label fw-bold text-dark">Tanggal</label>
                        <input type="date" class="form-control" id="pelaksanaan_tanggal" name="pelaksanaan_tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="pelaksanaan_tempat" class="form-label fw-bold text-dark">Tempat</label>
                        <input type="text" class="form-control" id="pelaksanaan_tempat" name="pelaksanaan_tempat" required>
                    </div>
                    <div class="mb-3">
                        <label for="pelaksanaan_waktu" class="form-label fw-bold text-dark">Waktu</label>
                        <input type="text" class="form-control" id="pelaksanaan_waktu" name="pelaksanaan_waktu" placeholder="Pilih waktu..." required>
                    </div>
                    <div class="mb-3">
                        <label for="pelaksanaan_deskripsi" class="form-label fw-bold text-dark">Deskripsi</label>
                        <textarea class="form-control" id="pelaksanaan_deskripsi" name="pelaksanaan_deskripsi" rows="3" required></textarea>
                    </div>

                    <br>
                    <h4 class="mb-3 text-dark">C. Evaluasi</h4>
                    <div class="mb-3">
                        <label for="evaluasi_tanggal" class="form-label fw-bold text-dark">Tanggal</label>
                        <input type="date" class="form-control" id="evaluasi_tanggal" name="evaluasi_tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="evaluasi_tempat" class="form-label fw-bold text-dark">Tempat</label>
                        <input type="text" class="form-control" id="evaluasi_tempat" name="evaluasi_tempat" required>
                    </div>
                    <div class="mb-3">
                        <label for="evaluasi_waktu" class="form-label fw-bold text-dark">Waktu</label>
                        <input type="text" class="form-control" id="evaluasi_waktu" name="evaluasi_waktu" placeholder="Pilih waktu..." required>
                    </div>
                    <div class="mb-3">
                        <label for="evaluasi_deskripsi" class="form-label fw-bold text-dark">Deskripsi</label>
                        <textarea class="form-control" id="evaluasi_deskripsi" name="evaluasi_deskripsi" rows="3" required></textarea>
                    </div>

                    <br>
                    <h4 class="mb-3 text-dark">D. Pelaporan</h4>
                    <div class="mb-3">
                        <label for="pelaporan_tanggal" class="form-label fw-bold text-dark">Tanggal</label>
                        <input type="date" class="form-control" id="pelaporan_tanggal" name="pelaporan_tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="pelaporan_tempat" class="form-label fw-bold text-dark">Tempat</label>
                        <input type="text" class="form-control" id="pelaporan_tempat" name="pelaporan_tempat" required>
                    </div>
                    <div class="mb-3">
                        <label for="pelaporan_waktu" class="form-label fw-bold text-dark">Waktu</label>
                        <input type="text" class="form-control" id="pelaporan_waktu" name="pelaporan_waktu" placeholder="Pilih waktu..." required>
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
                <button type="submit" class="btn btn-success d-none" id="btn-submit">Simpan Pengajuan</button>
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

<script>
    // 3. Aktifkan Flatpickr pada ID tersebut
    flatpickr("#persiapan_waktu", {
        enableTime: true,       // Mengaktifkan waktu
        noCalendar: true,       // Menyembunyikan kalender (hanya waktu)
        dateFormat: "H:i",      // Format Jam:Menit (24 jam)
        time_24hr: true         // Opsi kunci untuk mematikan AM/PM
    });

    flatpickr("#pelaksanaan_waktu", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });

    flatpickr("#evaluasi_waktu", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });

    flatpickr("#pelaporan_waktu", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });

</script>
<script>
    $(document).ready(function() {
        // Event saat modal guide akan muncul
        $('#guideModal').on('show.bs.modal', function (event) {
            // Ambil tombol yang diklik (relatedTarget)
            var button = $(event.relatedTarget); 
            
            // Ambil data dari atribut tombol
            var title = button.data('title');
            var content = button.data('content');
            
            // Update isi modal menggunakan jQuery
            var modal = $(this);
            modal.find('.modal-title').text(title);
            modal.find('#guideModalContent').text(content);
        });
    });
</script>
@endsection