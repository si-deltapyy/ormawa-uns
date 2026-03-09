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
        <h3 class="mt-4 mb-3">Rancangan Anggaran Belanja</h3>
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
                                            {{-- <td class="text-center">
                                                @if ($proker->status_rab == "Menunggu")
                                                    <span class="badge badge-soft-warning">RAB dalam proses pengajuan</span>
                                                @elseif ($proker->status_rab == "Disetujui")
                                                    <span class="badge badge-soft-success">RAB Disetujui</span>
                                                @elseif ($proker->status_rab == "Ditolak")
                                                    <span class="badge badge-soft-danger">RAB Ditolak</span>
                                                @else
                                                    <div class="btn-group" role="group">
                                                        <a href="#" class="btn btn-sm btn-outline-warning" title="Edit">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Hapus item ini?')">
                                                            <i class="mdi mdi-trash-can"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </td> --}}
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
                                @if($proker->rabProker->where('proker_id', $proker->id)->count() > 0 )
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
                        @if ($proker->is_review)
                            <p class="text-muted mb-2">RAB telah direview oleh Admin TOR. Berikut catatan yang diberikan:</p>
                            <div class="border rounded p-3 mb-3">
                                <p class="mb-0">{{ $proker->notes ?? 'Tidak ada catatan tambahan.' }}</p>
                            </div>
                        @else
                            <p class="text-muted mb-0">RAB belum direview oleh Reviewer TOR. Silakan tunggu keputusan pembina.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-3 mt-lg-0">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        @role('user')
                        <h5 class="card-title mb-0 text-white"><i class="mdi mdi-gavel mr-1"></i> Aksi Pembina</h5>
                        @endrole
                        @role('admin')
                        <h5 class="card-title mb-0 text-white"><i class="mdi mdi-gavel mr-1"></i> Keputusan Reviewer RAB</h5>
                        @endrole
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Silakan berikan keputusan terhadap pengajuan program kerja ini.</p>
                        
                        <div class="d-grid gap-1">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalApprove">
                                        <i class="mdi mdi-check-circle-outline mr-1"></i> Setujui
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#modalRevisi">
                                        <i class="mdi mdi-pencil-outline mr-1"></i> Revisi
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modalReject">
                                        <i class="mdi mdi-close-circle-outline mr-1"></i> Tolak
                                    </button>
                                </div>
                            </div>
                            <a href="{{ route('admin.review.rab.list', $idProker) }}" class="btn btn-secondary btn-block">
                                <i class="mdi mdi-arrow-left mr-1"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </diV>
        </div>
    </div>
</div>

<div class="modal fade" id="modalApprove" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('admin.review.rab.approve', $proker->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title text-white">Konfirmasi Persetujuan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menyetujui RAB dari <b>{{ $proker->nama_kegiatan }}</b>?</p>
                <div class="form-group">
                    <label>Catatan (Opsional)</label>
                    <textarea name="catatan" class="form-control" rows="2" placeholder="Berikan catatan semangat atau arahan..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Ya, Setujui</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL REJECT --}}
<div class="modal fade" id="modalReject" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('admin.review.rab.reject', $proker->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title text-white">Tolak </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>RAB dari <b>{{ $proker->nama_kegiatan }}</b> akan dikembalikan ke status revisi/ditolak.</p>
                <div class="form-group">
                    <label class="text-danger fw-bold">Alasan Penolakan *</label>
                    <textarea name="catatan" class="form-control" rows="4" required placeholder="Jelaskan bagian mana yang perlu diperbaiki..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalRevisi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('admin.review.rab.revisi', $proker->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title text-white">Minta Revisi</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>RAB dari <b>{{ $proker->nama_kegiatan }}</b> akan dikembalikan ke status revisi.</p>
                <div class="form-group">
                    <label class="text-warning fw-bold">Catatan Revisi RAB*</label>
                    <textarea name="catatan_rab" class="form-control" rows="4" required placeholder="Jelaskan bagian mana yang perlu diperbaiki..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning">Kirim Revisi</button>
            </div>
        </form>
    </div>
</div>

@endsection
