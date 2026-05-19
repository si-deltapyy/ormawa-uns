@extends('layouts.dashboard')

@section('title')
    Upload Ajuan RAB - Ormawa UNS
@endsection

@section('head')
    <link href="{{ asset('assets/css/inputpage.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Upload Ajuan RAB</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">Proker</li>
                            <li class="breadcrumb-item active">
                                <a href="{{ $proker ? route('user.ajuan.rab.index', $proker->id) : '#' }}">
                                    RAB Upload
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Tambah Item Belanja</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ $proker ? route('user.ajuan.rab.store', $proker->id) : '#' }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row mb-3">
                                {{-- Kolom Kiri --}}
                                <div class="col-md-6">
                                    <label for="nama_ormawa" class="form-label">Nama Ormawa</label>
                                    <input type="text" class="form-control" id="nama_ormawa" name="nama_ormawa" value="{{ $proker->ormawa->nama_ormawa }}" readonly>
                                </div>

                                {{-- Kolom Kanan --}}
                                <div class="col-md-6">
                                    {{-- Hapus mt-3 karena sudah beda kolom --}}
                                    <label for="id_kegiatan" class="form-label">ID Kegiatan</label>
                                    <input type="text" class="form-control" id="id_kegiatan" name="id_kegiatan" value="{{ $proker->id_kegiatan }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="nama_proker" class="form-label">Nama Proker</label>
                                <input type="text" class="form-control" id="nama_proker" name="nama_proker" value="{{ $proker->nama_kegiatan }}" readonly>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="kode_mak" class="form-label">Kode MAK (Mata Anggaran Keluaran)</label>
                                    <select class="form-control" id="kode_mak" name="kode_mak" required>
                                        <option value="" disabled selected>Pilih Kode MAK</option>
                                        @foreach ($makList as $mak)
                                            <option value="{{ $mak->id }}">{{ $mak->kode_mak }} - {{ $mak->nama_belanja}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="deskripsi_belanja" class="form-label">Deskripsi Belanja</label>
                                    <textarea class="form-control" id="deskripsi_belanja" name="deskripsi_belanja" rows="3" required></textarea>
                                </div>
                            </div>

                            {{-- BARIS 1: Volume, Frekuensi, Perhitungan --}}
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="volume" class="form-label">Volume</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="volume" name="volume" min="0" placeholder="0" required>
                                        <span class="input-group-text">Satuan</span>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="frekuensi" class="form-label">Frekuensi</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="frekuensi" name="frekuensi" min="0" placeholder="0" required>
                                        <span class="input-group-text">Kali</span>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="perhitungan" class="form-label">Perhitungan Volume</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="perhitungan" name="perhitungan" min="0" readonly>
                                        <span class="input-group-text">Unit</span>
                                    </div>
                                </div>
                            </div>

                            {{-- BARIS 2: Biaya Satuan & Total Biaya --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="biaya_satuan" class="form-label">Biaya Satuan</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        {{-- UBAH KE TYPE TEXT AGAR BISA ADA TITIKNYA --}}
                                        <input type="text" class="form-control input-rupiah" id="biaya_satuan" name="biaya_satuan" placeholder="0" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="total_biaya" class="form-label">Total Biaya</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        {{-- UBAH KE TYPE TEXT --}}
                                        <input type="text" class="form-control" id="total_biaya" name="total_biaya" readonly>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/inputprokerpage.js') }}"></script>
<script src="{{ asset('assets/js/autoTimes.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection