<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetSkim extends Model
{
    use HasFactory;
    protected $table = 'target_skim';
    protected $guarded = [];      
    public $timestamps = false;
}
