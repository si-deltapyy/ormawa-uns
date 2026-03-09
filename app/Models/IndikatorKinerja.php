<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorKinerja extends Model
{
    use HasFactory;
    protected $table = "indikator_kinerja";

    public function skim()
    {
        return $this->belongsTo(Skim::class, 'group_skim_id', 'id');
    }


}