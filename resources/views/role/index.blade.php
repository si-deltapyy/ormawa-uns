@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <div class="d-grid-flex">
                        {{ __('Halaman User Sistem Pencatatan Program Kerja Ormawa UNS') }}
                        <a href="{{route('role.insert')}}" class="btn btn-primary btn-sm float-end" class=""> <i
                                class="bi bi-plus-lg"></i> </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="data">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>
                                    @if($data->admin == 1)
                                    <span class="badge bg-success">Admin</span>
                                    @else
                                    <span class="badge bg-secondary">User</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('role.edit', [$data->id])}}" class="btn btn-primary btn-sm"> <i
                                            class="bi bi-pencil-square"></i> </a>
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