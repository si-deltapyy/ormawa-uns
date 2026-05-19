@extends('layouts.dashboard')

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
                        <li class="breadcrumb-item"><a href="{{ route('user.ajuan.proker') }}">Proker</a></li>
                        <li class="breadcrumb-item active">RAB Upload</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

   <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    
                    {{-- 1. Header & Informasi Proker --}}
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title mb-0">Rincian Anggaran Biaya (RAB)</h4>
                        
                        {{-- Wrapper Tombol agar mengelompok di kanan --}}
                        <div class="d-flex">

                            {{-- Tombol 1: Ajukan RAB Baru --}}
                            @if($proker->status_rab == 'Belum Mengajukan' || $proker->status_rab == 'Revisi')
                                <a href="{{ route('user.ajuan.proker') }}" class="btn btn-info btn-sm waves-effect waves-light me-2 mr-3">
                                    <i class="mdi mdi-left-arrow"></i> Kembali
                                </a>
                                <form action="{{ route('user.ajuan.rab.req', $proker->id) }}" method="POST" class="me-2 mr-3" onsubmit="this.submitButton.disabled=true;">
                                    @csrf
                                    <button type="submit" name="submitButton" class="btn btn-success btn-sm waves-effect waves-light" onclick="return confirm('Yakin Akan Finalisasi Proker?')" >
                                        <i class="mdi mdi-plus-box me-1"></i> Ajukankan Finalisasi Proker
                                    </button>
                                </form>
                                
                                <a href="{{ route('user.ajuan.rab.create', $proker->id) }}" class="btn btn-primary btn-sm waves-effect waves-light">
                                    <i class="mdi mdi-cart-plus me-1"></i> Tambah Item Belanja
                                </a>
                            @endif
                            @if($proker->status_rab == 'Menunggu')
                                <span class="badge badge-soft-primary font-size-12 p-2 mr-3">
                                    <a href="{{ route('user.ajuan.proker') }}">Kembali</a>
                                </span>
                                    <span class="badge badge-soft-warning font-size-12 p-2 ml-2">Menunggu revisi</span>
                            @elseif($proker->status_rab == 'Disetujui')
                                <a href="{{ route('user.ajuan.proker') }}" class="btn btn-info btn-sm waves-effect waves-light me-2 mr-3">
                                    <i class="mdi mdi-left-arrow"></i> Kembali
                                </a>
                                <span class="badge badge-soft-success font-size-12 p-2">RAB Disetujui</span>
                            @elseif($proker->status_rab == 'Ditolak')
                                <a href="{{ route('user.ajuan.proker') }}" class="btn btn-info btn-sm waves-effect waves-light me-2 mr-3">
                                    <i class="mdi mdi-left-arrow"></i> Kembali
                                </a>
                                <span class="badge badge-soft-danger font-size-12 p-2">RAB Ditolak</span>
                            @endif
                        </div>
                    </div>

                    <div class="alert alert-info border-0" role="alert">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="font-size-14 mb-1">Program Kerja: {{ $proker->nama_kegiatan }}</h5>
                                <p class="text-muted mb-0">ID Kegiatan: <strong>{{ $proker->id_kegiatan }}</strong></p>
                            </div>
                        </div>
                    </div>

                    {{-- 2. Tabel RAB --}}
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="15%">Kode MAK</th>
                                    <th width="30%">Uraian Belanja</th>
                                    <th class="text-center" width="5%">Vol</th>
                                    <th class="text-center" width="5%">Freq</th>
                                    <th class="text-center" width="5%">Jumlah Kegiatan</th>
                                    <th class="text-right" width="13%">Biaya Satuan</th>
                                    <th class="text-right" width="15%">Total Biaya</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($proker->rabProker as $index => $rab)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-left">{{ $rab->mak->kode_mak }} - {{ $rab->mak->nama_belanja }}</td>
                                        <td>
                                            <h6 class="text-truncate mb-0 font-size-14">{{ $rab->uraian_belanja }}</h6>
                                            {{-- @if($rab->catatan)
                                                <small class="text-muted"><i class="mdi mdi-information-outline"></i> {{ $rab->catatan }}</small>
                                            @endif --}}
                                        </td>
                                        <td class="text-center">{{ $rab->volume }}</td>
                                        <td class="text-center">{{ $rab->frekuensi }}</td>
                                        <td class="text-center">{{ $rab->perhitungan }}</td> 
                                        <td class="text-right fw-bold">
                                            Rp {{ number_format($rab->harga_satuan, 0, ',', '.') }}
                                        </td>
                                        <td class="text-right fw-bold">
                                            Rp {{ number_format($rab->total_biaya, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            @if ($proker->status_rab == "Menunggu")
                                                <span class="badge badge-soft-success">RAB sedang diproses</span>
                                            @elseif ($proker->status_rab == "Disetujui")
                                                <span class="badge badge-soft-success">RAB Disetujui</span>
                                            @elseif ($proker->status_rab == "Ditolak")
                                                <span class="badge badge-soft-danger">RAB Ditolak</span>
                                            @else
                                                <div class="d-flex align-items-center gap-2">
                                                    <a href="{{ route('user.ajuan.rab.edit', $rab->id) }}" 
                                                    class="btn btn-sm btn-outline-warning" 
                                                    title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>

                                                    {{-- Form Hapus --}}
                                                    <form action="{{ route('user.ajuan.rab.delete', $rab->id) }}" 
                                                        method="POST" 
                                                        onsubmit="return confirm('Hapus item ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                            <i class="mdi mdi-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="mdi mdi-clipboard-text-off-outline font-size-24 d-block mb-2"></i>
                                                Belum ada rincian anggaran yang ditambahkan.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            
                            {{-- 3. Footer Total --}}
                            @if($proker->rabProker->count() > 0)
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="6" class="text-end fw-bold text-uppercase">Total Anggaran Diajukan</td>
                                        <td colspan="2" class="text-right fw-bold text-primary font-size-16">
                                            Rp {{ number_format($proker->rabProker->sum('total_biaya'), 0, ',', '.') }}
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                    {{-- End Table Responsive --}}

                </div>
            </div>
        </div>
    </div>
@endsection
