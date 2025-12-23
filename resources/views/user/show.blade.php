@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3 px-2">
        <div id="map"></div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <div class="d-grid-flex">
                        {{ __('Halaman Program Kerja Ormawa') }}
                        <a href="{{route('user.insert')}}" class="btn btn-primary btn-sm float-end" class=""> <i class="bi bi-plus-lg"></i> </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="data">
                        <thead>
                            <tr>
                                <th>Nama Ormawa</th>
                                <th>Nama Kegiatan</th>
                                <th>Jenis Kegiatan</th>
                                <th>Kategori Kegiatan</th>
                                <th>Skim Kegiatan</th>
                                <th>Tingkat Kegiatan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Jumlah Dana</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proker as $data)
                            <tr>
                                <td><span class="small">{{$data->nama_ormawa}}</span></td>
                                <td><span class="small">{{$data->nama_kegiatan}}</span></td>
                                <td><span class="small">{{$data->jenis_kegiatan}}</span></td>
                                <td><span class="small">{{$data->kategori_kegiatan}}</span></td>
                                <td><span class="small">{{$data->nama_skim}}</span></td>
                                <td><span class="small">{{$data->tingkat_kegiatan}}</span></td>
                                <td><span class="small">{{$data->mulai}}</span></td>
                                <td><span class="small">{{$data->selesai}}</span></td>
                                <td><span class="small">@currency($data->jumlah_dana)</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{route('user.info', [$data->id])}}" class="btn btn-sm btn-primary text white"> <i class="bi bi-info-circle"></i>
                                        </a>
                                        <a href="{{route('user.edit', [$data->id])}}" class="btn btn-sm btn-warning text white"> <i class="bi bi-pencil-square"></i>
                                        </a>
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

<script>
    $('#data').DataTable({
        responsive: true
    });
</script>

@endsection