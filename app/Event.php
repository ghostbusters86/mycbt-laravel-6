<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function mapels() {
        return $this->hasMany('App\Mapel', 'event_id', 'id');
    }
}
