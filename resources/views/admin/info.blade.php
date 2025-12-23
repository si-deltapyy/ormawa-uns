@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row justify-content-center gap-2">
        <div class="col-md col-sm">
            <a href="{{route('admin.show')}}">
                <button class="btn btn-secondary btn-lg my-3">Back</button>
            </a>

            <div class="float-end my-3 gap-2">
                <button type="button" class="btn btn-primary btn" data-bs-toggle="modal" data-bs-target="#details">
                    <i class="bi bi-plus-lg"></i>
                </button>
                <a href="{{route('admin.pdf', [$proker->id])}}" class="btn btn-primary btn" target="_blank">
                    <i class="bi bi-printer"></i>
                </a>

            </div>
            <div class="modal fade" id="details" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Target Program Kerja
                                {{$proker->judul_kegiatan}}
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @include('form.admin.detail')
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Komponen</th>
                            <th>Detail</th>
                        </tr>
                        <tr>
                            <td>Nama PIC</td>
                            <td>{{$proker->nama_pic}}</td>
                        </tr>
                        <tr>
                            <td>NIM PIC</td>
                            <td>{{$proker->nim_pic}}</td>
                        </tr>
                        <tr>
                            <td>Kontak PIC</td>
                            <td>{{$proker->kontak_pic}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>{{$proker->mulai}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>{{$proker->selesai}}</td>
                        </tr>
                        <tr>
                            <td>Sumber Dana</td>
                            <td>{{$proker->sumber_dana}}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Dana</td>
                            <td>@currency($proker->jumlah_dana)</td>
                        </tr>
                        <tr>
                            <td>Sumber Dana</td>
                            <td><a href="{{ asset('storage/'.$proker->filenames) }}" class="badge text-bg-primary link-underline-primary" target="_blank"> file RAB</a>
                            </td>
                        </tr>
                    </table>

                    <table class="table table-bordered">
                        <label for="" class="fw-bold mb-2"> Target Program Kerja</label>
                        @if($proker->skim_kegiatan == 1)
                        <tr>
                            <td><label for="">Juara</label></td>
                            <td>{{$targetproker->PR01}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Apresiasi/ Juara Umum</label></td>
                            <td>{{$targetproker->PR02}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Peserta</label></td>
                            <td>{{$targetproker->PR03}}</td>
                        </tr>
                        @elseif($proker->skim_kegiatan == 2)
                        <tr>
                            <td><label for="">Pembicara/Narasumber Seminar</label></td>
                            <td>{{$targetproker->RG01}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Speaker Seminar</label></td>
                            <td>{{$targetproker->RG02}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Peserta Pameran</label></td>
                            <td>{{$targetproker->RG03}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Penulis Pertama Publikasi Karya Ilmiah</label></td>
                            <td>{{$targetproker->RG04}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Penulis Buku ISBN</label></td>
                            <td>{{$targetproker->RG05}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Wasit/ Juri</label></td>
                            <td>{{$targetproker->RG06}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Pelatih</label></td>
                            <td>{{$targetproker->RG07}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Penerbitan HAKI</label></td>
                            <td>{{$targetproker->RG08}}</td>
                        </tr>
                        @elseif ($proker->skim_kegiatan == 3)
                        <tr>
                            <td><label for="">Pertukaran Pelajar</label></td>
                            <td>{{$targetproker->MB01}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Magang/Praktik Kerja</label></td>
                            <td>{{$targetproker->MB02}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Asistensi Mengajar di Satuan Pendidikan</label></td>
                            <td>{{$targetproker->MB03}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Penelitian/Riset</label></td>
                            <td>{{$targetproker->MB04}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Proyek Kemanusiaan</label></td>
                            <td>{{$targetproker->MB05}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Kegiatan Wirausaha</label></td>
                            <td>{{$targetproker->MB06}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Studi/Proyek Independen</label></td>
                            <td>{{$targetproker->MB07}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Membangun Desa/Kuliah Kerja Nyata Tematik</label></td>
                            <td>{{$targetproker->MB08}}</td>
                        </tr>
                        @elseif ($proker->skim_kegiatan == 4)
                        <tr>
                            <td><label for="">Pencegahan dan Penanganan Kekerasan Seksual (PPKS)</label></td>
                            <td>{{$targetproker->BN01}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Program Kegiatan Pencegahan dan Penanganan Anti Intoleransi bagi
                                    Mahasiswa</label></td>
                            <td>{{$targetproker->BN02}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Program Kegiatan Anti Perundungan bagi Mahasiswa</label></td>
                            <td>{{$targetproker->BN03}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Program Kegiatan Anti Korupsi bagi Mahasiswa</label></td>
                            <td>{{$targetproker->BN04}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Pembinaan Kewirausahaan Mahasiswa</label></td>
                            <td>{{$targetproker->BN05}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Program Pembinaan Karakter bagi Mahasiswa</label></td>
                            <td>{{$targetproker->BN06}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Program Pembinaan Bela Negara bagi Mahasiswa</label></td>
                            <td>{{$targetproker->BN07}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Program Pembinaan Wawasan Kebangsaan bagi mahasiswa</label></td>
                            <td>{{$targetproker->BN08}}</td>
                        </tr>
                        <tr>
                            <td><label for="">Program Pengembangan mental spiritual kebangsaan</label></td>
                            <td>{{$targetproker->BN09}}</td>
                        </tr>
                        @elseif ($proker->skim_kegiatan == 5)
                        <tr>
                            <td><label for="">Lainnya</label></td>
                            <td>{{$targetproker->LL}}</td>
                        </tr>
                        @endif
                        <tr>
                            <td><label for="">Status Finalisasi</label></td>
                            @if ($targetproker->status == 'belum')
                            <td><span class="badge text-bg-danger">{{$targetproker->status}}</span></td>
                            @else
                            <td><span class="badge text-bg-success">{{$targetproker->status}}</span></td>
                            @endif
                        </tr>
                    </table>

                    <button type="button" class="btn btn-primary btn-sm float-end rounded" data-bs-toggle="modal" data-bs-target="#final">
                        <span>Finalisasi Data</span>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="final" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Notifikasi Finalisasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.final', [$targetproker->id])}}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <p>Apakah data {{$proker->name}} sudah final?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Benar
                                    </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection