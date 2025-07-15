<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameScore extends Model
{
    protected $fillable = ['id','score','type_count','missed_type_count'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
