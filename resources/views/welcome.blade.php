@extends('layouts.landing')

@section('content')

<nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{asset('img/logo-uns.png')}}" alt="" height="40">
                ORMAWA UNS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#statistik">Statistik</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
                    <li class="nav-item ms-3">
                        @if (Auth::user())
                            @role('admin')
                            <a href="{{ route('admin.index') }}" class="btn btn-outline-primary rounded-pill px-4 me-2">Dashboard</a>
                            @endrole
                            @role('user')
                            <a href="{{ route('user.index') }}" class="btn btn-outline-primary rounded-pill px-4 me-2">Dashboard</a>
                            @endrole
                        @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4 me-2">Masuk</a>
                        @endif
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-primary-custom">Daftar</a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>

    <section id="beranda" class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="hero-title mb-4">Pusat Data <br><span>Ormawa UNS </span></h1>
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3"> Beta Version 2.1.2026</span>
                    <p class="lead text-secondary mb-5 pe-lg-5">
                        Platform digital terintegrasi untuk pengelolaan data, administrasi, dan pelaporan kegiatan Organisasi Mahasiswa di Universitas Sebelas Maret.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-primary-custom btn-lg">Ajukan Proposal</a>
                        <a href="#" class="btn btn-outline-secondary btn-lg rounded-pill px-4">Panduan</a>
                    </div>
                    
                    <div class="mt-5 d-flex align-items-center gap-4">
                        <div>
                            <h4 class="fw-bold mb-0">{{ $ormawacount }}+</h4>
                            <small class="text-muted">Ormawa Aktif</small>
                        </div>
                        <div class="vr"></div>
                        <div>
                            <h4 class="fw-bold mb-0">{{ $prokercount }}+</h4>
                            <small class="text-muted">Kegiatan/Tahun</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{asset('img/rektorat-gedung.webp')}}" 
                         alt="Mahasiswa UNS" class="img-fluid hero-img w-100">
                </div>
            </div>
        </div>
    </section>

    <section id="fitur" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase ls-2">Mengapa Sistem Ini?</h6>
                <h2 class="fw-bold">Digitalisasi Ekosistem Kampus</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box">
                            <i class="fas fa-database"></i>
                        </div>
                        <h4>Database Terpusat</h4>
                        <p class="text-muted">Seluruh data anggota, pengurus, dan inventaris ormawa tersimpan dalam satu pintu yang aman.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <h4>Administrasi Paperless</h4>
                        <p class="text-muted">Pengajuan proposal dan LPJ dilakukan secara digital, mengurangi penggunaan kertas dan mempercepat proses.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Monitoring Realtime</h4>
                        <p class="text-muted">Pembina dan kemahasiswaan dapat memantau keaktifan dan progress kegiatan ormawa secara langsung.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="statistik" class="container">
        <div class="stats-section text-center">
            <div class="row align-items-center">
                <div class="col-lg-8 text-lg-start mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-2">Siap Bergabung?</h2>
                    <p class="mb-0 opacity-75">Update data ormawa Anda sekarang untuk kemudahan administrasi kampus.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('login') }}" class="btn btn-light rounded-pill px-5 py-3 fw-bold text-primary">Login Ormawa</a>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h3 class="fw-bold">Galeri Kegiatan</h3>
                    <p class="text-muted mb-0">Dokumentasi aktivitas ormawa UNS terbaru.</p>
                </div>
                <a href="#" class="text-decoration-none fw-bold">Lihat Semua <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-4 w-100 shadow-sm" alt="Kegiatan 1">
                </div>
                <div class="col-md-4">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-4 w-100 shadow-sm" alt="Kegiatan 2">
                </div>
                <div class="col-md-4">
                    <img src="https://images.unsplash.com/photo-1544531586-fde5298cdd40?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-4 w-100 shadow-sm" alt="Kegiatan 3">
                </div>
            </div>
        </div>
    </section> --}}
@endsection 

