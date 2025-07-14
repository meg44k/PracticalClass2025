<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameScore extends Model
{
    public $timestamps = false;
    protected $fillable = ['id','score','type_count','missed_type_count'];
}
