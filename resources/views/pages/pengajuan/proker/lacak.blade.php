@extends('layouts.dashboard')

@section('title')
    Lacak Status Program Kerja
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/inputpage.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Lacak Status Proker</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('user.ajuan.proker') }}">Proker</a></li>
                    <li class="breadcrumb-item active">Lacak</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Kolom Kiri: Info Singkat Proker --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Informasi Program Kerja</h5>
                
                <div class="mb-3">
                    <label class="text-muted mb-0 font-size-12">Nama Kegiatan</label>
                    <h6 class="font-size-14">{{ $proker->nama_kegiatan }}</h6>
                </div>
                
                <div class="mb-3">
                    <label class="text-muted mb-0 font-size-12">ID Kegiatan</label>
                    <h6 class="font-size-14">{{ $proker->id_kegiatan }}</h6>
                </div>

                <div class="mb-3">
                    <label class="text-muted mb-0 font-size-12">Tanggal Pengajuan</label>
                    <h6 class="font-size-14">{{ \Carbon\Carbon::parse($proker->created_at)->isoFormat('D MMMM Y') }}</h6>
                </div>

                <hr>
                <div class="text-center">
                    <span class="badge badge-lg font-size-14 px-3 py-2
                        {{ $proker->status_proker == 'Disetujui' ? 'badge-success' : 
                          ($proker->status_proker == 'Ditolak' ? 'badge-danger' : 'badge-soft-info') }}">
                        {{ $proker->status_proker }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Timeline Pelacakan --}}
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Riwayat Perjalanan Berkas</h4>

                <ul class="tracking-list">
                    
                    {{-- Loop data riwayat --}}
                    @foreach($logs as $log)
                        <li class="tracking-item {{ $loop->first ? 'active' : '' }} {{ $log['status_type'] }}">
                            <div class="tracking-date">
                                {{ \Carbon\Carbon::parse($log->created_at)->isoFormat('dddd, D MMMM Y') }} 
                                <span class="ml-2 text-dark"><i class="mdi mdi-clock-outline"></i> {{ \Carbon\Carbon::parse($log->created_at)->format('H:i') }} WIB</span>
                            </div>
                            
                            <div class="tracking-title">
                                {{ $log->action }}
                            </div>

                            @if(!empty($log->description))
                                <div class="tracking-desc mt-2">
                                    {!! nl2br(e($log->description)) !!}
                                </div>
                            @endif
                        </li>
                    @endforeach

                </ul>
                
                {{-- Jika belum ada riwayat (Baru diajukan) --}}
                @if(count($logs) == 0)
                    <div class="text-center py-4">
                        <i class="mdi mdi-timer-sand text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-2">Belum ada aktivitas terbaru.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection