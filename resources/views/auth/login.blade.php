{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <!-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Ormawa UNS</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --uns-blue: #004a99;
            --uns-light: #eef4fc;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            height: 100vh;
            overflow: hidden; /* Mencegah scroll pada desktop */
        }

        /* Split Screen Layout */
        .login-wrapper {
            height: 100vh;
            width: 100%;
        }

        /* Bagian Kiri (Gambar) */
        .bg-login-image {
            background-image: linear-gradient(135deg, rgba(0, 74, 153, 0.9), rgba(0, 50, 110, 0.8)), 
                              url('https://images.unsplash.com/photo-1541339907198-e021fc9d13f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem;
        }

        /* Bagian Kanan (Form) */
        .login-form-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            background-color: #ffffff;
            padding: 2rem;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
        }

        /* Custom Input Styling */
        .form-floating > .form-control {
            border: 2px solid #f0f2f5;
            border-radius: 12px;
            height: 55px;
        }

        .form-floating > .form-control:focus {
            border-color: var(--uns-blue);
            box-shadow: 0 0 0 4px rgba(0, 74, 153, 0.1);
        }

        .form-floating > label {
            color: #999;
            padding-top: 0.8rem;
        }

        /* Custom Button */
        .btn-login {
            background-color: var(--uns-blue);
            color: white;
            border-radius: 50px;
            padding: 12px;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            border: none;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 74, 153, 0.2);
        }

        .btn-login-sso {
            background-color: #fff;
            color: var(--uns-blue);
            border-radius: 50px;
            border-color: var(--uns-blue);
            border: 2px solid var(--uns-blue);
            padding: 12px;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            border: none;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0, 74, 153, 0.2);
        }

        .btn-login-sso:hover {
            background-color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 74, 153, 0.3);
            color: var(--uns-blue);
        }

        .btn-login:hover {
            background-color: #003670;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 74, 153, 0.3);
            color: white;
        }

        .logo-text {
            color: var(--uns-blue);
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 1.5rem;
            margin-bottom: 2rem;
            display: inline-block;
            text-decoration: none;
        }

        .divider-text {
            display: flex;
            align-items: center;
            text-align: center;
            color: #adb5bd;
            margin: 1.5rem 0;
        }
        .divider-text::before, .divider-text::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e9ecef;
        }
        .divider-text:not(:empty)::before { margin-right: .5em; }
        .divider-text:not(:empty)::after { margin-left: .5em; }

        /* Mobile Adjustments */
        @media (max-width: 991.98px) {
            body { overflow-y: auto; }
            .bg-login-image { display: none; }
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0 login-wrapper">
        
        <div class="col-lg-7 d-none d-lg-block bg-login-image">
            <h1 class="display-4 fw-bold mb-3">Selamat Datang <br>di Ormawa UNS</h1>
            <p class="lead mb-4 opacity-75">Sistem Integrasi Data Organisasi Mahasiswa Universitas Sebelas Maret.</p>
            
            <div class="mt-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-check-circle me-3 fs-4"></i>
                    <span>Kemudahan Administrasi Digital</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-check-circle me-3 fs-4"></i>
                    <span>Monitoring Kegiatan Realtime</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-3 fs-4"></i>
                    <span>Database Terpusat & Aman</span>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-12">
            <div class="login-form-container">
                <div class="login-card">
                    <div class="text-center text-lg-start">
                        <a href="{{ url('/') }}" class="logo-text">
                            <img src="{{asset('img/logo-uns.png')}}" alt="" height="40">ORMAWA UNS
                        </a>
                        <h2 class="fw-bold mb-1">Masuk Akun</h2>
                        <p class="text-muted mb-4">Silakan login untuk mengelola data ormawa.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="font-size: 0.9rem;">
                                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                            <label for="email">Alamat Email UNS / SSO</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="Password" required>
                            <label for="password">Kata Sandi</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-login mb-3">
                            Masuk Sekarang
                        </button>

                        <a href="" class="btn btn-login-sso mb-3">
                           <i class="fas fa-university me-2"></i> Login SSO
                        </a>

                    </form>

                    <div class="divider-text small">Atau</div>

                    <div class="text-center">
                        <p class="text-muted small">Belum memiliki akun ormawa? 
                            <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold ms-1">Daftar Sekarang</a>
                        </p>
                    </div>
                    
                    <div class="mt-5 text-center text-muted" style="font-size: 0.8rem;">
                        &copy; {{ date('Y') }} Universitas Sebelas Maret
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>