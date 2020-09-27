<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function event() {
        return $this->belongsTo('App\Event', 'event_id', 'id');
    }
}
