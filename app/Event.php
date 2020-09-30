<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function ($events) {
            foreach ($events->mapels()->get() as $mapel) {
                $mapel->delete();
            }
        });
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function mapels() {
        return $this->hasMany('App\Mapel', 'event_id', 'id');
    }
}
