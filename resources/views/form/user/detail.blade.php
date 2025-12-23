<form class="" action="{{ route('user.detail', [$targetproker->id])}}" method="post">
    @csrf
    <table class="table">
        <tr>
            <th>Komponen</th>
            <th>Detail</th>
        </tr>
        @if($proker->skim_kegiatan == 1)
        <tr>
            <td><label for="">Juara</label></td>
            <td><input class="form-control" type="text" name="PR01" id=""></td>
        </tr>
        <tr>
            <td><label for="">Apresiasi/ Juara Umum</label></td>
            <td><input class="form-control" type="text" name="PR02" id=""></td>
        </tr>
        <tr>
            <td><label for="">Peserta</label></td>
            <td><input class="form-control" type="text" name="PR03" id=""></td>
        </tr>
        @elseif($proker->skim_kegiatan == 2)
        <tr>
            <td><label for="">Pembicara/Narasumber Seminar</label></td>
            <td><input class="form-control" type="text" name="RG01" id=""></td>
        </tr>
        <tr>
            <td><label for="">Speaker Seminar</label></td>
            <td><input class="form-control" type="text" name="RG02" id=""></td>
        </tr>
        <tr>
            <td><label for="">Peserta Pameran</label></td>
            <td><input class="form-control" type="text" name="RG03" id=""></td>
        </tr>
        <tr>
            <td><label for="">Penulis Pertama Publikasi Karya Ilmiah</label></td>
            <td><input class="form-control" type="text" name="RG04" id=""></td>
        </tr>
        <tr>
            <td><label for="">Penulis Buku ISBN</label></td>
            <td><input class="form-control" type="text" name="RG05" id=""></td>
        </tr>
        <tr>
            <td><label for="">Wasit/ Juri</label></td>
            <td><input class="form-control" type="text" name="RG06" id=""></td>
        </tr>
        <tr>
            <td><label for="">Pelatih</label></td>
            <td><input class="form-control" type="text" name="RG07" id=""></td>
        </tr>
        <tr>
            <td><label for="">Penerbitan HAKI</label></td>
            <td><input class="form-control" type="text" name="RG08" id=""></td>
        </tr>
        @elseif($proker->skim_kegiatan == 3)
        <tr>
            <td><label for="">Pertukaran Pelajar</label></td>
            <td><input class="form-control" type="text" name="MB01" id=""></td>
        </tr>
        <tr>
            <td><label for="">Magang/Praktik Kerja</label></td>
            <td><input class="form-control" type="text" name="MB02" id=""></td>
        </tr>
        <tr>
            <td><label for="">Asistensi Mengajar di Satuan Pendidikan</label></td>
            <td><input class="form-control" type="text" name="MB03" id=""></td>
        </tr>
        <tr>
            <td><label for="">Penelitian/Riset</label></td>
            <td><input class="form-control" type="text" name="MB04" id=""></td>
        </tr>
        <tr>
            <td><label for="">Proyek Kemanusiaan</label></td>
            <td><input class="form-control" type="text" name="MB05" id=""></td>
        </tr>
        <tr>
            <td><label for="">Kegiatan Wirausaha</label></td>
            <td><input class="form-control" type="text" name="MB06" id=""></td>
        </tr>
        <tr>
            <td><label for="">Studi/Proyek Independen</label></td>
            <td><input class="form-control" type="text" name="MB07" id=""></td>
        </tr>
        <tr>
            <td><label for="">Membangun Desa/Kuliah Kerja Nyata Tematik</label></td>
            <td><input class="form-control" type="text" name="MB08" id=""></td>
        </tr>
        @elseif ($proker->skim_kegiatan == 4)
        <tr>
            <td><label for="">Pencegahan dan Penanganan Kekerasan Seksual (PPKS)</label></td>
            <td><input class="form-control" type="text" name="BN01" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Kegiatan Pencegahan dan Penanganan Anti Intoleransi bagi Mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN02" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Kegiatan Anti Perundungan bagi Mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN03" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Kegiatan Anti Korupsi bagi Mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN04" id=""></td>
        </tr>
        <tr>
            <td><label for="">Pembinaan Kewirausahaan Mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN05" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Pembinaan Karakter bagi Mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN06" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Pembinaan Bela Negara bagi Mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN07" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Pembinaan Wawasan Kebangsaan bagi mahasiswa</label></td>
            <td><input class="form-control" type="text" name="BN08" id=""></td>
        </tr>
        <tr>
            <td><label for="">Program Pengembangan mental spiritual kebangsaan</label></td>
            <td><input class="form-control" type="text" name="BN09" id=""></td>
        </tr>
        @elseif ($proker->skim_kegiatan == 5)
        <tr>
            <td><label for="">Lainnya</label></td>
            <td><input class="form-control" type="text" name="LL" id=""></td>
        </tr>
        @endif
    </table>
    <button class="w-100 btn btn-primary btn-lg mt-3" type="submit">Submit</button>
</form>