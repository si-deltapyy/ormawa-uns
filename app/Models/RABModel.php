<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RABModel extends Model
{
    use HasFactory;
    protected $table = 'rab_proker';
    protected $fillable = [
        'proker_id',
        'mak_id',
        'uraian_belanja',
        'volume',
        'frekuensi',
        'perhitungan',
        'tahun_anggaran',
        'harga_satuan',
        'total_biaya',
        'catatan',
        'is_approved',
    ];

    public function proker()
    {
        return $this->belongsTo(Proker::class, 'proker_id', 'id');
    }

    public function mak()
    {
        return $this->belongsTo(mak::class, 'mak_id', 'id');
    }
}
