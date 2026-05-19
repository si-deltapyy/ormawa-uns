@extends('layouts.dashboard')

@section('title')
    Reviewer - MAWA UNS
@endsection

@section('head')
<link href="{{ asset('assets/css/inputpage.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
{{-- Page Title --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="page-title mb-1">Review | <span class="badge badge-soft-secondary">{{ $ormawa->nama_id }}</span></h4>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">Review RAB </li>
            <li class="breadcrumb-item active">Ajuan RAB ORMAWA UNS</li>
        </ol>
    </div>
</div>

{{-- Main --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('admin.review.proker') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </a>
                    List Ajuan RAB
                </h4>
        

                <table id="dataproker-ajuan" class="table table-striped table-bordered">
                    <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Proker</th>
                                <th width="15%">Total Anggaran</th>
                                <th width="15%">Catatan </th>
                                <th width="15%">Status </th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($proker as $proker)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $proker->nama_kegiatan }}</td>
                                <td>
                                    @if($proker->rab->isEmpty())
                                        **
                                    @else
                                        Rp {{ number_format($proker->rab->sum('total_biaya'), 0, ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    @if($proker->notes)
                                        <small class="text-muted"><i class="mdi mdi-information-outline"></i> {{ $proker->notes }}</small>
                                    @else
                                        --
                                    @endif
                                </td>
                                <td>
                                     <div class="d-flex flex-column gap-1">
                                        @if ($proker->is_review_rab)
                                            @if($proker->status_rab == 'Disetujui')
                                                <span class="badge badge-soft-success mb-1">Disetujui</span>
                                            @elseif($proker->status_rab == 'Ditolak')
                                                <span class="badge badge-soft-danger mb-1">Ditolak</span>
                                            @else
                                                <span class="badge badge-soft-warning mb-1">Menunggu Revisi</span>
                                            @endif
                                            <span class="badge badge-soft-success">
                                                <i class="mdi mdi-check-circle-outline mr-1"></i>
                                                Sudah Direview
                                            </span>
                                        @else
                                            <span class="badge badge-soft-info">Belum Direview</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if ($proker->is_review_rab == false)
                                        @if ($proker->rab->isEmpty())
                                            <a href="{{ route('admin.review.rab.bypass', $proker->id) }}" class="btn btn-success btn-sm mr-1" 
                                                onclick="return confirm('Apakah Anda yakin ingin menyetujui RAB ini tanpa melihat detailnya?')">
                                                <i class="mdi mdi-check-circle-outline"></i>
                                        @else
                                            <a href="{{ route('admin.review.rab', $proker->id) }}" class="btn btn-primary btn-sm">
                                                <i class="mdi mdi-file-document"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.review.tor', $proker->id) }}" class="btn btn-info btn-sm">
                                            <i class="mdi mdi-eye-outline"></i>
                                        </a>
                                        <a href="{{ route('admin.review.rab.edit', $proker->id) }}" class="btn btn-warning btn-sm">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                        </a>
                                    @elseif($proker->is_review_rab == true && $proker->status_rab == 'Disetujui')
                                        <a class="badge badge-soft-success">
                                            <i class="mdi mdi-check-circle-outline font-size-12"></i>
                                        </a>
                                    @elseif($proker->is_review_rab == true && $proker->status_rab == 'Ditolak' || $proker->status_rab == 'Revisi')
                                        --
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data RAB yang diajukan.</td>
                            </tr>
                            @endforelse
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