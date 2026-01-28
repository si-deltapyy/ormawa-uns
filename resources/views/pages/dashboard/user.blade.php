@extends('layouts.dashboard')

@section('title')
    Organisasi Mahasiswa Universitas Sebelas Maret
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Hi, {{ Auth::user()->name }}</h4>
                @if ($dataAnggota->isEmpty())
                    <p class="card-subtitle mb-4 font-size-13">
                        Anda Belum Terdaftar di<strong> ORMAWA</strong>. Silahkan Hubungi Admin Untuk Mendaftar.
                    </p>
                @else
                <p class="card-subtitle mb-4 font-size-13">
                    Anda Terdaftar di <strong>{{ $dataAnggota->first()->nama_ormawa }}</strong> sebagai <strong>{{ $dataAnggota->first()->jabatan }}</strong>.
                </p>
                @endif
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Proker</h4>

                <table id="dataproker" class="table ">
                    <thead>
                        <tr>
                            <th>ID Kegiatan</th>
                            <th>Nama Proker</th>
                            <th>Tahun Ajuan</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($proker as $data)
                        <tr>
                            <td>{{ $data->id_kegiatan }}</td>
                            <td>{{ $data->nama_kegiatan }}</td>
                            <td>{{ $data->created_at }}</td>
                            <td>
                                <span class="badge badge-warning">Pending</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/inputprokerpage.js') }}"></script>
@endsection