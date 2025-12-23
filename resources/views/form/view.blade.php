<table class="table table-bordered">
    <tr>
        <th>Komponen</th>
        <th>Detail</th>
    </tr>
    <tr>
        <td>Nama PIC</td>
        <td>{{$data->nama_pic}}</td>
    </tr>
    <tr>
        <td>NIM PIC</td>
        <td>{{$data->nama_pic}}</td>
    </tr>
    <tr>
        <td>Kontak PIC</td>
        <td>{{$data->kontak_pic}}</td>
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
        <td>Sumber Dana</td>
        <td>{{$data->sumber_dana}}</td>
    </tr>
    <tr>
        <td>Jumlah Dana</td>
        <td>@currency($data->jumlah_dana)</td>
    </tr>
    <tr>
        <td>Sumber Dana</td>
        <td><a href="{{$data->file_RAB}}">file
                RAB</a></td>
    </tr>
</table>

<table class="table table-bordered">
    <tr>
        <th>Mutu Luaran Kegiatan Mahasiswa</th>
        <th>Detail</th>
    </tr>
    @if($data->id_skim == 1)
    <tr>
        <td><strong>PR.01</strong> (Juara)</td>
        <td>{{$data->PR01}}</td>
    </tr>
    <tr>
        <td><strong>PR.02</ (Apresiasi/ Juara Umum)</strong>
        </td>
        <td>{{$data->PR01}}</td>
    </tr>
    <tr>
        <td><strong>PR.03</ (Peserta) </td>
        <td>{{$data->PR01}}</td>
    </tr>
    @endif
    @if($data->id_skim == 2)
    <tr>
        <td><strong>RG.01</stong>(Pembicara/Narasumber Seminar)
        </td>
        <td>{{$data->RG01}}</td>
    </tr>
    <tr>
        <td><strong>RG.02</stong>(Speaker Seminar)
        </td>
        <td>{{$data->RG01}}</td>
    </tr>
    <tr>
        <td><strong>RG.03</stong>(Peserta)
        </td>
        <td>{{$data->RG03}}</td>
    </tr>
    <tr>
        <td><strong>RG.04</stong>(Penulis Pertama Publikasi Karya Ilmiah)
        </td>
        <td>{{$data->RG04}}</td>
    </tr>
    <tr>
        <td><strong>RG.05</stong>(Penulis Buku ISBN)
        </td>
        <td>{{$data->RG05}}</td>
    </tr>
    <tr>
        <td><strong>RG.06</stong>(Wasit/ Juri)
        </td>
        <td>{{$data->RG06}}</td>
    </tr>
    <tr>
        <td><strong>RG.07</stong>(Pelatih)</td>
        <td>{{$data->RG07}}</td>
    </tr>
    <tr>
        <td><strong>RG.08</stong>(Penerbitan HAKI)
        </td>
        <td>{{$data->RG08}}</td>
    </tr>
    @endif
    @if($data->id_skim == 3)
    <tr>
        <td>MB.01 (Pertukaran Pelajar)</td>
        <td>{{$data->PR01}}</td>
    </tr>
    <tr>
        <td>MB.02 (Magang/Praktik Kerja)</td>
        <td>{{$data->PR01}}</td>
    </tr>
    <tr>
        <td>MB.03 (Asistensi Mengajar di Satuan Pendidikan)</td>
        <td>{{$data->PR01}}</td>
    </tr>
    <tr>
        <td>MB.04 (Penelitian/Riset)</td>
        <td>{{$data->PR01}}</td>
    </tr>
    <tr>
        <td>MB.05 (Proyek Kemanusiaan)</td>
        <td>{{$data->PR01}}</td>
    </tr>
    <tr>
        <td>MB.06 (Kegiatan Wirausaha)</td>
        <td>{{$data->PR01}}</td>
    </tr>
    <tr>
        <td>MB.07 (Studi/Proyek Independen)</td>
        <td>{{$data->PR01}}</td>
    </tr>
    <tr>
        <td>MB.08 (Membangun Desa/Kuliah Kerja Nyata Tematik)</td>
        <td>{{$data->PR01}}</td>
    </tr>
    @endif
    @if($data->id_skim == 4)
    <tr>
        <td>PR.01 -> Juara</td>
        <td>{{$data->PR01}}</td>
    </tr>
    <tr>
        <td>PR.02 -> Apresiasi/ Juara Umum</td>
        <td>{{$data->PR01}}</td>
    </tr>
    <tr>
        <td>PR.03 -> </td>
        <td>{{$data->PR01}}</td>
    </tr>
    @endif
    @if ($data->id_skim == 5)
    <tr>
        <td>Lainnya</td>
        <td>{{$data->LL}}</td>
    </tr>
    @endif

</table>