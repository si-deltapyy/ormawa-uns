@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Managing Users Role</h4>

                <table id="basic-datatable" class="table dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Ormawa</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $data)
                        <tr>
                            <td>{{ $data->name}}</td>
                            <td></td>
                            <td></td>
                            <td>
                                @foreach ($data->roles as $role)
                                    <span class="badge badge-primary">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{route('role.edit', [$data->id])}}" class="btn btn-secondary btn-sm"> <i
                                        class="mdi mdi-pencil-plus"></i> </a>
                                <a href="#" class="btn btn-danger btn-sm"> <i
                                        class="mdi mdi-trash-can"></i> </a>
                                
                            </tda>
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

<script>
    $(document).ready(function() {
        $('#basic-datatable').DataTable({
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                }
            },
            "drawCallback": function () {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });
    });
</script>
    
@endsection