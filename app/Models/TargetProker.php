<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetProker extends Model
{
    use HasFactory;

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
