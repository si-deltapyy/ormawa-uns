@extends('layouts.dashboard')

@section('title')
    Verifikasi Anggota Ormawa
@endsection

@section('content')
   <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Anggota</h4>

                    <table id="dataproker" class="table ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($anggota as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->user->name }}</td>
                                <td>
                                    @if ($data->status == 'Pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif ($data->status == 'Aktif') 
                                        <span class="badge badge-success">Aktif</span>
                                    @else 
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status == 'Pending')
                                        {{-- Tombol Verifikasi --}}
                                        <button type="button" class="btn btn-success btn-sm"
                                                data-toggle="modal"
                                                data-target="#confirmModal"
                                                data-url="{{ route('pembina.verify.anggota.verify', ['id' => $data->id]) }}"
                                                data-message="Apakah Anda yakin ingin memverifikasi anggota ini?"
                                                data-btn-color="btn-success"
                                                data-btn-text="Ya, Verifikasi">
                                            Verifikasi
                                        </button>

                                        {{-- Tombol Tolak --}}
                                        <button type="button" class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#confirmModal"
                                                data-url="{{ route('pembina.verify.anggota.reject', ['id' => $data->id]) }}"
                                                data-message="Apakah Anda yakin ingin menolak anggota ini?"
                                                data-btn-color="btn-danger"
                                                data-btn-text="Ya, Tolak">
                                            Tolak
                                        </button>

                                    @elseif ($data->status == 'Aktif')
                                        {{-- Tombol Nonaktifkan --}}
                                        <button type="button" class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#confirmModal"
                                                data-url="{{ route('pembina.verify.anggota.deactivate', ['id' => $data->id]) }}"
                                                data-message="Apakah Anda yakin ingin menonaktifkan anggota ini?"
                                                data-btn-color="btn-danger"
                                                data-btn-text="Ya, Nonaktifkan">
                                            Nonaktifkan
                                        </button>
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


    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Tindakan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage">Apakah Anda yakin?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                    <form id="modalForm" action="" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary" id="modalConfirmBtn">Ya, Lanjutkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/inputprokerpage.js') }}"></script>
@endsection