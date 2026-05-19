const targetDate = new Date("Feb 8, 2026 18:00:00").getTime();
const closeTime = new Date("Feb 9, 2026 23:59:59").getTime();

const countdownFunction = setInterval(function() {
    const now = new Date().getTime();
    const distance = closeTime - now;

    // Kalkulasi waktu
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Update Angka ke HTML
    document.getElementById("days").innerHTML = days < 10 ? "0" + days : days;
    document.getElementById("hours").innerHTML = hours < 10 ? "0" + hours : hours;
    document.getElementById("minutes").innerHTML = minutes < 10 ? "0" + minutes : minutes;
    document.getElementById("seconds").innerHTML = seconds < 10 ? "0" + seconds : seconds;

    // Sembunyikan kotak hari jika sudah 0 (Opsional)
    if (days <= 0) {
        document.getElementById("box-days").style.display = "none";
    }

    // Jika waktu habis
    if (distance < 0) {
        clearInterval(countdownFunction);
        document.getElementById("countdown-wrapper").innerHTML = "<h4>Pendaftaran Ditutup</h4>";
        // Tambahkan logika munculkan tombol atau pesan di sini
    }
}, 1000);