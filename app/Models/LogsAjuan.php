<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogsAjuan extends Model
{
    use HasFactory;
    protected $table = 'logs_ajuan_proker';

    public function proker()
    {
        return $this->belongsTo(Proker::class, 'proker_id', 'id');
    }
}
