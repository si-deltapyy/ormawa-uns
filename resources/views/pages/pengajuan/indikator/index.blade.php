@extends('layouts.dashboard')

@section('content')
{{-- 1. Header Halaman (Breadcrumb) --}}
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Indikator Kinerja Utama ORMAWA</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('user.ajuan.proker') }}">Proker</a></li>
                    <li class="breadcrumb-item active">Indikator Kinerja Utama</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body mb-5">
                
                {{-- 2. Form Wizard --}}
                <form id="formProkerWizard" action="{{ route('user.input.indikator.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Indikator Langkah (Opsional, agar terlihat seperti Wizard) --}}
                    <div class="progress mb-4" style="height: 5px;">
                        <div class="progress-bar" role="progressbar" style="width: 20%;" id="progressBar"></div>
                    </div>

                    {{-- STEP 1: Data Kegiatan --}}
                    <div class="form-step active" id="step-1">
                        <h5 class="card-title text-primary mb-4"><i class="mdi mdi-file-document-outline me-2"></i>1. Data Kegiatan</h5>
                        
                        <div class="mb-2 mt-4">
                            <label for="nama_proker" class="form-label fw-bold text-dark">Pendelegasian Kompetisi <span class="text-danger">*</span></label>
                            <div class="row g-2">
                            {{-- Kolom Kiri --}}
                            <div class="col-md-6">
                                <label for="delkom_realisasi" class="form-label fw-bold text-dark">Realisasi 2025</label>
                                <input type="number" class="form-control @error('delkom_realisasi') is-invalid @enderror" 
                                    id="delkom_realisasi" name="delkom_realisasi" 
                                    value="{{ old('delkom_realisasi') }}" 
                                    placeholder="Masukkan angka..." required>
                                    
                                @error('delkom_realisasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kolom Kanan --}}
                            <div class="col-md-6">
                                <label for="delkom_target" class="form-label fw-bold text-dark">Target 2026</label>
                                <input type="number" class="form-control @error('delkom_target') is-invalid @enderror" 
                                    id="delkom_target" name="delkom_target" 
                                    value="{{ old('delkom_target') }}" 
                                    placeholder="Masukkan angka..." required>

                                @error('delkom_target')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-2 mt-4">
                            <label for="nama_proker" class="form-label fw-bold text-dark">Pendelegasian Non Kompetisi <span class="text-danger">*</span></label>
                            <div class="row g-2">
                            {{-- Kolom Kiri --}}
                            <div class="col-md-6">
                                <label for="delnonkom_realisasi" class="form-label fw-bold text-dark">Realisasi 2025</label>
                                <input type="number" class="form-control @error('delnonkom_realisasi') is-invalid @enderror" 
                                    id="delnonkom_realisasi" name="delnonkom_realisasi" 
                                    value="{{ old('delnonkom_realisasi') }}" 
                                    placeholder="Masukkan angka..." required>
                                    
                                @error('delnonkom_realisasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kolom Kanan --}}
                            <div class="col-md-6">
                                <label for="delnonkom_target" class="form-label fw-bold text-dark">Target 2026</label>
                                <input type="number" class="form-control @error('delnonkom_target') is-invalid @enderror" 
                                    id="delnonkom_target" name="delnonkom_target" 
                                    value="{{ old('delnonkom_target') }}" 
                                    placeholder="Masukkan angka..." required>

                                @error('delnonkom_target')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-2 mt-4">
                            <label for="nama_proker" class="form-label fw-bold text-dark">Penyelenggaraan Kompetisi <span class="text-danger">*</span></label>
                            <div class="row g-2">
                            {{-- Kolom Kiri --}}
                            <div class="col-md-6">
                                <label for="penkom_realisasi" class="form-label fw-bold text-dark">Realisasi 2025</label>
                                <input type="number" class="form-control @error('penkom_realisasi') is-invalid @enderror" 
                                    id="penkom_realisasi" name="penkom_realisasi" 
                                    value="{{ old('penkom_realisasi') }}" 
                                    placeholder="Masukkan angka..." required>
                                    
                                @error('penkom_realisasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kolom Kanan --}}
                            <div class="col-md-6">
                                <label for="penkom_target" class="form-label fw-bold text-dark">Target 2026</label>
                                <input type="number" class="form-control @error('penkom_target') is-invalid @enderror" 
                                    id="penkom_target" name="penkom_target" 
                                    value="{{ old('penkom_target') }}" 
                                    placeholder="Masukkan angka..." required>

                                @error('penkom_target')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-2 mt-4">
                            <label for="nama_proker" class="form-label fw-bold text-dark">Penyelenggaraan Non Kompetisi <span class="text-danger">*</span></label>
                            <div class="row g-2">
                            {{-- Kolom Kiri --}}
                            <div class="col-md-6">
                                <label for="pennonkom_realisasi" class="form-label fw-bold text-dark">Realisasi 2025</label>
                                <input type="number" class="form-control @error('pennonkom_realisasi') is-invalid @enderror" 
                                    id="pennonkom_realisasi" name="pennonkom_realisasi" 
                                    value="{{ old('pennonkom_realisasi') }}" 
                                    placeholder="Masukkan angka..." required>
                                    
                                @error('pennonkom_realisasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kolom Kanan --}}
                            <div class="col-md-6">
                                <label for="pennonkom_target" class="form-label fw-bold text-dark">Target 2026</label>
                                <input type="number" class="form-control @error('pennonkom_target') is-invalid @enderror" 
                                    id="pennonkom_target" name="pennonkom_target" 
                                    value="{{ old('pennonkom_target') }}" 
                                    placeholder="Masukkan angka..." required>

                                @error('pennonkom_target')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-2 mt-4">
                            <label for="nama_proker" class="form-label fw-bold text-dark">SDGs <span class="text-danger">*</span></label>
                            <div class="row g-2">
                            {{-- Kolom Kiri --}}
                            <div class="col-md-6">
                                <label for="sdg_realisasi" class="form-label fw-bold text-dark">Realisasi 2025</label>
                                <input type="number" class="form-control @error('sdg_realisasi') is-invalid @enderror" 
                                    id="sdg_realisasi" name="sdg_realisasi" 
                                    value="{{ old('sdg_realisasi') }}" 
                                    placeholder="Masukkan angka..." required>
                                    
                                @error('sdg_realisasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kolom Kanan --}}
                            <div class="col-md-6">
                                <label for="sdg_target" class="form-label fw-bold text-dark">Target 2026</label>
                                <input type="number" class="form-control @error('sdg_target') is-invalid @enderror" 
                                    id="sdg_target" name="sdg_target" 
                                    value="{{ old('sdg_target') }}" 
                                    placeholder="Masukkan angka..." required>

                                @error('sdg_target')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tambahkan input lain untuk Step 1 disini --}}
                    </div>

                    {{-- 3. Tombol Navigasi --}}
                    <div class="d-flex justify-content-between mt-4 mb-5">
                        <div></div> 

                        <button type="submit" class="btn btn-success" id="btn-submit">
                            <i class="mdi mdi-content-save me-1"></i> Simpan Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/inputprokerpage.js') }}"></script>
@endsection