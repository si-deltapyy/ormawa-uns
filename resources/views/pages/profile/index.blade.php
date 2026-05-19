<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surakartea - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            background-color: #1a1a1a; 
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .login-card {
            background: #2b2b2b;
            border: none;
            border-radius: 0;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            box-shadow: 10px 10px 0px #FF8C00; /* Shadow khas industrial */
            border: 1px solid #3d3d3d;
        }
        .brand-text {
            font-family: 'Montserrat', sans-serif;
            color: #fff;
            letter-spacing: 2px;
            text-align: center;
            margin-bottom: 30px;
        }
        .brand-text span { color: #FF8C00; }
        .form-control {
            background: #333;
            border: 1px solid #444;
            color: #fff;
            border-radius: 0;
            padding: 12px;
        }
        .form-control:focus {
            background: #3d3d3d;
            border-color: #FF8C00;
            color: #fff;
            box-shadow: none;
        }
        .btn-login {
            background: #FF8C00;
            border: none;
            border-radius: 0;
            color: #fff;
            font-weight: 700;
            padding: 12px;
            width: 100%;
            margin-top: 20px;
            transition: 0.3s;
        }
        .btn-login:hover {
            background: #e67e00;
            transform: translateY(-2px);
        }
        .error-text { color: #ff4d4d; font-size: 0.8rem; }
    </style>
</head>
<body>

<div class="login-card">
    <div class="brand-text">
        <h2 class="mb-0">SURA<span>KARTEA</span></h2>
        <small class="text-muted">SYSTEM MANAGEMENT</small>
    </div>

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="text-white small fw-bold mb-2">EMAIL ADDRESS</label>
            <input type="email" name="email" class="form-control" placeholder="nama@surakartea.com" required>
            @error('email') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label class="text-white small fw-bold mb-2">PASSWORD</label>
            <input type="password" name="password" class="form-control" placeholder="********" required>
        </div>

        <button type="submit" class="btn btn-login">ENTER DASHBOARD</button>
    </form>
    
    <p class="text-center text-muted small mt-4">
        &copy; 2026 Surakartea Tea Shop.
    </p>
</div>

</body>
</html>