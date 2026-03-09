<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skim extends Model
{
    use HasFactory;

    protected $table = "skim_kegiatan";

    protected $fillable = [
        'kode_skim',
        'nama_skim',
    ];

    public $timestamps = false;

    public function indikatorKinerja()
    {
        return $this->hasMany(IndikatorKinerja::class, 'group_skim_id', 'id');
    }

    public function prokers()
    {
        return $this->hasMany(Proker::class, 'id_skim', 'id');
    }
}
