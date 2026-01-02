@extends('layouts.app')

@section('content')

<div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <div class="row justify-content-center align-items-center">
        <main class="col-md-6 px-3 text-center">
            <h1>Pendataan Ormawa <br> Universitas Sebelas Maret</h1>
            <p class="lead">
                 @role("admin")
                <a href="{{ route('admin.index') }}" class="btn btn-primary">Kembali ke Dashboard</a>
                @endrole
                @role("user")
                <a href="{{ route('user.index') }}" class="btn btn-primary">Kembali ke Dashboard</a>
                @endrole
            </p>
            <footer class="mt-auto text-50">
                <p>&copy; Universitas Sebelas Maret 2023</p>
            </footer>
        </main>
    </div>
</div>
@endsection