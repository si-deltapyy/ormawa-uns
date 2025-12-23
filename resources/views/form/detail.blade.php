<form class="" action="{{ route('ormawa.skim.store')}}" method="post">
    @csrf
    <table class="table">
        <tr>
            <th>Komponen</th>
            <th>Detail</th>
        </tr>
        <input type="hidden" name="kode_proker" value="{{$data->ID}}">
        @if($data->id_skim == 1)
        <tr>
            <td><label for="">Juara</label></td>
            <td><input class="form-control" type="text" name="PR.01" id=""></td>
        </tr>
        <tr>
            <td><label for="">Apresiasi/ Juara Umum</label></td>
            <td><input class="form-control" type="text" name="PR.02" id=""></td>
        </tr>
        <tr>
            <td><label for="">Peserta</label></td>
            <td><input class="form-control" type="text" name="PR.03" id=""></td>
        </tr>
        @endif
        @if($data->id_skim == 2)
        <tr>
            <td><label for="">Pembicara/Narasumber Seminar</label></td>
            <td><input class="form-control" type="text" name="RG.01" id=""></td>
        </tr>
        <tr>
            <td><label for="">Speaker Seminar</label></td>
            <td><input class="form-control" type="text" name="RG.02" id=""></td>
        </tr>
        <tr>
            <td><label for="">Peserta Pameran</label></td>
            <td><input class="form-control" type="text" name="RG.03" id=""></td>
        </tr>
        <tr>
            <td><label for="">Penulis Pertama Publikasi Karya Ilmiah</label></td>
            <td><input class="form-control" type="text" name="RG.04" id=""></td>
        </tr>
        <tr>
            <td><label for="">Penulis Buku ISBN</label></td>
            <td><input class="form-control" type="text" name="RG.05" id=""></td>
        </tr>
        <tr>
            <td><label for="">Wasit/ Juri</label></td>
            <td><input class="form-control" type="text" name="RG.06" id=""></td>
        </tr>
        <tr>
            <td><label for="">Pelatih</label></td>
            <td><input class="form-control" type="text" name="RG.07" id=""></td>
        </tr>
        <tr>
            <td><label for="">Penerbitan HAKI</label></td>
            <td><input class="form-control" type="text" name="RG.08" id=""></td>
        </tr>
        @endif
        @if($data->id_skim == 3)
        <tr>
            <td><label for="">Pertukaran Pelajar</label></td>
            <td><input class="form-control" type="text" name="MB.01" id=""></td>
        </tr>
        <tr>
            <td><label for="">Magang/Praktik Kerja</label></td>
            <td><input class="form-control" type="text" name="MB.02" id=""></td>
        </tr>
        <tr>
            <td><label for="">Asistensi Mengajar di Satuan Pendidikan</label></td>
            <td><input class="form-control" type="text" name="MB.03" id=""></td>
        </tr>
        <tr>
            <td><label for="">Penelitian/Riset</label></td>
            <td><input class="form-control" type="text" name="MB.04" id=""></td>
        </tr>
        <tr>
            <td><label for="">Proyek Kemanusiaan</label></td>
            <td><input class="form-control" type="text" name="MB.05" id=""></td>
        </tr>
        <tr>
            <td><label for="">Kegiatan Wirausaha</label></td>
            <td><input class="form-control" type="text" name="MB.06" id=""></td>
        </tr>
        <tr>
            <td><label for="">Studi/Proyek Independen</label></td>
            <td><input class="form-control" type="text" name="MB.07" id=""></td>
        </tr>
        <tr>
            <td><label for="">Membangun Desa/Kuliah Kerja Nyata Tematik</label></td>
            <td><input class="form-control" type="text" name="MB.08" id=""></td>
        </tr>
        @endif
        @if($data->id_skim == 4)
        <tr>
            <td><label for="">Pencegahan dan Penanganan Kekerasan Seksual (PPKS)</label></td>
            <td><input class="form-control" type="text" name="BN.01" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Kegiatan Pencegahan dan Penanganan Anti Intoleransi bagi Mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN.02" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Kegiatan Anti Perundungan bagi Mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN.03" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Kegiatan Anti Korupsi bagi Mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN.04" id=""></td>
        </tr>
        <tr>
            <td><label for="">Pembinaan Kewirausahaan Mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN.05" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Pembinaan Karakter bagi Mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN.06" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Pembinaan Bela Negara bagi Mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN.07" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Pembinaan Wawasan Kebangsaan bagi mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN.08" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Pengembangan mental spiritual kebangsaan</label></td>
            <td><input class="form-control" type="text" name="BN.09" id=""></td>
        </tr>
        @endif
        @if ($data->id_skim == 5)
        <tr>
            <td><label for="">Lainnya</label></td>
            <td><input class="form-control" type="text" name="LL" id=""></td>
        </tr>
        @endif
    </table>
    <button class="w-100 btn btn-primary btn-lg mt-3" type="submit">Submit</button>
</form>