<div class="col-md col-lg">
    <form class="needs-validation" novalidate action="{{ route('ormawa.form.store')}}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-12">
                <label for="ormawa" class="form-label">Ormawa</label>
                <select class="form-select @error('ormawa') is-invalid                           
            @enderror" name="ormawa" required>
                    <option value=""> </option>
                    @foreach ($ormawa as $data)
                    <option value="{{$data->ID}}">{{$data->nama_omawa}}</option>
                    @endforeach
                </select>
                @error('ormawa')
                <div class=" invalid-feedback">
                    Please select a valid ormawa.
                </div>
                @enderror
            </div>

            <div class="col-sm-4">
                <label for="jenis_kegiatan" class="form-label">Jenis Kegiatan</label>
                <select class="form-select @error('jenis_kegiatan') is-invalid
        @enderror" name="jenis_kegiatan" required>
                    <option value=""> </option>
                    <option value="Pendelegasian Kegiatan Non Kompetisi">Pendelegasian Kegiatan
                        Non Kompetisi</option>
                    <option value="Pendelegasian Kegiatan Kompetisi">Pendelegasian Kegiatan
                        Kompetisi</option>
                    <option value="Penyelenggara  Kegiatan Non Kompetisi">Penyelenggara Kegiatan
                        Non Kompetisi</option>
                    <option value="Penyelenggara Kegiatan Kompetisi">Penyelenggara Kegiatan
                        Kompetisi</option>
                </select>
                @error('jenis_kegiatan')
                <div class="invalid-feedback">
                    Please select a valid jenis kegiatan.
                </div>
                @enderror
            </div>

            <div class="col-sm-4">
                <label for="kategori_kegiatan" class="form-label ">Kategori Kegiatan</label>
                <select class="form-select @error('kategori_kegiatan') is-invalid @enderror" name="kategori_kegiatan"
                    required>
                    <option value=""> </option>
                    <option value="Puspresnas/Belmawa">Puspresnas/Belmawa</option>
                    <option value="Non Puspresnas/Belmawa">Non Puspresnas/Belmawa</option>
                </select>
                @error('kategori_kegiatan')
                <div class="invalid-feedback">
                    Please select a valid kategori kegiatan.
                </div>
                @enderror
            </div>

            <div class="col-sm-4">
                <label for="skim_kegiatan" class="form-label">Skim Kegiatan</label>
                <select class="form-select @error('skim_kegiatan') is-invalid @enderror" name="skim_kegiatan" required>
                    <option value=""> </option>
                    @foreach ($skim as $data)
                    <option value="{{$data->ID}}">{{$data->nama_skim}}</option>
                    @endforeach
                </select>
                @error('skim_kegiatan')
                <div class="invalid-feedback">
                    Please select a valid skim kegiatan.
                </div>
                @enderror
            </div>

            <div class="col-12">
                <label for="title" class="form-label">Judul Kegiatan</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    placeholder="Judul Kegiatan sesuai dengan hasil rapat kerja">
                @error('title')
                <div class="invalid-feedback">
                    Judul Kegiatan belum dicantumkan!
                </div>
                @enderror
            </div>

            <div class="col-sm-6">
                <label for="nim-PIC" class="form-label">NIM PIC</label>
                <input type="text" class="form-control @error('nim-PIC') is-invalid @enderror" name="nim"
                    placeholder="NIM">
                @error('nim-PIC')
                <div class="invalid-feedback">
                    NIM PIC belum dicantumkan!
                </div>
                @enderror
            </div>
            <div class="col-sm-6">
                <label for="nama-PIC" class="form-label">Nama PIC</label>
                <input type="text" class="form-control" name="" placeholder=" " disabled>
            </div>

            <div class="col-sm-12">
                <label for="contact" class="form-label">Kontak PIC</label>
                <input type="text" class="form-control @error('contact') is-invalid @enderror" name="contact"
                    placeholder="Kontak PIC (WA)">
                @error('contact')
                <div class="invalid-feedback">
                    Kontak PIC belum dicantumkan!
                </div>
                @enderror
            </div>

            <div class="col-sm-6">
                <label for="start" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control @error('start') is-invalid @enderror" name="start">
                @error('start')
                <div class="invalid-feedback">
                    Tanggal mulai kegiatan belum dicantumkan!
                </div>
                @enderror
            </div>
            <div class="col-sm-6">
                <label for="end" class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control @error('end') is-invalid @enderror" name="end">
                @error('end')
                <div class="invalid-feedback">
                    Tanggal selesai kegiatan belum dicantumkan!
                </div>
                @enderror
            </div>

            <div class="col-sm">
                <label for="jumlah" class="form-label">Jumlah Dana</label>
                <input type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah">
                @error('jumlah')
                <div class="invalid-feedback">
                    Jumlah Dana kegiatan belum dicantumkan!
                </div>
                @enderror
            </div>
            <div class="col-sm">
                <label for="rab" class="form-label">RAB Kegiatan</label>
                <input class="form-control @error('formrabFile') is-invalid @enderror" type="file" name="formrabFile">
                @error('formrabFile')
                <div class="invalid-feedback">
                    File RAB kegiatan belum dicantumkan!
                </div>
                @enderror
            </div>
            <div class="col-sm-12">
                <label for="dana" class="form-label">Sumber Dana</label>
                <div class="@error('dana') is-invalid @enderror">
                    <input type="checkbox" name="dana[]" value="Dana RKAT UNS"> Dana RKAT UNS
                    <br />
                    <input type="checkbox" name="dana[]" value="Dana Sponsor"> Dana Sponsor
                    <br />
                    <input type="checkbox" name="dana[]" value="Dana Mandiri"> Dana Mandiri
                    <br />
                    <input type="checkbox" name="dana[]" value="Dana Registrasi Kegiatan"> Dana
                    Registrasi Kegiatan <br />
                    <input type="checkbox" name="dana[]" value="Lainnya"> Lainnya <br />
                </div>
            </div>

        </div>
        <button class="w-100 btn btn-primary btn-lg mt-3" type="submit">Submit</button>
    </form>
</div>