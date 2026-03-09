@extends('layouts.dashboard')

@section('content')
<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="card-body pt-0">
                        <div class="text-center p-3">
                            
                            {{-- Ilustrasi / Icon Gembok --}}
                            <div class="img-fluid my-4">
                                <i class="mdi mdi-shield-lock-outline display-1 text-danger"></i>
                            </div>

                            <h1 class="text-uppercase text-danger display-2">403</h1>
                            <h4 class="text-uppercase">Akses Ditolak</h4>
                            <p class="text-muted mt-3">
                                Maaf, Anda tidak memiliki izin (Role/Permission) untuk mengakses halaman ini.
                            </p>

                            <div class="mt-4">
                                <a href="{{ url('/') }}" class="btn btn-primary waves-effect waves-light">
                                    <i class="mdi mdi-arrow-left me-1"></i> Kembali ke Dashboard
                                </a>
                                {{-- Opsional: Tombol Logout jika user ingin ganti akun --}}
                                <a class="btn btn-outline-danger waves-effect waves-light ms-2" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form-error').submit();">
                                    Logout
                                </a>
                                <form id="logout-form-error" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection