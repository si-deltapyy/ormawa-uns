<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proker extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "proker";
    protected $fillable = ['id_mawa', 'jenis_kegiatan', 'kategori_kegiatan', 'skim_kegiatan', 'judul_kegiatan', 'nama_pic', 'nim_pic', 'kontak_pic', 'mulai', 'selesai', "sumber_dana", 'jumlah_dana', 'filenames'];

    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'ormawa');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->number =  TargetProker::where('id', $model->id)->max('number') + 1;
        });
    }
}
