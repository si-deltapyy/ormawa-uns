@extends('layouts.dashboard')

@section('content')
{{-- 1. Header Halaman (Breadcrumb) --}}
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Edit Indikator Kinerja Utama ORMAWA</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('user.ajuan.proker') }}">Proker</a></li>
                    <li class="breadcrumb-item active">Edit Indikator</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body mb-5">
                
                {{-- Form Edit --}}
                <form action="{{ route('user.input.indikator.update', $indikator->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="progress mb-4" style="height: 5px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%;"></div>
                    </div>

                    <div class="form-step active">
                        <h5 class="card-title text-warning mb-4"><i class="mdi mdi-pencil-box-outline me-2"></i> Mode Revisi Indikator</h5>
                        
                        {{-- Penyelenggaraan Kompetisi (Mapping ke delkom di controller) --}}
                        <div class="mb-2 mt-4">
                            <label class="form-label fw-bold text-dark">Penyelenggaraan Kompetisi <span class="text-danger">*</span></label>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label for="delkom_realisasi" class="form-label">Realisasi 2025</label>
                                    <input type="number" class="form-control @error('delkom_realisasi') is-invalid @enderror" 
                                        id="delkom_realisasi" name="delkom_realisasi" 
                                        value="{{ old('delkom_realisasi', $indikator->penyelenggaraan_kompetisi_realisasi) }}" required>
                                    @error('delkom_realisasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="delkom_target" class="form-label">Target 2026</label>
                                    <input type="number" class="form-control @error('delkom_target') is-invalid @enderror" 
                                        id="delkom_target" name="delkom_target" 
                                        value="{{ old('delkom_target', $indikator->penyelenggaraan_kompetisi_target) }}" required>
                                    @error('delkom_target') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Penyelenggaraan Non Kompetisi (Mapping ke delnonkom) --}}
                        <div class="mb-2 mt-4">
                            <label class="form-label fw-bold text-dark">Penyelenggaraan Non Kompetisi <span class="text-danger">*</span></label>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label for="delnonkom_realisasi" class="form-label">Realisasi 2025</label>
                                    <input type="number" class="form-control @error('delnonkom_realisasi') is-invalid @enderror" 
                                        id="delnonkom_realisasi" name="delnonkom_realisasi" 
                                        value="{{ old('delnonkom_realisasi', $indikator->penyelenggaraan_non_kompetisi_realisasi) }}" required>
                                    @error('delnonkom_realisasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="delnonkom_target" class="form-label">Target 2026</label>
                                    <input type="number" class="form-control @error('delnonkom_target') is-invalid @enderror" 
                                        id="delnonkom_target" name="delnonkom_target" 
                                        value="{{ old('delnonkom_target', $indikator->penyelenggaraan_non_kompetisi_target) }}" required>
                                    @error('delnonkom_target') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Pendelegasian Kompetisi (Mapping ke penkom) --}}
                        <div class="mb-2 mt-4">
                            <label class="form-label fw-bold text-dark">Pendelegasian Kompetisi <span class="text-danger">*</span></label>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label for="penkom_realisasi" class="form-label">Realisasi 2025</label>
                                    <input type="number" class="form-control @error('penkom_realisasi') is-invalid @enderror" 
                                        id="penkom_realisasi" name="penkom_realisasi" 
                                        value="{{ old('penkom_realisasi', $indikator->pendelegasian_kompetisi_realisasi) }}" required>
                                    @error('penkom_realisasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="penkom_target" class="form-label">Target 2026</label>
                                    <input type="number" class="form-control @error('penkom_target') is-invalid @enderror" 
                                        id="penkom_target" name="penkom_target" 
                                        value="{{ old('penkom_target', $indikator->pendelegasian_kompetisi_target) }}" required>
                                    @error('penkom_target') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Pendelegasian Non Kompetisi (Mapping ke pennonkom) --}}
                        <div class="mb-2 mt-4">
                            <label class="form-label fw-bold text-dark">Pendelegasian Non Kompetisi <span class="text-danger">*</span></label>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label for="pennonkom_realisasi" class="form-label">Realisasi 2025</label>
                                    <input type="number" class="form-control @error('pennonkom_realisasi') is-invalid @enderror" 
                                        id="pennonkom_realisasi" name="pennonkom_realisasi" 
                                        value="{{ old('pennonkom_realisasi', $indikator->pendelegasian_non_kompetisi_realisasi) }}" required>
                                    @error('pennonkom_realisasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="pennonkom_target" class="form-label">Target 2026</label>
                                    <input type="number" class="form-control @error('pennonkom_target') is-invalid @enderror" 
                                        id="pennonkom_target" name="pennonkom_target" 
                                        value="{{ old('pennonkom_target', $indikator->pendelegasian_non_kompetisi_target) }}" required>
                                    @error('pennonkom_target') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- SDGs --}}
                        <div class="mb-2 mt-4">
                            <label class="form-label fw-bold text-dark">SDGs <span class="text-danger">*</span></label>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label for="sdg_realisasi" class="form-label">Realisasi 2025</label>
                                    <input type="number" class="form-control @error('sdg_realisasi') is-invalid @enderror" 
                                        id="sdg_realisasi" name="sdg_realisasi" 
                                        value="{{ old('sdg_realisasi', $indikator->sdg_realisasi) }}" required>
                                    @error('sdg_realisasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="sdg_target" class="form-label">Target 2026</label>
                                    <input type="number" class="form-control @error('sdg_target') is-invalid @enderror" 
                                        id="sdg_target" name="sdg_target" 
                                        value="{{ old('sdg_target', $indikator->sdg_target) }}" required>
                                    @error('sdg_target') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Navigasi --}}
                    <div class="d-flex justify-content-between mt-4 mb-5">
                        <a href="{{ route('user.ajuan.proker') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i> Batal
                        </a> 

                        <button type="submit" class="btn btn-warning">
                            <i class="mdi mdi-update me-1"></i> Update Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection