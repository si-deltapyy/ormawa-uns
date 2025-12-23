@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-3">
        <div class="row mb-3 px-2">
            <h1>Halaman Profile</h1>
            <div class="table-wrap my-2">
                <table class="table table-bordered">
                    @foreach ($user as $users)
                    <tbody>
                        <tr>
                            <th>Username</th>
                            <td>{{$users->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$users->email}}</td>
                        </tr>
                        <tr>
                            <th>Ormawa</th>
                            <td>{{$users->nama_ormawa}}</td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#account"><i class="bi bi-info-circle"></i></button>
                            </td>
                            <!-- Password Modal -->
                            <div class="modal fade" id="account" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{route('user.change.profile')}}" method="post" class="was-validated">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update account</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label fw-bold">Email</label>
                                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label fw-bold">Password</label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                                </div>
                                                <div class="d-flex-row float-end">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
            </div>
            </tr>
            </tbody>
            @endforeach
            </table>
        </div>
    </div>
</div>
</div>

@endsection