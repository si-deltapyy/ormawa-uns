<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mekanisme extends Model
{
    use HasFactory;
    protected $table = 'mekanisme_rancangan';
    protected $fillable = [
        'persiapan_tempat',
        'persiapan_tanggal_mulai',
        'persiapan_tanggal_selesai',
        'persiapan_deskripsi',
        'pelaksanaan_tempat',
        'pelaksanaan_tanggal_mulai',
        'pelaksanaan_tanggal_selesai',
        'pelaksanaan_deskripsi',
        'evaluasi_tempat',
        'evaluasi_tanggal_mulai',
        'evaluasi_tanggal_selesai',
        'evaluasi_deskripsi',
        'pelaporan_tempat',
        'pelaporan_tanggal_mulai',
        'pelaporan_tanggal_selesai',
        'pelaporan_deskripsi',
    ];
}
