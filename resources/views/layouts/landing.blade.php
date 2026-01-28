<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pendataan Ormawa UNS</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="{{asset('img/logo-uns.png')}}" />

    <style>
        :root {
            --uns-blue: #004a99; /* Biru Tua Elegan */
            --uns-light-blue: #eef4fc;
            --text-dark: #2c3e50;
            --text-grey: #6c757d;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Navbar Custom */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--uns-blue) !important;
            font-size: 1.5rem;
        }

        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            margin-left: 15px;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: var(--uns-blue) !important;
        }

        .btn-primary-custom {
            background-color: var(--uns-blue);
            color: white;
            border-radius: 50px;
            padding: 10px 30px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 74, 153, 0.3);
        }

        .btn-primary-custom:hover {
            background-color: #003670;
            transform: translateY(-2px);
            color: white;
        }

        /* Hero Section */
        .hero-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #ffffff 0%, var(--uns-light-blue) 100%);
            border-bottom-right-radius: 80px;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            color: var(--text-dark);
        }

        .hero-title span {
            color: var(--uns-blue);
        }

        .hero-img {
            border-radius: 20px;
            box-shadow: 20px 20px 0px rgba(0, 74, 153, 0.1);
            transition: transform 0.5s;
        }

        .hero-img:hover {
            transform: scale(1.02);
        }

        /* Features Card */
        .feature-card {
            border: none;
            border-radius: 20px;
            padding: 30px;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 74, 153, 0.1);
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background-color: var(--uns-light-blue);
            color: var(--uns-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Stats Section */
        .stats-section {
            background-color: var(--uns-blue);
            color: white;
            border-radius: 20px;
            padding: 50px;
            margin: 50px 0;
        }

        /* Footer */
        footer {
            background-color: #f8f9fa;
            padding: 50px 0 20px;
            margin-top: 80px;
        }
    </style>
</head>
<body>

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold text-primary mb-3">ORMAWA UNS</h5>
                    <p class="text-muted small">
                        Jl. Ir. Sutami No.36, Kentingan,<br>
                        Kec. Jebres, Kota Surakarta,<br>
                        Jawa Tengah 57126
                    </p>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Tautan</h6>
                    <ul class="list-unstyled text-muted small">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Beranda</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Tentang Kami</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Bantuan</h6>
                    <ul class="list-unstyled text-muted small">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Panduan</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">FAQ</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Laporkan Bug</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h6 class="fw-bold mb-3">Ikuti Kami</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-secondary fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-secondary fs-5"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-secondary fs-5"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center text-muted small pb-3">
                &copy; {{ date('Y') }} Universitas Sebelas Maret. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>