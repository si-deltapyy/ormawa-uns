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
}
