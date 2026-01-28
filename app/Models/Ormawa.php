<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ormawa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "ormawa";

    protected $fillable = [
        'UID',
        'nama_ormawa',
        'nama_id',
    ];
    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }
}