<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;
    protected $table = 'indikator_utama';
    protected $fillable = [
        'ormawa_id',
        'pendelegasian_kompetisi_realisasi',
        'pendelegasian_kompetisi_target',
        'pendelegasian_non_kompetisi_realisasi',
        'pendelegasian_non_kompetisi_target',
        'penyelenggaraan_kompetisi_realisasi',
        'penyelenggaraan_kompetisi_target',
        'penyelenggaraan_non_kompetisi_realisasi',
        'penyelenggaraan_non_kompetisi_target',
        'sdg_realisasi',
        'sdg_target',
    ];

    public function prokers()
    {
        return $this->hasMany(Proker::class, 'id_indikator', 'id');
    }

    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'ormawa_id', 'id');
    }


}
