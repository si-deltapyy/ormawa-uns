<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SDG extends Model
{
    use HasFactory;
    protected $table = 'sdgs';
    protected $fillable = ['nama_sdgs', 'nomor_sdgs'];
}
