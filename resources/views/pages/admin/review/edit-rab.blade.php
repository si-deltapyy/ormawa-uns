@extends('layouts.dashboard')

@section('title')
    Admin RAB - Organisasi Mahasiswa Universitas Sebelas Maret
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="alert alert-info border-0" role="alert">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="font-size-14 mb-1">Program Kerja: {{ $proker->nama_kegiatan }}</h5>
                    <p class="text-muted mb-0">ID Kegiatan: <strong>{{ $proker->id_kegiatan }}</strong></p>
                    <p class="text-muted mb-0">Ormawa: <strong>{{ $proker->ormawa->nama_ormawa }}</strong></p>
                </div>
            </div>
        </div>
         <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="card-title mb-0">Rincian Anggaran Biaya (RAB)</h3>
            <div class="d-flex">
                <a href="{{ route('admin.review.rab.list', $proker->id_ormawa ) }}" class="btn btn-info btn-sm waves-effect waves-light me-2 mr-3">
                    <i class="mdi mdi-left-arrow"></i> Kembali
                </a>
            </div>
         </div>
        </h3>
        
        <div class="row">
            <div class="col-lg-12 mb-3 mb-lg-0">
                {{-- Section Mekanisme (Tabel) --}}
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title text-white mb-0">List RAB</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center" width="8%">Kode MAK</th>
                                        <th width="30%">Uraian Belanja</th>
                                        <th class="text-center" width="8%">Vol</th>
                                        <th class="text-center" width="8%">Freq</th>
                                        <th class="text-center" width="8%">Jumlah Kegiatan</th>
                                        <th class="text-right" width="15%">Biaya Satuan</th>
                                        <th class="text-right" width="20%">Total Biaya</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($proker->rab as $index => $rab)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">{{ $rab->mak->kode_mak }}</td>
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
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a href="{{ route('user.ajuan.rab.edit', $rab->id) }}" 
                                                    class="btn btn-sm btn-outline-warning mr-1" 
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
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="mdi mdi-clipboard-text-off-outline font-size-24 d-block mb-2"></i>
                                                    Belum ada rincian anggaran yang ditambahkan.
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if($proker->rabProker->where('proker_id', $proker->id)->count() > 0)
                                        <tfoot class="table-light">
                                            <tr>
                                                <td colspan="6" class="text-end fw-bold text-uppercase">Total Anggaran Diajukan</td>
                                                <td colspan="2" class="text-right fw-bold text-primary font-size-16">
                                                    Rp {{ number_format($proker->rabProker->where('proker_id', $proker->id)->sum('total_biaya'), 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        @role('user')
                        <h5 class="card-title mb-0 text-white"><i class="mdi mdi-information-outline mr-1"></i> Informasi Status RAB</h5>
                        @endrole
                        @role('admin')
                        <h5 class="card-title mb-0 text-white"><i class="mdi mdi-information-outline mr-1"></i> Catatan Reviewer RAB</h5>
                        @endrole
                    </div>
                    <div class="card-body">
                        @if ($proker->is_review_rab)
                            <p class="text-muted mb-2">RAB telah direview oleh pembina. Berikut catatan yang diberikan:</p>
                            <div class="border rounded p-3 mb-3">
                                <p class="mb-0">{{ $proker->notes ?? 'Tidak ada catatan tambahan.' }}</p>
                            </div>
                        @else
                            <p class="text-muted mb-0">RAB belum direview oleh Reviewer TOR. Silakan tunggu keputusan pembina.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
