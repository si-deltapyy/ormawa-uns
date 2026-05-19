@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit Item Belanja</h4>
                
                <form action="{{ route('user.ajuan.rab.update', $rab->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Uraian Belanja</label>
                        <input type="text" name="uraian_belanja" class="form-control" value="{{ old('uraian_belanja', $rab->uraian_belanja) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Volume</label>
                                <input type="number" name="volume" id="volume" class="form-control" value="{{ old('volume', $rab->volume) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Frekuensi</label>
                                <input type="number" name="frekuensi" id="frekuensi" class="form-control" value="{{ old('frekuensi', $rab->frekuensi) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Harga Satuan</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga_satuan" id="harga_satuan" class="form-control" value="{{ old('harga_satuan', $rab->harga_satuan) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="mb-3">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea name="catatan" class="form-control" rows="3">{{ old('catatan', $rab->catatan) }}</textarea>
                    </div> --}}

                    <div class="alert alert-secondary border-0">
                        <h5 class="font-size-14 mb-0">Estimasi Total: <span id="display_total" class="fw-bold text-primary">Rp {{ number_format($rab->total_biaya, 0, ',', '.') }}</span></h5>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('user.ajuan.rab.index', $rab->proker_id) }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Script otomatis hitung total biaya di client side
    const volume = document.getElementById('volume');
    const frekuensi = document.getElementById('frekuensi');
    const harga = document.getElementById('harga_satuan');
    const display = document.getElementById('display_total');

    function calculate() {
        const total = (volume.value || 0) * (frekuensi.value || 0) * (harga.value || 0);
        display.innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
    }

    [volume, frekuensi, harga].forEach(el => el.addEventListener('input', calculate));
</script>
@endsection