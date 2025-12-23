@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row justify-content-center gap-2">
        <div class="col-md col-sm">
            <a href="{{route('user.show')}}">
                <button class="w-auto btn btn-secondary btn-lg my-3">Back</button>
            </a>
            <div class="card">
                <div class="card-body">
                    <form class="" action="{{route('user.update', [$sample->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <table class="table">
                            <tr>
                                <th>Komponen</th>
                                <th>Detail</th>
                            </tr>
                            <tr>
                                <td>Nama Kegiatan</td>
                                <td>
                                    <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" name="title" placeholder="{{$sample->nama_kegiatan}}" required>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Kegiatan</td>
                                <td>
                                    <select class="form-select @error('jenis') is-invalid @enderror" name="jenis" required>
                                        <option selected></option>
                                        <option value="Pendelegasian Kegiatan Non Kompetisi">Pendelegasian
                                            Kegiatan Non Kompetisi</option>
                                        <option value="Pendelegasian Kegiatan Kompetisi">Pendelegasian
                                            Kegiatan Kompetisi</option>
                                        <option value="Penyelenggara Kegiatan Kompetisi">Penyelenggara Kegiatan
                                            Kompetisi</option>
                                        <option value="Penyelenggara Kegiatan Non Kompetisi">Penyelenggara
                                            Kegiatan Non Kompetisi</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Kategori Kegiatan</td>
                                <td>
                                    <select class="form-select @error('category') is-invalid @enderror" name="category" required>
                                        <option selected> </option>
                                        <option value="Puspresnas/Belmawa">Puspresnas/Belmawa
                                        </option>
                                        <option value="Non Puspresnas/Belmawa">Non Puspresnas/Belmawa
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Skim Kegiatan</td>
                                <td>
                                    <select class="form-select @error('skim') is-invalid @enderror" name="skim" required>
                                        <option selected> </option>
                                        @foreach ($skim as $item)
                                        <option value="{{$item->id}}">{{$item->nama_skim}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Tingkat Kegiatan</td>
                                <td>
                                    <select class="form-select @error('tingkat') is-invalid @enderror" name="tingkat" required>
                                        <option selected> </option>
                                        <option value="Provinsi/Wilayah">Provinsi/Wilayah </option>
                                        <option value="Nasional">Nasional </option>
                                        <option value="Internasional">Internasional </option>
                                        <option value="Lokal">Lokal </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>NIM PIC</td>
                                <td><input type="text" class="form-control" name="nim" id="" placeholder="{{$sample->nim_pic}}" required></td>
                            </tr>
                            <tr>
                                <td>Kontak PIC</td>
                                <td><input type="text" class="form-control" name="kontak" id="" placeholder="{{$sample->kontak_pic}}" required></td>
                            </tr>
                            <tr>
                                <td>Tanggal Mulai Kegiatan</td>
                                <td><input type="date" class="form-control" name="start" id="" required></td>
                            </tr>
                            <tr>
                                <td>Tanggal Selesai Kegiatan</td>
                                <td><input type="date" class="form-control" name="end" id="" required></td>
                            </tr>
                            <tr>
                                <td>Total Dana</td>
                                <td><input type="text" class="form-control" name="total_dana" id="" placeholder="{{$sample->jumlah_dana}}" required></td>
                            </tr>
                            <tr>
                                <td>Sumber Dana</td>
                                <td>
                                    <input type="checkbox" name="dana[]" class="form-check-inline" value="Dana RKAT UNS"> Dana RKAT UNS
                                    <br />
                                    <input type="checkbox" name="dana[]" class="form-check-inline" value="Dana Sponsor">
                                    Dana Sponsor
                                    <br />
                                    <input type="checkbox" name="dana[]" class="form-check-inline" value="Dana Mandiri">
                                    Dana Mandiri
                                    <br />
                                    <input type="checkbox" name="dana[]" class="form-check-inline" value="Dana Registrasi Kegiatan"> Dana
                                    Registrasi Kegiatan <br />
                                    <input type="checkbox" name="dana[]" class="form-check-inline" value="Lainnya">
                                    Lainnya <br />
                                </td>
                            </tr>
                            <tr>
                                <td>RAB & TOR</td>
                                <td><input type="file" class="form-control" name="dokumen" id="" required></td>
                            </tr>
                        </table>
                        <button class="w-100 btn btn-primary btn-lg mt-3" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection