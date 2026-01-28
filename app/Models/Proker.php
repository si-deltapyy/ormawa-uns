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
    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->number =  TargetProker::where('id', $model->id)->max('number') + 1;
    //     });
    // }
}
