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
    <h4 class="page-title">Reviewer Dashboard</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Ajuan Proker Dan RAB ORMAWA UNS</li>
    </ol>
</div>

{{-- Main --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Logs Ajuan Proker dan RAB</h4>

                <table id="dataproker-ajuan" class="table table-striped table-bordered">
                    <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Ormawa</th>
                                <th>Nama Ormawa</th>
                                @if (Auth::user()->name == 'Reviewer RAB - ORMAWA')
                                    <th class="text-center">Direview / Total RAB</th>
                                @elseif(Auth::user()->name == 'Reviewer TOR - ORMAWA')
                                    <th class="text-center">Direview / Total TOR</th>
                                @endif
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ormawa as $ormawa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ormawa->UID }}</td>
                                <td>{{ $ormawa->nama_ormawa }}</td>
                                <td class="text-center">
                                    @if(Auth::user()->name == 'Reviewer TOR - ORMAWA')
                                        <span class="badge badge-soft-info font-size-12"> {{ $ormawa->prokers->where('is_review', true)->count() }} / {{ $ormawa->prokers_count }} </span>
                                    @elseif(Auth::user()->name == 'Reviewer RAB - ORMAWA')
                                       <span class="badge badge-soft-info font-size-12"> {{ $ormawa->prokers->where('is_review_rab', true)->count() }} / {{ $ormawa->prokers_count }} </span>
                                    @endif
                                </td>
                                <td>
                                    @if (Auth::user()->name == 'Reviewer TOR - ORMAWA')
                                    <a href="{{ route('admin.review.proker.list', $ormawa->id) }}" class="btn btn-primary btn-sm">Lihat Proposal</a>
                                    @endif
                                    @if (Auth::user()->name == 'Reviewer RAB - ORMAWA')
                                    <a href="{{ route('admin.review.rab.list', $ormawa->id) }}" class="btn btn-secondary btn-sm">Lihat Daftar RAB</a>
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