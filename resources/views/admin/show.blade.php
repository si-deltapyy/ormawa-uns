@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center mb-3">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <div class="d-grid-flex">
                        {{ __('Halaman Evaluasi Kegiatan Ormawa UNS') }}
                        <a href="{{route('admin.insert')}}" class="btn btn-primary btn-sm float-end" class=""> <i class="bi bi-plus-lg"></i> </a>
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
                                        <a href="{{route('admin.info', [$data->id])}}" class="btn btn-sm btn-primary text white"> <i class="bi bi-info-circle"></i>
                                        </a>
                                        <a href="{{route('admin.edit', [$data->id])}}" class="btn btn-sm btn-warning text white"> <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.destroy', $data->id) }}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger show_confirm" data-toggle="tooltip" title='Delete'> <i class="bi bi-trash2-fill"></i>
                                            </button>
                                        </form>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });
</script>

@endsection