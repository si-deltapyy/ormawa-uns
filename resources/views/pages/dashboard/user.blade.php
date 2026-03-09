@extends('layouts.dashboard')

@section('title')
    Organisasi Mahasiswa Universitas Sebelas Maret
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Hi, {{ Auth::user()->name }}</h4>
                @if ($dataAnggota->isEmpty())
                    <p class="card-subtitle mb-4 font-size-13">
                        Anda Belum Terdaftar di<strong> ORMAWA</strong>. Silahkan Hubungi Admin Untuk Mendaftar.
                    </p>
                @else
                <p class="card-subtitle mb-4 font-size-13">
                    Anda Terdaftar di <strong>{{ $dataAnggota->first()->nama_ormawa }}</strong> sebagai <strong>{{ $dataAnggota->first()->jabatan }}</strong>.
                </p>
                @endif
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>

<div class="row">
    <div class="col-md-6 col-xl-4">
        <div class="card bg-white border-[#f1f3f6]">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-primary float-right"></span>
                    <h5 class="card-title mb-0 text-primary">Jumlah Proker</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 text-black">
                            {{ $prokercount }} Proker
                        </h2>
                    </div>
                </div>

                <div class="progress badge-soft-primary shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $prokercount }}%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="card bg-white border-[#f1f3f6]">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-primary float-right"></span>
                    <h5 class="card-title mb-0 text-success">Total Pengajuan Dana</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 text-black">
                            Rp. {{ number_format($anggaran, 0, ',', '.') }}
                        </h2>
                    </div>
                </div>

                <div class="progress badge-soft-success shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $anggaran/100000 }}%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="card bg-white border-[#f1f3f6]">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-primary float-right"></span>
                    <h5 class="card-title mb-0 text-info">Realisasi Proker </h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 text-black">
                            {{ $realisasiProker }} / <span class="text-muted">  {{ $prokercount }} Proker</span>
                            
                        </h2>
                    </div>
                </div>

                <div class="progress badge-soft-info shadow-sm" style="height: 5px;">
                   <div class="progress-bar bg-info" 
                         role="progressbar" 
                         style="width: {{ $prokercount > 0 ? ($realisasiProker / $prokercount) * 100 : 0 }}%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @can('ketua-ormawa')
                <h4 class="card-title">Daftar Proker</h4>
                @endcan
                @can('pembina-ormawa')
                <h4 class="card-title">Daftar Ajuan Masuk</h4>
                @endcan

                <table id="dataproker-ajuan" class="table ">
                    <thead>
                        <tr>
                            <th>ID Kegiatan</th>
                            <th>Nama Proker</th>
                            <th>Tahun Ajuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @can('ketua-ormawa')
                        @foreach($proker as $data)
                        <tr>
                            <td>{{ $data->id_kegiatan }}</td>
                            <td>
                                <div class="fw-bold">
                                    {{ $data->nama_kegiatan }}
                                </div>
                                <span class="badge badge-soft-secondary mt-1">
                                    <a href="{{ route('user.ajuan.proker.lacak', $data->id) }}" class="text-secondary">
                                        <i class="mdi mdi-map-marker mr-1"></i>
                                        Lacak Ajuan
                                    </a>
                                </span>
                            </td>
                            <td>{{ $data->tahun_anggaran }}</td>
                            <td>
                                <div class="d-flex flex-column gap-1">

                                    <div class="mb-1">
                                        @if($data->status_proker == 'Disetujui')
                                            <span class="badge badge-soft-success">
                                            <i class="mdi mdi-check-outline"></i>
                                                Proker Disetujui</span>
                                        @elseif($data->status_proker == 'Ditolak')
                                            <span class="badge badge-soft-danger">Proker Ditolak</span>
                                        @elseif($data->status_proker == 'Review')
                                            <span class="badge badge-soft-secondary">Dalam Proses Review Proker</span>
                                        @elseif($data->status_proker == 'Revisi')
                                            <span class="badge badge-soft-warning">Revisi Proker</span>
                                        @endif
                                    </div>

                                    <div class="mb-1">
                                        @if($data->status_rab == 'Disetujui')
                                            <span class="badge badge-soft-success">
                                            <i class="mdi mdi-check-outline"></i>
                                                RAB Disetujui</span>
                                        @elseif($data->status_rab == 'Ditolak')
                                            <span class="badge badge-soft-danger">RAB Ditolak</span>
                                        @elseif($data->status_rab == 'Menunggu')
                                            <span class="badge badge-soft-secondary">Dalam Proses Review RAB</span>
                                        @elseif($data->status_rab == 'Revisi')
                                            <span class="badge badge-soft-warning">Revisi RAB</span>
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
                                <div class="mb-1 d-flex flex-column gap-2">
                                    @if($data->status_proker == 'Revisi')
                                        <a href="{{ route('user.ajuan.proker.edit', $data->id) }}" class="badge badge-soft-warning mb-1 p-2 font-size-12"
                                            onclick="return confirm('Yakin ingin Revisi Proker?')"
                                        >
                                            <i class="mdi mdi-file-outline me-1"></i>
                                            Revisi Proker
                                        </a>
                                    @else
                                     **
                                    @endif
                                    @if($data->status_rab == 'Revisi')
                                        <a href="{{ route('user.ajuan.rab.index', $data->id) }}" class="badge badge-soft-warning mb-1 p-2 font-size-12"
                                            onclick="return confirm('Yakin ingin Revisi RAB?')"
                                        >
                                            <i class="mdi mdi-cash-multiple me-1"></i>
                                            Revisi RAB
                                        </a>
                                    @else
                                     **
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endcan
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/inputprokerpage.js') }}"></script>
@endsection