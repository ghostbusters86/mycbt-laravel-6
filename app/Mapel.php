<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function pertanyaans() {
        return $this->belongsToMany('App\Pertanyaan');
    }

    public function events() {
        return $this->belongsToMany('App\Event');
    }
}
