<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function mapels() {
        return $this->belongsToMany('App\Mapel');
    }
}
