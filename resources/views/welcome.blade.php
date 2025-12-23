@extends('layouts.app')

@section('content')
<div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <div class="row justify-content-center align-items-center">
        <main class="col-md-6 px-3 text-center">
            <h1>Pendataan Ormawa <br> Universitas Sebelas Maret</h1>
            <p class="lead">
                @if(Auth::user()->admin == '1')
                <a href="{{ route('admin.index') }}" class="btn btn-primary">Dashboard</a>
                @elseif (Auth::user()->admin == '0')
                <a href="{{ route('user.index') }}" class="btn btn-primary">Dashboard</a>
                @else

                @endif
            </p>
            <footer class="mt-auto text-50">
                <p>&copy; Universitas Sebelas Maret 2023</p>
            </footer>
        </main>
    </div>
</div>
@endsection