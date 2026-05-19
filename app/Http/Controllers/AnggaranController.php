<?php

namespace App\Http\Controllers;

use App\Models\RABModel;
use Illuminate\Http\Request;
use App\Exports\AnggaranExport; // Import class export
use Maatwebsite\Excel\Facades\Excel; // Import facade excel

class AnggaranController extends Controller
{
    public function index(Request $request, $id) {
        // 1. Ambil data mentah
        $rabRaw = RABModel::where('proker_id', $id)->with('mak')->get();
        
        // 2. Hitung total keseluruhan
        $totalAnggaran = $rabRaw->sum('total_biaya');

        // 3. Kelompokkan data untuk tampilan tabel
        $rabGrouped = $rabRaw->groupBy(function($item) {
            return $item->mak->nama_belanja;
        });

        // --- LOGIKA DOWNLOAD START ---
        if ($request->get('export') == 'excel') {
            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\AnggaranExport($rabGrouped, $totalAnggaran, $id), 
                'Anggaran-Export.xlsx'
            );
        }
        // --- LOGIKA DOWNLOAD END ---

        // Tampilan Web View Biasa
        return view('exports.anggaran_excel', [
            'rab' => $rabGrouped,
            'totalAnggaran' => $totalAnggaran,
            'id' => $id
        ]);
    }
}