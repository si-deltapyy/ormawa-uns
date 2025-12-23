@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form Insert Data') }}</div>
                <div class="d-grid gap-2 d-md-block">
                    <a href="{{route('admin.show')}}">
                        <button class="w-auto btn btn-secondary btn-lg m-3">Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label class="form-label fw-bolder">Organisasi Mahasiswa</label>
                                            <select class="form-select @error('ormawa') is-invalid @enderror" name="ormawa" required>
                                                <option selected> </option>
                                                @foreach ($ormawa as $data)
                                                <option value="{{$data->id}}">
                                                    {{$data->nama_ormawa}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('ormawa')
                                            <div class=" invalid-feedback">
                                                Please select a valid ormawa.
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col">
                                            <label class="form-label fw-bolder">Judul Kegiatan</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title">
                                            @error('title')
                                            <div class=" invalid-feedback">
                                                Judul Kegiatan belum dicantumkan!
                                            </div>
                                            @enderror

                                            @error('ormawa')
                                            <div class=" invalid-feedback">
                                                Please select a valid ormawa.
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-2">
                                        <div class="col">
                                            <label class="form-label fw-bolder">Jenis Kegiatan</label>
                                            <select class="form-select @error('jenis') is-invalid @enderror" name="jenis" required>
                                                <option selected> </option>
                                                <option value="Pendelegasian Kegiatan Non Kompetisi">Pendelegasian
                                                    Kegiatan Non Kompetisi</option>
                                                <option value="Pendelegasian Kegiatan Kompetisi">Pendelegasian
                                                    Kegiatan Kompetisi</option>
                                                <option value="Penyelenggara Kegiatan Kompetisi">Penyelenggara Kegiatan
                                                    Kompetisi</option>
                                                <option value="Penyelenggara Kegiatan Non Kompetisi">Penyelenggara
                                                    Kegiatan Non Kompetisi</option>
                                            </select>
                                            @error('jenis')
                                            <div class=" invalid-feedback">
                                                Please select a valid jenis kegiatan.
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label class="form-label fw-bolder">Kategori Kegiatan</label>
                                            <select class="form-select @error('category') is-invalid @enderror" name="category" required>
                                                <option selected> </option>
                                                <option value="Puspresnas/Belmawa">Puspresnas/Belmawa
                                                </option>
                                                <option value="Non Puspresnas/Belmawa">Non Puspresnas/Belmawa
                                                </option>
                                            </select>
                                            @error('category')
                                            <div class="invalid-feedback">
                                                Please select a valid kategori kegiatan.
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col">
                                            <label class="form-label fw-bolder">Skim Kegiatan</label>
                                            <select class="form-select @error('skim') is-invalid @enderror" name="skim" required>
                                                <option selected> </option>
                                                @foreach ($skim as $item)
                                                <option value="{{$item->id}}">{{$item->nama_skim}}</option>
                                                @endforeach
                                            </select>
                                            @error('skim')
                                            <div class="invalid-feedback">
                                                Please select a valid kategori kegiatan.
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label class="form-label fw-bolder">Tingkat Kegiatan</label>
                                            <select class="form-select @error('tingkat') is-invalid @enderror" name="tingkat" required>
                                                <option selected> </option>
                                                <option value="Provinsi/Wilayah">Provinsi/Wilayah </option>
                                                <option value="Nasional">Nasional </option>
                                                <option value="Internasional">Internasional </option>
                                                <option value="Lokal">Lokal </option>
                                            </select>
                                            @error('tingkat')
                                            <div class="invalid-feedback">
                                                Please select a valid tingkat kegiatan.
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col">
                                            <label class="form-label fw-bolder">NIM PIC</label>
                                            <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="" placeholder="NIM PIC">
                                            @error('nim')
                                            <div class="invalid-feedback">
                                                nim PIC belum dicantumkan!
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label class="form-label fw-bolder">Kontak PIC</label>
                                            <input type="text" class="form-control @error('kontak') is-invalid @enderror" name="kontak" id="" placeholder="Kontak PIC">
                                            @error('kontak')
                                            <div class="invalid-feedback">
                                                kontak PIC belum dicantumkan!
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm">
                                            <label for="start" class="form-label fw-bolder">Tanggal Mulai</label>
                                            <input type="date" class="form-control @error('start') is-invalid @enderror" name="start">
                                            @error('start')
                                            <div class="invalid-feedback">
                                                Tanggal mulai kegiatan belum dicantumkan!
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm">
                                            <label for="end" class="form-label fw-bolder">Tanggal Selesai</label>
                                            <input type="date" class="form-control @error('end') is-invalid @enderror" name="end">
                                            @error('end')
                                            <div class="invalid-feedback">
                                                Tanggal selesai kegiatan belum dicantumkan!
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm">
                                            <label for="jumlah" class="form-label fw-bolder">Jumlah Dana</label> <br>
                                            <small class="text-secondary"><i>*Nominal tanpa ada tanda baca</i></small>
                                            <input type="text" class="form-control @error('jumlah') is-invalid @enderror mt-2" name="jumlah" placeholder="5000000">
                                            @error('jumlah')
                                            <div class="invalid-feedback">
                                                Jumlah Dana kegiatan belum dicantumkan!
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm">
                                            <label for="rab" class="form-label fw-bolder">RAB Kegiatan</label> <br>
                                            <small class="text-secondary"><i>* untuk template RAB dapat dilihat
                                                    <a href="https://uns.id/RABormawaUNS" class="badge bg-success text-decoration-none" target="_blank">
                                                        disini
                                                    </a>
                                                </i></small>
                                            <input class="form-control @error('RABfile') is-invalid @enderror mt-2" type="file" name="RABfile">
                                            @error('RABfile')
                                            <div class="invalid-feedback">
                                                File RAB kegiatan belum dicantumkan!
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm">
                                            <label for="dana" class="form-label fw-bolder">Sumber Dana</label>
                                            <div class="@error('dana') is-invalid @enderror">
                                                <input type="checkbox" name="dana[]" value="Dana RKAT UNS"> Dana RKAT
                                                UNS
                                                <br />
                                                <input type="checkbox" name="dana[]" value="Dana Sponsor"> Dana Sponsor
                                                <br />
                                                <input type="checkbox" name="dana[]" value="Dana Mandiri"> Dana Mandiri
                                                <br />
                                                <input type="checkbox" name="dana[]" value="Dana Registrasi Kegiatan">
                                                Dana
                                                Registrasi Kegiatan <br />
                                                <input type="checkbox" name="dana[]" value="Lainnya"> Lainnya <br />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 my-3">
                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection