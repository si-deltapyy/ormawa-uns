<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisKegiatan extends Model
{
    use HasFactory;
    protected $table = 'jenis_kegiatan';
    protected $fillable = ['jenis_kegiatan'];
    
}
