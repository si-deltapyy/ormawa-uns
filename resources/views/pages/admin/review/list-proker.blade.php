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
<div>
    <h4 class="page-title">Review | <span class="badge badge-soft-primary">{{ $ormawa->nama_id }}</span></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Ajuan Proker ORMAWA UNS</li>
    </ol>
</div>

{{-- Main --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Ajuan Proker</h4>

                <table id="dataproker-ajuan" class="table table-striped table-bordered">
                    <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Proker</th>
                                <th width="15%">Status </th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proker as $proker)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $proker->nama_kegiatan }}</td>
                                <td>
                                     <div class="d-flex flex-column gap-1">
                                        @if ($proker->is_review)
                                            @if($proker->status_proker == 'Disetujui')
                                                <span class="badge badge-soft-success mb-1">Disetujui</span>
                                            @elseif($proker->status_proker == 'Ditolak')
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
                                    @if($proker->is_review == false)
                                        <a href="{{ route('admin.review.tor', $proker->id) }}" class="btn btn-primary btn-sm">Review TOR</a>
                                    @elseif($proker->is_review == true && $proker->status_proker == 'Disetujui')
                                        <span class="btn btn-sm btn-success">TOR Disetujui</span>
                                    @elseif($proker->is_review == true && $proker->status_proker == 'Ditolak' || $proker->status_proker == 'Revisi')
                                        --
                                    @else
                                        <a href="{{ route('admin.review.tor', $proker->id) }}" class="btn btn-info btn-sm">Lihat Daftar Ajuan</a>
                                    @endif
                                    
                                </td>
                            </tr>
                            @endforeach
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