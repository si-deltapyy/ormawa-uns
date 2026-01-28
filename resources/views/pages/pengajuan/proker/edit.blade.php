@extends('layouts.dashboard')

@section('head')
    <link href="{{ asset('assets/css/inputpage.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Edit Program Kerja</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('user.ajuan.proker') }}">Proker</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        
                        {{-- Form Wizard Edit --}}
                        <form id="formProkerWizard" action="{{ route('user.ajuan.proker.update', $proker->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- Penting untuk Update --}}

                            {{-- Step Indicators (Tetap dipertahankan agar UX sama) --}}
                            <div class="step-indicators mb-4">
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

                            {{-- STEP 1: Data Kegiatan --}}
                            <div class="form-step active" id="step-1">
                                <h6 class="mb-3 text-primary">1. Data Kegiatan</h6>
                                
                                {{-- Nama Proker --}}
                                <div class="mb-3">
                                    <label for="nama_proker" class="form-label fw-bold text-dark">Nama Proker</label>
                                    {{-- DB: nama_kegiatan, Input Name: nama_proker --}}
                                    <input type="text" class="form-control @error('nama_proker') is-invalid @enderror" 
                                        id="nama_proker" name="nama_proker" 
                                        value="{{ old('nama_proker', $proker->nama_kegiatan) }}" required>
                                    @error('nama_proker')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Ormawa (Readonly) --}}
                                <div class="mb-3">
                                    <label for="nama_ormawa" class="form-label fw-bold text-dark">Ormawa</label>
                                    <input type="text" class="form-control" id="nama_ormawa" name="nama_ormawa" readonly
                                        value="{{ $proker->ormawa->nama_id ?? '-' }}">
                                    <input type="hidden" name="id_ormawa" value="{{ $proker->id_ormawa }}">
                                </div>

                                {{-- Skim --}}
                                <div class="mb-3">
                                    <label for="skim" class="form-label fw-bold text-dark">Skim Kegiatan</label>
                                    <select class="form-control" id="skim" name="skim" required>
                                        <option value="" disabled>Pilih Skim</option>
                                        @foreach($skims as $skim)
                                            <option value="{{ $skim->id }}" {{ (old('skim', $proker->id_skim) == $skim->id) ? 'selected' : '' }}>
                                                {{ $skim->kode_skim }}.{{ $skim->nama_skim }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Jenis Kegiatan --}}
                                <div class="mb-3">
                                    <label for="jenis_kegiatan" class="form-label fw-bold text-dark">Jenis Kegiatan</label>
                                    <select class="form-control" id="jenis_kegiatan" name="jenis_kegiatan" required>
                                        <option value="" disabled>Pilih Jenis Kegiatan</option>
                                        @foreach($jenisKegiatan as $jenis)
                                            <option value="{{ $jenis->id }}" {{ (old('jenis_kegiatan', $proker->id_jenis_kegiatan) == $jenis->id) ? 'selected' : '' }}>
                                                {{ $jenis->jenis_kegiatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Luaran (Multiple Select) --}}
                                <div class="mb-3">
                                    <label for="luaran" class="form-label fw-bold text-dark">Luaran</label>
                                    @php
                                        // Konversi string "1,2,3" menjadi array [1,2,3] untuk pengecekan selected
                                        $selectedLuaran = explode(',', $proker->id_luaran_kegiatan);
                                    @endphp
                                    <select class="form-control" id="luaran" name="id_luaran_kegiatan[]" multiple required style="height: 150px;">
                                        @foreach($luaran as $l)
                                            <option value="{{ $l->id }}" {{ (in_array($l->id, old('id_luaran_kegiatan', $selectedLuaran))) ? 'selected' : '' }}>
                                                {{ $l->nama_luaran }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Tahan CTRL/Command untuk memilih lebih dari satu.</small>
                                </div>

                                {{-- Sasaran --}}
                                <div class="mb-3">
                                    <label for="sasaran" class="form-label fw-bold text-dark">Sasaran Peserta</label>
                                    <select class="form-control" id="sasaran" name="sasaran" required onchange="cekSasaran(this)">
                                        <option value="" disabled>Pilih Sasaran</option>
                                        @foreach($sasaran as $key => $value)
                                            <option value="{{ $value }}" {{ (old('sasaran', $proker->sasaran_kegiatan) == $value) ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Sasaran Lainnya --}}
                                <div class="mb-3 {{ (old('sasaran', $proker->sasaran_kegiatan) == 'Lainnya') ? '' : 'd-none' }}" id="div-lainnya">
                                    <label for="lainnya" class="form-label fw-bold text-dark">Sebutkan Sasaran Lainnya</label>
                                    <input type="text" class="form-control" id="lainnya" name="lainnya" 
                                        value="{{ old('lainnya', $proker->lainnya) }}" 
                                        placeholder="Masukkan sasaran peserta..." {{ (old('sasaran', $proker->sasaran_kegiatan) == 'Lainnya') ? '' : 'disabled' }}>
                                </div>
                            </div>

                            {{-- STEP 2: Detail Proker --}}
                            <div class="form-step" id="step-2">
                                <h6 class="mb-3 text-primary">2. Detail Proker</h6>
                                
                                {{-- Latar Belakang --}}
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <label class="form-label fw-bold text-dark mb-0 me-2">Latar Belakang Kegiatan</label>
                                    </div>
                                    <textarea class="form-control" id="latarbelakang_kegiatan" name="latarbelakang_kegiatan" rows="4" required>{{ old('latarbelakang_kegiatan', $proker->latar_belakang) }}</textarea>
                                </div>

                                {{-- Tujuan --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Tujuan Kegiatan</label>
                                    <textarea class="form-control" id="tujuan_kegiatan" name="tujuan_kegiatan" rows="4" required>{{ old('tujuan_kegiatan', $proker->tujuan_kegiatan) }}</textarea>
                                </div>

                                {{-- Rasionalisasi --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Rasionalisasi Kegiatan</label>
                                    <textarea class="form-control" id="rasionalisasi_kegiatan" name="rasionalisasi_kegiatan" rows="4" required>{{ old('rasionalisasi_kegiatan', $proker->rasionalisasi_kegiatan) }}</textarea>
                                </div>

                                {{-- Keberlanjutan --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Keberlanjutan Kegiatan</label>
                                    <textarea class="form-control" id="keberlanjutan_kegiatan" name="keberlanjutan_kegiatan" rows="4" required>{{ old('keberlanjutan_kegiatan', $proker->keberlanjutan_kegiatan) }}</textarea>
                                </div>
                            </div>

                            {{-- STEP 3: Detail Luaran (Dynamic) --}}
                            <div class="form-step" id="step-3">
                                <h6 class="mb-3 text-primary">3. Detail Luaran</h6>
                                {{-- Container ini akan diisi ulang oleh JS, tapi kita perlu mempassing data lama --}}
                                <div id="container-detail-luaran">
                                    {{-- Note: Input di sini biasanya digenerate JS berdasarkan dropdown step 1. 
                                        Kita perlu script khusus di bawah untuk pre-fill data ini --}}
                                </div>
                                {{-- Hidden input untuk menyimpan data JSON luaran lama agar bisa dibaca JS --}}
                                <textarea id="old_target_luaran" class="d-none">{{ $proker->target_luaran }}</textarea>
                            </div>

                            {{-- STEP 4: Mekanisme & Rancangan --}}
                            <div class="form-step" id="step-4">
                                <h6 class="mb-3 text-primary">4. Mekanisme dan Rancangan</h6>

                                {{-- A. Persiapan --}}
                                <h4 class="mb-3 text-dark mt-3">A. Persiapan</h4>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Tanggal</label>
                                    <input type="date" class="form-control" name="persiapan_tanggal" value="{{ old('persiapan_tanggal', $proker->mekanisme->persiapan_tanggal ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Tempat</label>
                                    <input type="text" class="form-control" name="persiapan_tempat" value="{{ old('persiapan_tempat', $proker->mekanisme->persiapan_tempat ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Waktu</label>
                                    <input type="text" class="form-control time-picker" name="persiapan_waktu" value="{{ old('persiapan_waktu', $proker->mekanisme->persiapan_waktu ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Deskripsi</label>
                                    <textarea class="form-control" name="persiapan_deskripsi" rows="3">{{ old('persiapan_deskripsi', $proker->mekanisme->persiapan_deskripsi ?? '') }}</textarea>
                                </div>

                                {{-- B. Pelaksanaan --}}
                                <h4 class="mb-3 text-dark mt-3">B. Pelaksanaan</h4>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Tanggal</label>
                                    <input type="date" class="form-control" name="pelaksanaan_tanggal" value="{{ old('pelaksanaan_tanggal', $proker->mekanisme->pelaksanaan_tanggal ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Tempat</label>
                                    <input type="text" class="form-control" name="pelaksanaan_tempat" value="{{ old('pelaksanaan_tempat', $proker->mekanisme->pelaksanaan_tempat ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Waktu</label>
                                    <input type="text" class="form-control time-picker" name="pelaksanaan_waktu" value="{{ old('pelaksanaan_waktu', $proker->mekanisme->pelaksanaan_waktu ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Deskripsi</label>
                                    <textarea class="form-control" name="pelaksanaan_deskripsi" rows="3">{{ old('pelaksanaan_deskripsi', $proker->mekanisme->pelaksanaan_deskripsi ?? '') }}</textarea>
                                </div>

                                {{-- C. Evaluasi --}}
                                <h4 class="mb-3 text-dark mt-3">C. Evaluasi</h4>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Tanggal</label>
                                    <input type="date" class="form-control" name="evaluasi_tanggal" value="{{ old('evaluasi_tanggal', $proker->mekanisme->evaluasi_tanggal ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Tempat</label>
                                    <input type="text" class="form-control" name="evaluasi_tempat" value="{{ old('evaluasi_tempat', $proker->mekanisme->evaluasi_tempat ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Waktu</label>
                                    <input type="text" class="form-control time-picker" name="evaluasi_waktu" value="{{ old('evaluasi_waktu', $proker->mekanisme->evaluasi_waktu ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Deskripsi</label>
                                    <textarea class="form-control" name="evaluasi_deskripsi" rows="3">{{ old('evaluasi_deskripsi', $proker->mekanisme->evaluasi_deskripsi ?? '') }}</textarea>
                                </div>

                                {{-- D. Pelaporan --}}
                                <h4 class="mb-3 text-dark mt-3">D. Pelaporan</h4>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Tanggal</label>
                                    <input type="date" class="form-control" name="pelaporan_tanggal" value="{{ old('pelaporan_tanggal', $proker->mekanisme->pelaporan_tanggal ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Tempat</label>
                                    <input type="text" class="form-control" name="pelaporan_tempat" value="{{ old('pelaporan_tempat', $proker->mekanisme->pelaporan_tempat ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Waktu</label>
                                    <input type="text" class="form-control time-picker" name="pelaporan_waktu" value="{{ old('pelaporan_waktu', $proker->mekanisme->pelaporan_waktu ?? '') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Deskripsi</label>
                                    <textarea class="form-control" name="pelaporan_deskripsi" rows="3">{{ old('pelaporan_deskripsi', $proker->mekanisme->pelaporan_deskripsi ?? '') }}</textarea>
                                </div>
                            </div>

                            {{-- STEP 5: PIC & Waktu --}}
                            <div class="form-step" id="step-5">
                                <h6 class="mb-3 text-primary">5. PIC & Waktu Pelaksanaan</h6>

                                {{-- PIC --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">NIM PIC</label>
                                    <input type="text" class="form-control" id="nim_pic" name="nim_pic" value="{{ old('nim_pic', $proker->nim_pic) }}" required placeholder="Ketik NIM..." onchange="cariMahasiswa(this.value)">
                                    <small class="text-danger d-none" id="error-nim">Mahasiswa tidak ditemukan!</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">Nama PIC</label>
                                    {{-- Display Only --}}
                                    <input type="text" class="form-control" id="nama_pic_display" value="{{ old('nama_pic', $proker->nama_pic) }}" readonly>
                                    {{-- Value to submit --}}
                                    <input type="hidden" name="nama_pic" id="nama_pic_value" value="{{ old('nama_pic', $proker->nama_pic) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark">No. Whatsapp PIC</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="mdi mdi-whatsapp"></i></span>
                                        <input type="tel" class="form-control" id="no_hp_pic" name="no_hp_pic" value="{{ old('no_hp_pic', $proker->kontak_pic) }}" required>
                                    </div>
                                </div>

                                {{-- Tanggal Mulai/Selesai Proker --}}
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold text-dark">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $proker->tanggal_mulai) }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold text-dark">Tanggal Selesai</label>
                                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', $proker->tanggal_selesai) }}" required>
                                    </div>
                                </div>

                                {{-- Konfirmasi --}}
                                <div class="alert alert-warning">
                                    Anda sedang dalam mode <b>Edit</b>. Pastikan perubahan data sudah benar.
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="setuju" name="setuju" required checked>
                                    <label for="setuju" class="form-check-label">Saya menyatakan bahwa perubahan data ini benar.</label>
                                </div>
                            </div>

                            {{-- Tombol Navigasi --}}
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-secondary d-none" id="btn-prev" onclick="changeStep(-1)">Kembali</button>
                                <div></div> {{-- Spacer --}}
                                <button type="button" class="btn btn-primary" id="btn-next" onclick="changeStep(1)">Lanjut</button>
                                <button type="submit" class="btn btn-success d-none" id="btn-submit">Simpan Perubahan Data</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
{{-- JS Logic Wizard --}}
<script src="{{ asset('assets/js/inputprokerpage.js') }}"></script> 
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    $(document).ready(function() {
        // 1. Init Flatpickr untuk input waktu (Time Picker)
        flatpickr(".time-picker", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });

        // 2. Logic Khusus Edit: Trigger Generate Input Luaran
        // Kita perlu memicu fungsi pembuatan input target luaran berdasarkan data yang tersimpan
        var rawTarget = $('#old_target_luaran').val();
        if(rawTarget) {
            try {
                var targetJson = JSON.parse(rawTarget);
                // Asumsi: di inputprokerpage.js ada fungsi untuk generate input
                // Anda mungkin perlu menyesuaikan script JS Anda agar bisa menerima data default
                // Contoh Logic Manual jika JS Anda belum support pre-fill:
                $('#luaran option:selected').each(function() {
                    var id = $(this).val();
                    var text = $(this).text();
                    var val = targetJson[id] || ''; // Ambil value dari JSON
                    
                    // Append input manual (Sesuaikan dengan logic JS asli Anda)
                    // $('#container-detail-luaran').append(...)
                });
                
                // Jika script inputprokerpage.js menggunakan event 'change' pada #luaran
                // Kita bisa trigger manual, tapi value targetnya harus di-inject via JS
                $('#luaran').trigger('change'); 
                
                // Timeout sebentar agar input ter-render, lalu isi valuenya
                setTimeout(function(){
                    $.each(targetJson, function(key, value){
                        $('input[name="target_luaran['+key+']"]').val(value);
                    });
                }, 500);

            } catch(e) {
                console.error("Gagal parse JSON target luaran", e);
            }
        }
    });
</script>
@endsection