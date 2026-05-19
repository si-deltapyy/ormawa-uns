<table border="1" style="width: 100%; border-collapse: collapse;">
    <tbody>
            <tr>
            <td colspan="9" style="text-align: center;">Anggaran Belanja</td>
        </tr>
        <tr>
            <td rowspan="2">Jenis Belanja</td>
            <td colspan="7" style="text-align: center;">Rincian Biaya</td>
            <td rowspan="2">Total Biaya</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">Volume</td>
            <td colspan="2" style="text-align: center;">Perhitungan</td>
            <td colspan="2" style="text-align: center;">Perhitungan</td>
            <td colspan="2">Harga Satuan</td>
        </tr>
        <tr>
            <td colspan="1">1</td>
            <td colspan="1">2</td>
            <td colspan="1">3</td>
            <td colspan="1">4</td>
            <td colspan="1">5</td>
            <td colspan="1">6*)</td>
            <td colspan="1">7</td>
            <td colspan="1">8</td>
            <td colspan="1">9**)</td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1">Vol.</td>
            <td colspan="1">sat</td>
            <td colspan="1">Vol.</td>
            <td colspan="1">sat</td>
            <td colspan="1">Vol.</td>
            <td colspan="1">sat</td>
            <td colspan="1">Vol.</td>
            <td colspan="1">Sat</td>
        </tr>
        @foreach ($rab as $namaBelanja => $items)
            {{-- Header Kelompok (Warna Biru) --}}
            <tr style="background-color: #00B0F0; color: white; border: 1px solid #000;">
                <td colspan="8"><strong>{{ $items->first()->mak->kode_mak }} {{ $items->first()->mak->nama_belanja }} </strong></td>
                {{-- Menghitung total per kelompok secara otomatis --}}
                <td><strong>Rp {{ number_format($items->sum('total_biaya'), 0, ',', '.') }}</strong></td>
            </tr>

            @foreach ($items as $item)
            <tr>
                <td >{{ $item->uraian_belanja }}</td>
                <td style="text-align: center;">{{ $item->volume }}</td>
                <td style="text-align: center;">{{ $item->satuan }}</td>
                <td style="text-align: center;">{{ $item->frekuensi }}</td>
                <td style="text-align: center;">{{ $item->satuan }}</td>
                <td style="text-align: center;">{{ $item->perhitungan}}</td>
                <td style="text-align: center;">{{ $item->satuan }}</td>
                <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        @endforeach
        <tr>
            <td colspan="8" style="text-align: right">Jumlah Anggaran</td>
            <td><strong>Rp {{ number_format($totalAnggaran, 0, ',', '.') }}</strong></td>
        </tr>
    </tbody>
</table>