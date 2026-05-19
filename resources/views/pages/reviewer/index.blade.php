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
    <h4 class="page-title">Reviewer</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Halaman untuk review list proker program kerja baru</li>
    </ol>
</div>

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
                            @can('ketua-ormawa')
                            <th>Status Ajuan</th>
                            <th>Catatan</th>
                            @endcan
                            @can('pembina-ormawa')
                            {{-- <th>Status Ajuan</th> --}}
                            @endcan
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proker->where('status_proker', 'Proses Pembina') as $data)
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
                                    <a href="{{ route('pembina.review.proker', $data->id) }}" class=" mb-1 badge badge-soft-secondary mr-1">
                                        <i class="mdi font-size-18 mdi-file-check-outline">
                                        </i>
                                        <span class="font-size-12 mr-2"> Review Proker</span>
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
@endsection


@section('scripts')
<script src="{{ asset('assets/js/inputprokerpage.js') }}"></script>
@endsection