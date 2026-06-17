    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="utf-8">
        <title>TOR - ({{ $proker->id_kegiatan }}) - {{ $proker->nama_kegiatan ?? 'Kegiatan' }}</title>
        <style>
            @page {
                size: legal portrait;
                margin: 2cm;
            }
            body {
                font-family: "Times New Roman", Times, serif;
                font-size: 11pt;
                line-height: 1.4;
                color: #000;
            }

            p {
                text-align: justify;
                text-justify: inter-word;
                margin: 0 0 10px 0;
            }
            .header-title {
                text-align: center;
                font-weight: bold;
                font-size: 14pt;
                text-decoration: underline;
                margin-bottom: 20px;
            }
            .info-table {
                width: 100%;
                margin-bottom: 20px;
            }
            .info-table td {
                padding: 2px 0;
                vertical-align: top;
            }
            .main-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 15px;
            }
            .main-table th, .main-table td {
                border: 1px solid #000;
                padding: 8px;
                vertical-align: top;
            }
            .bg-gray {
                background-color: #f2f2f2;
            }
            .text-bold { font-weight: bold; }
            .text-center { text-align: center; }
            
            /* Grid untuk Jadwal Pelaksanaan */
            .schedule-grid {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
                font-size: 9pt;
            }
            /* Memastikan DomPDF merender warna */
            * {
                -webkit-print-color-adjust: exact;
            }
            .schedule-grid th, .schedule-grid td {
                border: 1px solid #000;
                width: 25px;
            }

            /* Tanda Tangan */
            .signature-wrapper {
                width: 100%;
                margin-top: 30px;
            }
            .sig-table {
                width: 100%;
                border: none;
            }
            .sig-table td {
                width: 50%;
                padding-bottom: 60px;
                text-align: center;
            }
        </style>
    </head>
    <body>

        <div class="header-title">TERM OF REFERENCE (TOR)</div>

        <table class="info-table">
            <tr>
                <td width="25%">Nama Ormawa</td>
                <td width="5%">:</td>
                <td>{{ $proker->nama_ormawa ?? '....................' }}</td>
            </tr>
            <tr>
                <td>ID Kegiatan</td>
                <td>:</td>
                <td>{{ $proker->id_kegiatan ?? '....................' }}</td>
            </tr>
            <tr>
                <td>Judul Kegiatan</td>
                <td>:</td>
                <td>{{ $proker->nama_kegiatan ?? '....................' }}</td>
            </tr>
            <tr>
                <td>Tingkat</td>
                <td>:</td>
                <td>{{ $proker->tingkat_kegiatan ?? '....................' }}</td>
            </tr>
            <tr>
                <td>Tanggal Pelaksanaan</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($proker->tanggal_mulai)->isoFormat('D MMMM Y') }} <i>s/d<i> {{ \Carbon\Carbon::parse($proker->tanggal_selesai)->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <td>Nomor Proposal</td>
                <td>:</td>
                <td>{{ $proker->id ?? '....................' }}/MAWA/{{ $proker->ormawa->UID }}.{{ \Carbon\Carbon::parse($proker->created_at)->isoFormat('M') }}/{{ $proker->tahun_anggaran ?? '....................' }}</td>
            </tr>
            <tr>
                <td>Tahun Anggaran</td>
                <td>:</td>
                <td>{{ $proker->tahun_anggaran ?? '....................' }}</td>
            </tr>
            <tr>
                <td>Unit Kerja</td>
                <td>:</td>
                <td>Direktorat Kemahasiswaan</td>
            </tr>
        </table>

        <table class="main-table">
            {{-- <tr class="bg-gray">
                <td width="5%" class="text-center text-bold">10.</td>
                <td colspan="2" class="text-bold">INDIKATOR KINERJA KEGIATAN</td>
            </tr> --}}
            <tr>
                <td width="5%">1.</td>
                <td width="30%">IKU (Indikator Kinerja Umum)</td>
                <td width="5%">:</td>
                <td colspan="2" width="60%">IKU-003. Persentase mahasiswa berkegiatan/meraih prestasi di luar program studi</td>
            </tr>
            <tr>
                <td width="5%">2.</td>
                <td width="30%">IK (Indikator Kinerja)</td>
                <td width="5%">:</td>
                <td colspan="2" width="60%">
                    <table style="width: 100%; border: none; border-collapse: collapse;">
                        <tr style="border: none">
                            <td width="5%" style="border: none">a.</td>
                            <td style="border: none">Jumlah mahasiswa yang berkegiatan/meraih prestasi di luar program studi</td>
                        </tr>
                        <tr style="border: none">
                            <td width="5%" style="border: none">b.</td>
                            <td style="border: none">Jumlah mahasiswa aktif UNS</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td width="5%">3.</td>
                <td width="30%">SUB KEGIATAN</td>
                <td width="5%">:</td>
                <td colspan="2" class="text-bold" width="60%">{{ $proker->nama_kegiatan }}</td>
            </tr>
            {{-- <tr>
                <td>4.</td>
                <td>LATAR BELAKANG</td>
                <td width="60%">{{ $proker->latar_belakang ?? 'Penjelasan keterkaitan program kerja ormawa dengan peningkatan prestasi mahasiswa.' }}</td>
            </tr>
            <tr>
                <td>5.</td>
                <td>RASIONALISASI</td>
                <td>Rasionalisasi kegiatan organisasi mahasiswa terkait peningkatan prestasi menunjukkan bahwa keterlibatan aktif dalam organisasi berkontribusi signifikan terhadap pencapaian prestasi akademis dan non akademis.</td>
            </tr> --}}
        </table>

        <p class="text-bold">4. LATAR BELAKANG</p>
        <p>{{ $proker->latar_belakang ?? 'Penjelasan keterkaitan program kerja ormawa dengan peningkatan prestasi mahasiswa.' }}</p>
        <br>

        <p class="text-bold">5. RASIONALISASI</p>
        <p>{{ $proker->rasionalisasi_kegiatan ?? 'Rasionalisasi kegiatan organisasi mahasiswa terkait peningkatan prestasi menunjukkan bahwa keterlibatan aktif dalam organisasi berkontribusi signifikan terhadap pencapaian prestasi akademis dan non akademis.' }}</p>
        <br>

        <p class="text-bold">6. TUJUAN</p>
        <p>{{ $proker->tujuan_kegiatan ?? 'Tujuan kegiatan ini adalah untuk meningkatkan prestasi mahasiswa melalui keterlibatan aktif dalam organisasi, yang pada gilirannya akan berkontribusi pada pengembangan diri, peningkatan keterampilan, dan pencapaian prestasi akademis maupun non akademis.' }}</p>
        <br>

        <p class="text-bold">7. MEKANISME DAN RANCANGAN</p>
        <table class="main-table" style="width: 100%; border: none; border-collapse: collapse;">
            <tr>
                <td style="border: none;"></td>
                <td colspan="2" style="border: none; padding: 8px;">
                    <table style="width: 100%; border: none; border-collapse: collapse;">
                        <tr>
                            <td width="3%" style="border: none; vertical-align: top;">1.</td>
                            <td style="border: none;" class="text-bold">Persiapan</td>
                        </tr>
                        <tr>
                            <td style="border: none;"></td>
                            <td style="border: none; padding-left: 20px; padding-bottom: 10px;">
                                <i class="text-bold">Tgl, Tempat, Waktu:</i> ({{ \Carbon\Carbon::parse($proker->mekanisme->persiapan_tanggal_mulai ?? 'dd/mm/yyyy')->format('d M Y') }}, {{ $proker->mekanisme->persiapan_tempat ?? '...' }})<br>
                                <i>Deskripsi Singkat:</i> {{ $proker->mekanisme->persiapan_deskripsi ?? '................' }} 
                            </td>
                        </tr>

                        <tr>
                            <td style="border: none; vertical-align: top;">2.</td>
                            <td style="border: none;" class="text-bold">Pelaksanaan</td>
                        </tr>
                        <tr>
                            <td style="border: none;"></td>
                            <td style="border: none; padding-left: 20px; padding-bottom: 10px;">
                                <i class="text-bold">Tgl, Tempat, Waktu:</i> ({{ \Carbon\Carbon::parse($proker->mekanisme->pelaksanaan_tanggal_mulai ?? 'dd/mm/yyyy')->format('d M Y') }}, {{ $proker->mekanisme->pelaksanaan_tempat ?? '...' }}) <br>
                                <i>Deskripsi Singkat:</i> {{ $proker->mekanisme->pelaksanaan_deskripsi ?? '................' }} 
                            </td>
                        </tr>

                        <tr>
                            <td style="border: none; vertical-align: top;">3.</td>
                            <td style="border: none;" class="text-bold">Evaluasi</td>
                        </tr>
                        <tr>
                            <td style="border: none;"></td>
                            <td style="border: none; padding-left: 20px; padding-bottom: 10px;">
                                <i class="text-bold">Tgl, Tempat, Waktu:</i> ({{ \Carbon\Carbon::parse($proker->mekanisme->evaluasi_tanggal_mulai ?? 'dd/mm/yyyy')->format('d M Y') }}, {{ $proker->mekanisme->evaluasi_tempat ?? '...' }}) <br>
                                <i>Deskripsi Singkat:</i> {{ $proker->mekanisme->evaluasi_deskripsi ?? '................' }} 
                            </td>
                        </tr>

                        <tr>
                            <td style="border: none; vertical-align: top;">4.</td>
                            <td style="border: none;" class="text-bold">Pelaporan</td>
                        </tr>
                        <tr>
                            <td style="border: none;"></td>
                            <td style="border: none; padding-left: 20px;">
                                <i class="text-bold">Tgl, Tempat, Waktu:</i> ({{ \Carbon\Carbon::parse($proker->mekanisme->pelaporan_tanggal_mulai ?? 'dd/mm/yyyy')->format('d M Y') }}, {{ $proker->mekanisme->pelaporan_tempat ?? '...' }}) <br>
                                <i>Deskripsi Singkat:</i> {{ $proker->mekanisme->pelaporan_deskripsi ?? '................' }} 
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        
        <p class="text-bold">8. JADWAL PELAKSANAAN</p>
        <div class="schedule-wrapper">
            <table class="schedule-grid">
                <thead>
                    <tr class="bg-gray">
                        <th rowspan="2">Komponen Input</th>
                        <th colspan="12">Tahun {{ date('Y') }} (dalam skala bulan)</th>
                    </tr>
                    <tr class="bg-gray">
                        @for ($i = 1; $i <= 12; $i++)
                            <th>{{ $i }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Ambil angka bulan dari masing-masing tanggal (1-12)
                        $bulanPersiapan = isset($proker->mekanisme->persiapan_tanggal_mulai) ? \Carbon\Carbon::parse($proker->mekanisme->persiapan_tanggal_mulai)->format('n') : null;
                        $bulanPelaksanaan = isset($proker->mekanisme->pelaksanaan_tanggal_mulai) ? \Carbon\Carbon::parse($proker->mekanisme->pelaksanaan_tanggal_mulai)->format('n') : null;
                        $bulanEvaluasi = isset($proker->mekanisme->evaluasi_tanggal_mulai) ? \Carbon\Carbon::parse($proker->mekanisme->evaluasi_tanggal_mulai)->format('n') : null;
                        $bulanPelaporan = isset($proker->mekanisme->pelaporan_tanggal_mulai) ? \Carbon\Carbon::parse($proker->mekanisme->pelaporan_tanggal_mulai)->format('n') : null;
                        $bulanPersiapanSelesai = isset($proker->mekanisme->persiapan_tanggal_selesai) ? \Carbon\Carbon::parse($proker->mekanisme->persiapan_tanggal_selesai)->format('n') : null;
                        $bulanPelaksanaanSelesai = isset($proker->mekanisme->pelaksanaan_tanggal_selesai) ? \Carbon\Carbon::parse($proker->mekanisme->pelaksanaan_tanggal_selesai)->format('n') : null;
                        $bulanEvaluasiSelesai = isset($proker->mekanisme->evaluasi_tanggal_selesai) ? \Carbon\Carbon::parse($proker->mekanisme->evaluasi_tanggal_selesai)->format('n') : null;
                        $bulanPelaporanSelesai = isset($proker->mekanisme->pelaporan_tanggal_selesai) ? \Carbon\Carbon::parse($proker->mekanisme->pelaporan_tanggal_selesai)->format('n') : null;
                    @endphp

                    <tr>
                        <td>Persiapan</td>
                        @for ($i = 1; $i <= 12; $i++)
                            <td style="{{ $i >= $bulanPersiapan && $i <= $bulanPersiapanSelesai ? 'background-color: red;' : '' }}"></td>
                        @endfor
                    </tr>

                    <tr>
                        <td>Pelaksanaan</td>
                        @for ($i = 1; $i <= 12; $i++)
                            <td style="{{ $i >= $bulanPelaksanaan && $i <= $bulanPelaksanaanSelesai ? 'background-color: red;' : '' }}"></td>
                        @endfor
                    </tr>

                    <tr>
                        <td>Evaluasi</td>
                        @for ($i = 1; $i <= 12; $i++)
                            <td style="{{ $i >= $bulanEvaluasi && $i <= $bulanEvaluasiSelesai ? 'background-color: red;' : '' }}"></td>
                        @endfor
                    </tr>

                    <tr>
                        <td>Pelaporan</td>
                        @for ($i = 1; $i <= 12; $i++)
                            <td style="{{ $i >= $bulanPelaporan && $i <= $bulanPelaporanSelesai ? 'background-color: red;' : '' }}"></td>
                        @endfor
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        
        <p class="text-bold">9. INDIKATOR KINERJA UTAMA</p>
        <table class="main-table">
            <thead>
                <tr class="bg-gray text-center">
                    <th width="30%">Kegiatan Utama</th>
                    <th colspan="2">Realisasi 2025</th>
                    <th colspan="2">Target 2026</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-left">Pendelegasian Kompetisi</td>
                    <td class="text-center" colspan="2">{{ $proker->indikator->pendelegasian_kompetisi_realisasi }}</td>
                    <td class="text-center" colspan="2">{{ $proker->indikator->pendelegasian_kompetisi_target }}</td>
                </tr>
                <tr>
                    <td class="text-left">Pendelegasian Non Kompetisi</td>
                    <td class="text-center" colspan="2">{{ $proker->indikator->pendelegasian_non_kompetisi_realisasi }}</td>
                    <td class="text-center" colspan="2">{{ $proker->indikator->pendelegasian_non_kompetisi_target }}</td>
                </tr>
                <tr>
                    <td class="text-left">Penyelenggaraan Kompetisi</td>
                    <td class="text-center" colspan="2">{{ $proker->indikator->penyelenggaraan_kompetisi_realisasi }}</td>
                    <td class="text-center" colspan="2">{{ $proker->indikator->penyelenggaraan_kompetisi_target }}</td>
                </tr>
                <tr>
                    <td class="text-left">Penyelenggaraan Non Kompetisi</td>
                    <td class="text-center" colspan="2">{{ $proker->indikator->penyelenggaraan_non_kompetisi_realisasi }}</td>
                    <td class="text-center" colspan="2">{{ $proker->indikator->penyelenggaraan_non_kompetisi_target }}</td>
                </tr>
            </tbody>
        </table>
        <br>

        <p class="text-bold">10. INDIKATOR KINERJA UTAMA</p>
        <p class="text-bold">A. Pendelegasian Kompetisi</p>
        <table class="main-table">
            <thead>
                <tr class="bg-gray text-center">
                    <th rowspan="2">No</th>
                    <th rowspan="2">Luaran Prestasi</th>
                    <th colspan="2">Realisasi 2025</th>
                    <th colspan="2">Target 2026</th>
                </tr>
                <tr class="bg-gray text-center">
                    <th>Delegasi</th>
                    <th>Prestasi</th>
                    <th>Delegasi</th>
                    <th>Prestasi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Juara 1, 2, 3</td>
                    <td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Apresiasi / Peserta</td>
                    <td></td><td></td><td></td><td></td>
                </tr>
            </tbody>
        </table>
        <br>
        
        <p class="text-bold">11. KEBERLANJUTAN</p>
        <p>{{ $proker->keberlanjutan_kegiatan ?? 'Penjelasan keterkaitan program kerja ormawa dengan peningkatan prestasi mahasiswa.' }}</p>
        <br>

        <p class="text-bold">12. PENANGGUNG JAWAB</p>
        <table class="main-table" style="width: 100%; border: none; border-collapse: collapse;">
            <tr>
                <td colspan="2" style="border: none; padding: 8px;">
                    Ketua Pelaksana: {{ $proker->nama_pic }} - ({{ $proker->nim_pic }}) - WA: {{ $proker->kontak_pic }}
                </td>
            </tr>
        </table>

        <div class="signature-wrapper">
            <p style="text-align: right;">Surakarta, {{ date('d F Y') }}</p>
            <table class="sig-table">
                <tr>
                    <td>
                        Pembina Ormawa<br>{{ $proker->nama_ormawa }}<br><br><br><br>
                        (.........................................)<br>
                    </td>
                    <td>
                        Ketua Pelaksana<br><br><br><br><br>
                        <strong>{{ $proker->nama_pic }}</strong><br>NIM. {{ $proker->nim_pic }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Mengetahui,<br>Kepala Sub Direktorat Prestasi Mahasiswa<br><br><br><br>
                        <strong>Ana Fitri Andriani, S.Sos., M.I.Kom.</strong><br>NIP. 197809062002122001
                    </td>
                    <td>
                        Menyetujui,<br>Kepala Seksi Prestasi<br><br><br><br>
                        <strong>Yopi Kristiawan, S.Kom.</strong><br>NIP. 1986080920150401
                    </td>
                </tr>
            </table>
        </div>

    </body>
    </html>