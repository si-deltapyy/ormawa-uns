<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mak extends Model
{
    use HasFactory;
    protected $table = "mak";

    public function rabProker()
    {
        return $this->hasMany(RABModel::class, 'mak_id', 'id' );
    }
}
