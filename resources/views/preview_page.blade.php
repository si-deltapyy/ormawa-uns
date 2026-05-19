@extends('layouts.app') @section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h3>Preview Anggaran</h3>
        <a href="{{ route('anggaran.index' , ['id' => $id, 'export' => 'excel']) }}" class="btn btn-success">
            Download Excel
        </a>
    </div>

    <div class="card p-4 shadow-sm" style="overflow-x: auto;">
        @include('exports.anggaran_excel', ['data' => $data])
    </div>
</div>
@endsection