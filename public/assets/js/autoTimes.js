
    document.addEventListener("DOMContentLoaded", function() {
        const elVolume = document.getElementById('volume');
        const elFrekuensi = document.getElementById('frekuensi');
        const elPerhitungan = document.getElementById('perhitungan');
        
        const elBiayaSatuan = document.getElementById('biaya_satuan');
        const elTotalBiaya = document.getElementById('total_biaya');

        // Fungsi Helper: Menambahkan titik ribuan (1000 -> 1.000)
        function formatRupiah(angka) {
            if (!angka) return '';
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Fungsi Helper: Menghapus titik agar bisa dihitung (1.000 -> 1000)
        function cleanRupiah(str) {
            if (!str) return 0;
            return parseFloat(str.toString().replace(/\./g, '')) || 0;
        }

        // Fungsi Utama: Hitung Semuanya
        function hitungSemua() {
            // 1. Ambil nilai (Volume & Frekuensi pakai value biasa, Biaya pakai cleanRupiah)
            const valVolume = parseFloat(elVolume.value) || 0;
            const valFrekuensi = parseFloat(elFrekuensi.value) || 0;
            const valBiaya = cleanRupiah(elBiayaSatuan.value);

            // 2. Hitung Volume x Frekuensi
            const hasilPerhitungan = valVolume * valFrekuensi;
            elPerhitungan.value = hasilPerhitungan;

            // 3. Hitung Total Biaya (Hasil Perhitungan x Biaya Satuan)
            const hasilTotal = hasilPerhitungan * valBiaya;
            
            // 4. Tampilkan Total Biaya dengan format titik
            elTotalBiaya.value = formatRupiah(hasilTotal);
        }

        // Event Listener khusus untuk memformat input Biaya Satuan saat diketik
        elBiayaSatuan.addEventListener('input', function(e) {
            // Ambil nilai asli tanpa titik
            let rawValue = cleanRupiah(this.value);
            // Format ulang dengan titik dan kembalikan ke input
            this.value = formatRupiah(rawValue);
            // Jalankan perhitungan
            hitungSemua();
        });

        // Event listener untuk input lainnya
        elVolume.addEventListener('input', hitungSemua);
        elFrekuensi.addEventListener('input', hitungSemua);
    });