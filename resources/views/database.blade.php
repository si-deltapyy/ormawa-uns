@extends('layout.page')

@section('content')
<section class="begin">
    <div class="container">
        <div class="p-5 rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold bg-light rounded p-3">Ormawa Universitas Sebelas Maret</h1>
                <div class="py-3">
                    <div class="d-flex my-3">
                        <h2 class="px-2 text-start">Rencana Program Kerja Ormawa UNS 2024</h2>
                        <button class="btn btn-primary rounded col-md-2 ms-auto" data-bs-toggle="modal"
                            data-bs-target="#add"><i class="bi bi-clipboard-plus"></i>
                        </button>
                        <div class="modal fade" id="add" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">Form Tambah Kegiatan
                                        <h5 class="modal-title"></h5>
                                    </div>
                                    <div class="modal-body">
                                        @include('form.add')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table id="example" class="display" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Id Kegiatan</th>
                                <th>Nama Ormawa</th>
                                <th>Jenis Kegiatan</th>
                                <th>Kategori Kegiatan</th>
                                <th>Skim Kegiatan</th>
                                <th>Nama Kegiatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proker as $data)
                            <tr>
                                <td>{{$data->id_proker}}</td>
                                <td>{{$data->nama_id}}</td>
                                <td>{{$data->jenis_kegiatan}}</td>
                                <td>{{$data->kategori_kegiatan}}</td>
                                <td>{{$data->nama_skim}}</td>
                                <td>{{$data->judul_kegiatan}}</td>
                                <td class="d-md-flex d-grid gap-2">
                                    <button type="button" class="btn btn-md btn-primary text-white"
                                        data-bs-toggle="modal" data-bs-target="#view">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <div class="modal fade" id="view" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{$data->judul_kegiatan}}
                                                    </h5>
                                                </div>
                                                <div class="modal-body">
                                                    @include('form.view')
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-md btn-primary text-white"
                                        data-bs-toggle="modal" data-bs-target="#detail">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <div class="modal fade" id="detail" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Target {{$data->judul_kegiatan}}
                                                    </h5>
                                                </div>
                                                <div class="modal-body">
                                                    @include('form.detail')
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

@section('js')
<script>
$('#example').DataTable();
</script>
@endsection