@extends('layouts.dashboard')

@section('title')
    Admin - Organisasi Mahasiswa Universitas Sebelas Maret
@endsection

@section('content')

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card bg-white border-[#f1f3f6]">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-primary float-right"></span>
                    <h5 class="card-title mb-0 text-primary">Proker Yang Diajukan</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 text-black">
                            {{ $jumlahProker->count() }}
                        </h2>
                    </div>
                </div>

                @php
                    $total = $jumlahProker->count();
                    $diterima = $jumlahProker->where('status_proker', 'Diajukan')->count();
                    $persenDiterima = $total > 0 ? ($diterima / $total) * 100 : 0;
                @endphp

                <div class="progress badge-soft-primary shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $persenDiterima }}%;"></div>
                </div>
            </div>
        </div>
    </div> 

    <div class="col-md-6 col-xl-3">
        <div class="card bg-white border-[#f1f3f6]">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-info float-right"></span>
                    <h5 class="card-title mb-0 text-info">Proker Diterima</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 text-black">
                            {{ $jumlahProker->where('status_proker', 'Disetujui')->count() }}
                        </h2>
                    </div>
                </div>

                <div class="progress badge-soft-info shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ ($jumlahProker->where('status_proker', 'Diterima')->count())/10 }}%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card bg-white border-[#f1f3f6]">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-danger float-right"></span>
                    <h5 class="card-title mb-0 text-danger">Proker Ditolak</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 text-black">
                            {{ $jumlahProker->where('status_proker', 'Ditolak')->count() }}
                        </h2>
                    </div>
                </div>

                <div class="progress badge-soft-danger shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ ($jumlahProker->where('status_proker', 'Ditolak')->count())/10 }}%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card bg-white border-[#f1f3f6]">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-success float-right"></span>
                    <h5 class="card-title mb-0 text-success">Proker Aktif</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 text-black">
                            {{ $jumlahProker->where('status_aktif', 'Aktif')->count() }}
                        </h2>
                    </div>
                </div>

                <div class="progress badge-soft-success shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($jumlahProker->where('status_aktif', 'Aktif')->count() / max($jumlahProker->count(), 1)) * 100 }}%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card bg-white border-[#f1f3f6]">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-success float-right"></span>
                    <h5 class="card-title mb-0 text-success">Total Anggaran Disetujui</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 text-black">
                           Rp {{ number_format($rabAcc, 0, ',', '.') }}
                        </h2>
                    </div>
                </div>

                <div class="progress badge-soft-success shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($rabSum > 0) ? ($rabAcc/$rabSum*100) : 0 }}%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card bg-white border-[#f1f3f6]">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-secondary float-right"></span>
                    <h5 class="card-title mb-0 text-secondary">Total Anggaran Diajukan</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 text-black">
                            Rp {{ number_format($rabSum, 0, ',', '.') }}
                        </h2>
                    </div>
                </div>

                <div class="progress badge-soft-secondary shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ ($rabSum > 0) ? ($rabAcc/$rabSum*100) : 0 }}%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@role('admin')
<div class="row">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body"> <h4 class="card-title d-inline-block">Ajuan Skim</h4>
                <p class="card-subtitle mb-4">Total Pengajuan Proker per Skim</p>

                <div style="position: relative; height: 320px;">
                    <canvas id="ormawa-pie"></canvas>
                </div>

            </div> 
        </div> 
    </div>

    {{-- <div class="col-xl-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Line Chart</h4>
                <p class="card-subtitle mb-4">Example of line chart chart js.</p>

                <canvas id="ormawa-line"></canvas>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>  --}}

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Ajuan Proker</h4>
                <p class="card-subtitle mb-4 font-size-13">Laporan pengajuan proker terbaru.
                </p>

                <div class="table-responsive" style="height: 300px;">
                    <table class="table table-centered table-hover table-xl mb-0" id="recent-orders">
                        <thead>
                            <tr>
                                <th class="border-top-0">ID Kegiatan</th>
                                <th class="border-top-0">Ormawa</th>
                                <th class="border-top-0">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataproker as $data)
                            <tr>
                                <td>{{ $data->id_kegiatan }}</td>
                                <td>
                                    <h5 class="font-size-14 mb-1">{{ $data->ormawa->nama_ormawa }}</h5>
                                </td>
                                <td>
                                     <div class="text-dark fw-bold">
                                        {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y') }}
                                    </div>
                                    <span class="badge badge-soft-success text-success mt-1">
                                        <i class="mdi mdi-clock-outline mr-1"></i> 
                                        {{ \Carbon\Carbon::parse($data->created_at)->format('H:i') }} WIB
                                    </span>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada pengajuan proker.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-1 text-center">
                    <a href="{{ route('admin.review.proker') }}" class="text-muted"><i class="mdi mdi-arrow-right-circle mr-1"></i> Lihat Semua Pengajuan</a>
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>
</div>
@endrole
@endsection

@section('scripts') 
<script>
    (function($) {
        'use strict';
        $(function() {
            // Pastikan data tidak kosong agar tidak error JS
            var labels = @json($labelsSkim ?? []);
            var dataValues = @json($dataSkim ?? []);

            if ($("#ormawa-pie").length && labels.length > 0) {
                var pieChartCanvas = $("#ormawa-pie").get(0).getContext("2d");
                
                var pieChart = new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: {
                        labels: labels, 
                        datasets: [{
                            data: dataValues,
                            backgroundColor: [
                                '#3F51B5', '#f8ac5a', '#00c2b2', '#f15050', 
                                '#795548', '#607D8B', '#E91E63', '#9C27B0'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false, // INI KUNCINYA
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 20
                            }
                        },
                        // Animasi dimatikan sebentar untuk memastikan tidak loop
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });
            } else {
                console.log("Canvas tidak ditemukan atau data kosong");
            }
        });
    })(jQuery);
</script>
@endsection