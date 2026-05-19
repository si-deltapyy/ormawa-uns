<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $fillable = [
        'user_id',
        'ormawa_id',
        'jabatan',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class);
    }
    
}
