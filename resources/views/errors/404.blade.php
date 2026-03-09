@extends('layouts.dashboard')

@section('content')
<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="card-body pt-0">
                        <div class="text-center p-3">
                            
                            {{-- Ilustrasi / Icon --}}
                            <div class="img-fluid my-4">
                                <i class="mdi mdi-emoticon-sad-outline display-1 text-primary"></i>
                            </div>

                            <h1 class="text-uppercase text-primary display-2">404</h1>
                            <h4 class="text-uppercase">Halaman Tidak Ditemukan</h4>
                            <p class="text-muted mt-3">
                                Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.
                            </p>

                            <div class="mt-4">
                                <a href="{{ url('/') }}" class="btn btn-primary waves-effect waves-light">
                                    <i class="mdi mdi-home me-1"></i> Kembali ke Dashboard
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection