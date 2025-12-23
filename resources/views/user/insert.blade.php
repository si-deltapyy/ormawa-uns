@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Form Insert Data') }}</div>
                <div class="d-grid d-md-block">
                    <a href="{{route('user.show')}}">
                        <button class="btn btn-secondary mt-3 mx-3 ">Back</button>
                    </a>

                    <button type="button" class="btn btn-primary mt-3 mx-3 float-end" data-bs-toggle="modal" data-bs-target="#nim">
                        Verifikasi NIM
                    </button>

                    <div class="modal fade" id="nim" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Menu Verifikasi NIM</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <h4>Silahkan isi dengan NIM!</h4>
                                        <input type="text" name="search" id="search" placeholder="Enter nim" class="form-control" onfocus="this.value=''">
                                    </div>
                                    <div id="search_list"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <small class="text-secondary"><i>* silahkan cek nim di menu verifikasi nim</i></small>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
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
                                        <input class="form-control" type="text" placeholder="Search NIM" name="nim">
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
                                        <input type="text" class="form-control @error('jumlah') is-invalid @enderror mt-2" name="jumlah">
                                        @error('jumlah')
                                        <div class="invalid-feedback">
                                            Jumlah Dana kegiatan belum dicantumkan!
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm">
                                        <label for="rab" class="form-label fw-bolder">RAB Kegiatan</label><br>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            $.ajax({
                url: "search",
                type: "GET",
                data: {
                    'search': query
                },
                success: function(data) {
                    $('#search_list').html(data);
                }
            });
            //end of ajax call
        });
    });
</script>


@endsection