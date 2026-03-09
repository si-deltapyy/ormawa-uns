<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proker extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "proker";

    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'id_ormawa', 'id');
    }
    
    public function mekanisme()
    {
        return $this->belongsTo(Mekanisme::class, 'id_mekanisme_rancangan', 'id');
    }

    public function skim()
    {
        return $this->belongsTo(Skim::class, 'id_skim', 'id');
    }

    public function jenisKegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'id_jenis_kegiatan', 'id');
    }

    public function luaranKegiatan()
    {
        return $this->belongsTo(Luaran::class, 'id_luaran_kegiatan', 'id');
    }

    public function logsAjuan()
    {
        return $this->hasMany(LogsAjuan::class, 'proker_id', 'id');
    }

    public function indikator()
    {
        return $this->belongsTo(Indikator::class, 'id_indikator', 'id');
    }

    public function rabProker()
    {
        return $this->hasOne(RABModel::class, 'proker_id', 'id')->latestOfMany();
    }

    public function rab()
    {
        return $this->hasMany(RABModel::class, 'proker_id');
    }



    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->number =  TargetProker::where('id', $model->id)->max('number') + 1;
    //     });
    // }
}
