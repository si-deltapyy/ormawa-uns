<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sedang Dalam Perbaikan - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        :root {
            --primary: #6366f1;
            --dark: #0f172a;
            --text-muted: #94a3b8;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--dark);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
            text-align: center;
        }

        .container {
            max-width: 600px;
            padding: 20px;
            z-index: 2;
        }

        /* Animasi Gear */
        .gear-container {
            position: relative;
            height: 120px;
            margin-bottom: 30px;
        }
        .gear {
            font-size: 80px;
            color: var(--primary);
            animation: spin 4s linear infinite;
        }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        h1 { font-size: 2.5rem; margin-bottom: 10px; font-weight: 800; }
        p { color: var(--text-muted); line-height: 1.6; margin-bottom: 30px; }

        /* Timer */
        .timer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 40px;
        }
        .timer-box {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .timer-box span { display: block; font-size: 1.5rem; font-weight: 800; color: var(--primary); }
        .timer-box label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); }

        /* Input Form */
        .notify-form {
            display: flex;
            gap: 10px;
            background: rgba(255, 255, 255, 0.05);
            padding: 5px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        input {
            background: transparent;
            border: none;
            padding: 12px 20px;
            color: white;
            flex: 1;
            outline: none;
        }
        button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }
        button:hover { opacity: 0.8; transform: scale(1.05); }

        /* Background Decor */
        .bg-glow {
            position: absolute;
            width: 300px;
            height: 300px;
            background: var(--primary);
            filter: blur(150px);
            opacity: 0.2;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>

    <div class="container">
        <div class="gear-container">
            <i class="fas fa-cog gear"></i>
        </div>
        
        <h1>Sedang Pemeliharaan</h1>
        <p>Kami sedang melakukan pembaruan sistem untuk memberikan pengalaman terbaik bagi Anda. Kami akan segera kembali!</p>

        <div class="timer-grid">
            <div class="timer-box">
                <span id="days">00</span>
                <label>Hari</label>
            </div>
            <div class="timer-box">
                <span id="hours">00</span>
                <label>Jam</label>
            </div>
            <div class="timer-box">
                <span id="minutes">00</span>
                <label>Menit</label>
            </div>
            <div class="timer-box">
                <span id="seconds">00</span>
                <label>Detik</label>
            </div>
        </div>

        <form class="notify-form" onsubmit="alert('Terima kasih! Kami akan mengabari Anda.'); return false;">
            <input type="email" placeholder="Masukkan email Anda..." required>
            <button type="submit">Kabari Saya</button>
        </form>

        <div style="margin-top: 40px;">
            <a href="#" style="color: var(--text-muted); margin: 0 10px;"><i class="fab fa-facebook"></i></a>
            <a href="#" style="color: var(--text-muted); margin: 0 10px;"><i class="fab fa-instagram"></i></a>
            <a href="#" style="color: var(--text-muted); margin: 0 10px;"><i class="fab fa-twitter"></i></a>
        </div>
    </div>

    <script>
        // Set waktu target (Contoh: 24 jam dari sekarang)
        // Format: "Bulan Tanggal, Tahun Jam:Menit:Detik"
        const countdownDate = new Date("March 14, 2026 08:00:00").getTime();

        const updateTimer = setInterval(() => {
            const now = new Date().getTime();
            const distance = countdownDate - now;

            const d = Math.floor(distance / (1000 * 60 * 60 * 24));
            const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = d < 10 ? '0'+d : d;
            document.getElementById("hours").innerText = h < 10 ? '0'+h : h;
            document.getElementById("minutes").innerText = m < 10 ? '0'+m : m;
            document.getElementById("seconds").innerText = s < 10 ? '0'+s : s;

            if (distance < 0) {
                clearInterval(updateTimer);
                document.querySelector("h1").innerText = "Hampir Selesai!";
            }
        }, 1000);
    </script>
</body>
</html>