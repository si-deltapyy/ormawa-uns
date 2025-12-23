<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Template Evaluasi Ormawa Universitas Sebelas Maret</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        hr {
            border: solid 1px black;
            color: #FFFF00;
            height: 1px;
        }
    </style>
</head>

<body>
    <div class="col">
        <table class="table  text-center">
            <td class='w-25'>
                <img src="{{ asset('img/logo-uns.png') }}" style="width: 100%;">
            </td>
            <td class="mx-auto pt-3">
                <p>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, <br> RISET DAN TEKNOLOGI <br> <b>UNIVERSITAS SEBELAS MARET</b>
                    <br> Jalan Insinyur Sutami Nomor 36 A Kentingan Surakarta 57126 <br>
                    Telepon (0271) 646994, Faksimile (0271) 646994 <br>
                    Laman https://uns.ac.id
                </p>
            </td>
        </table>

        <hr>

        <p class="text-center" style="font-size: small;">
            FORMULIR MUTU LUARAN KEGIATAN<br>
            ORGANISASI KEMAHASISWAAN UNIVERSITAS SEBELAS MARET <br>
            TAHUN 2024
        </p>

        @foreach ($proker as $data)
        <table class="table table-sm my-3">
            <caption class="fw-bolder">Data Kegiatan Ormawa UNS</caption>
            <thead>
                <tr>
                    <th class="col-4">Komponen</th>
                    <th class="col-8">Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nama Ormawa</td>
                    <td>{{$data->UID}} - {{$data->nama_ormawa}}</td>
                </tr>
                <tr>
                    <td>Jenis Kegiatan</td>
                    <td>{{$data->jenis_kegiatan}}</td>
                </tr>
                <tr>
                    <td>Skim Kegiatan</td>
                    <td>{{$data->nama_skim}}</td>
                </tr>
                <tr>
                    <td>Kategori Kegiatan</td>
                    <td>{{$data->kategori_kegiatan}}</td>
                </tr>
                <tr>
                    <td>Judul Kegiatan</td>
                    <td>{{$data->nama_kegiatan}}</td>
                </tr>
                <tr>
                    <td>Tingkat Kegiatan</td>
                    <td>{{$data->tingkat_kegiatan}}</td>
                </tr>
                <tr>
                    <td>Ketua Pelaksana</td>
                    <td>{{$data->nama_pic}} - {{$data->nim_pic}} - {{$data->kontak_pic}}</td>
                </tr>
                <tr>
                    <td>Tanggal Mulai</td>
                    <td>{{$data->mulai}}</td>
                </tr>
                <tr>
                    <td>Tanggal Selesai</td>
                    <td>{{$data->selesai}}</td>
                </tr>
                <tr>
                    <td>Jumlah Dana</td>
                    <td>@currency($data->jumlah_dana)</td>
                </tr>
                <tr>
                    <td>Sumber Dana</td>
                    <td>{{$data->sumber_dana}}</td>
                </tr>
            </tbody>
        </table>


        <table class="table table-sm my-3 table-bordered border-dark">
            <caption class="fw-bolder">Data Target Luaran Kegiatan Ormawa UNS</caption>
            <thead>
                <tr>
                    <th class="col">Id</th>
                    <th class="col">Kategori Luaran</th>
                    <th class="col">Target</th>
                </tr>
            </thead>
            <tbody>
                @if($data->skim_kegiatan == 1)
                <tr>
                    <td><label for="">PR.01</label></td>
                    <td><label for="">Juara</label></td>
                    <td>{{$targetproker->PR01}}</td>
                </tr>
                <tr>
                    <td><label for="">PR.02</label></td>
                    <td><label for="">Apresiasi/ Juara Umum</label></td>
                    <td>{{$targetproker->PR02}}</td>
                </tr>
                <tr>
                    <td><label for="">PR.03</label></td>
                    <td><label for="">Peserta</label></td>
                    <td>{{$targetproker->PR03}}</td>
                </tr>
                @elseif($data->skim_kegiatan == 2)
                <tr>
                    <td><label for="">RG.01</label></td>
                    <td><label for="">Pembicara/Narasumber Seminar</label></td>
                    <td>{{$targetproker->RG01}}</td>
                </tr>
                <tr>
                    <td><label for="">RG.02</label></td>
                    <td><label for="">Speaker Seminar</label></td>
                    <td>{{$targetproker->RG02}}</td>
                </tr>
                <tr>
                    <td><label for="">RG.03</label></td>
                    <td><label for="">Peserta Pameran</label></td>
                    <td>{{$targetproker->RG03}}</td>
                </tr>
                <tr>
                    <td><label for="">RG.04</label></td>
                    <td><label for="">Penulis Pertama Publikasi Karya Ilmiah</label></td>
                    <td>{{$targetproker->RG04}}</td>
                </tr>
                <tr>
                    <td><label for="">RG.05</label></td>
                    <td><label for="">Penulis Buku ISBN</label></td>
                    <td>{{$targetproker->RG05}}</td>
                </tr>
                <tr>
                    <td><label for="">RG.06</label></td>
                    <td><label for="">Wasit/ Juri</label></td>
                    <td>{{$targetproker->RG06}}</td>
                </tr>
                <tr>
                    <td><label for="">RG.07</label></td>
                    <td><label for="">Pelatih</label></td>
                    <td>{{$targetproker->RG07}}</td>
                </tr>
                <tr>
                    <td><label for="">RG.08</label></td>
                    <td><label for="">Penerbitan HAKI</label></td>
                    <td>{{$targetproker->RG08}}</td>
                </tr>
                @elseif($data->skim_kegiatan == 3)
                <tr>
                    <td><label for="">MB.01</label></td>
                    <td><label for="">Pertukaran Pelajar</label></td>
                    <td>{{$targetproker->MB01}}</td>
                </tr>
                <tr>
                    <td><label for="">MB.02</label></td>
                    <td><label for="">Magang/Praktik Kerja</label></td>
                    <td>{{$targetproker->MB02}}</td>
                </tr>
                <tr>
                    <td><label for="">MB.03</label></td>
                    <td><label for="">Asistensi Mengajar di Satuan Pendidikan</label></td>
                    <td>{{$targetproker->MB03}}</td>
                </tr>
                <tr>
                    <td><label for="">MB.04</label></td>
                    <td><label for="">Penelitian/Riset</label></td>
                    <td>{{$targetproker->MB04}}</td>
                </tr>
                <tr>
                    <td><label for="">MB.05</label></td>
                    <td><label for="">Proyek Kemanusiaan</label></td>
                    <td>{{$targetproker->MB05}}</td>
                </tr>
                <tr>
                    <td><label for="">MB.06</label></td>
                    <td><label for="">Kegiatan Wirausaha</label></td>
                    <td>{{$targetproker->MB06}}</td>
                </tr>
                <tr>
                    <td><label for="">MB.07</label></td>
                    <td><label for="">Studi/Proyek Independen</label></td>
                    <td>{{$targetproker->MB07}}</td>
                </tr>
                <tr>
                    <td><label for="">MB.08</label></td>
                    <td><label for="">Membangun Desa/Kuliah Kerja Nyata Tematik</label></td>
                    <td>{{$targetproker->MB08}}</td>
                </tr>
                @elseif ($data->skim_kegiatan == 4)
                <tr>
                    <td><label for="">BN.01</label></td>
                    <td><label for="">Pencegahan dan Penanganan Kekerasan Seksual (PPKS)</label></td>
                    <td>{{$targetproker->BN01}}</td>
                </tr>
                <tr>
                    <td><label for="">BN.02</label></td>
                    <td><label for="">Program Kegiatan Pencegahan dan Penanganan Anti Intoleransi bagi Mahasiswa</label>
                    </td>
                    <td>{{$targetproker->BN02}}</td>
                </tr>
                <tr>
                    <td><label for="">BN.03</label></td>
                    <td><label for="">Program Kegiatan Anti Perundungan bagi Mahasiswa</label></td>
                    <td>{{$targetproker->BN03}}</td>
                </tr>
                <tr>
                    <td><label for="">BN.04</label></td>
                    <td><label for="">Program Kegiatan Anti Korupsi bagi Mahasiswa</label></td>
                    <td>{{$targetproker->BN04}}</td>
                </tr>
                <tr>
                    <td><label for="">BN.05</label></td>
                    <td><label for="">Pembinaan Kewirausahaan Mahasiswa</label></td>
                    <td>{{$targetproker->BN05}}</td>
                </tr>
                <tr>
                    <td><label for="">BN.06</label></td>
                    <td><label for="">Program Pembinaan Karakter bagi Mahasiswa</label></td>
                    <td>{{$targetproker->BN06}}</td>
                </tr>
                <tr>
                    <td><label for="">BN.07</label></td>
                    <td><label for="">Program Pembinaan Bela Negara bagi Mahasiswa</label></td>
                    <td>{{$targetproker->BN07}}</td>
                </tr>
                <tr>
                    <td><label for="">BN.08</label></td>
                    <td><label for="">Program Pembinaan Wawasan Kebangsaan bagi mahasiswa</label></td>
                    <td>{{$targetproker->BN08}}</td>
                </tr>
                <tr>
                    <td><label for="">BN.09</label></td>
                    <td><label for="">Program Pengembangan mental spiritual kebangsaan</label></td>
                    <td>{{$targetproker->BN09}}</td>
                </tr>
                @elseif ($data->skim_kegiatan == 5)
                <tr>
                    <td><label for="">LL</label></td>
                    <td><label for="">Lainnya</label></td>
                    <td>{{$targetproker->LL}}</td>
                </tr>
                @endif
            </tbody>
        </table>
        @endforeach

        <div class="d-grid d-md-flex my-5">
            <div class="row">
                @foreach ($proker as $data)
                <table class="text-center">
                    <tr>
                        <td><label for="">Verifikasi Reviewer</label></td>
                        <td><label for="">Surakarta, &nbsp;&nbsp;&nbsp;&nbsp; Januari 2024 <br> Ketua Pelaksana</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br><br><br><br><br>
                            @if($data->ormawa == 48)
                            <label for="">Arif Wibowo, S.H. <br>NIP. 196705281987031002</label>
                            @else
                            <label for="">Dr. Singgih Hendarto, S.Pd., M.Pd. <br>NIP. 197204142006041001</label>
                            @endif
                        </td>
                        <td>
                            <br><br><br><br><br>
                            <label for="">{{$data->nama_pic}} <br> {{$data->nim_pic}} </label>
                        </td>
                    </tr>
                </table>

                @endforeach
            </div>
            <div class="col text-center mt-5">
                <p>Mengetahui, <br>
                    Kepala Biro Akademik dan Kemahasiswaan
                </p>
                <br><br><br><br><br>
                <p>
                    Ana Fitri Andriani, S.Sos., M.I.Kom. <br>
                    NIP. 197809062002122001
                </p>
            </div>
        </div>
    </div>
</body>