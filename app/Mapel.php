<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function ($mapels) {
            foreach ($mapels->pertanyaans()->get() as $pertanyaan) {
                $pertanyaan->delete();
            }
        });
    }

    public function pertanyaans() {
        return $this->hasMany('App\Pertanyaan', 'mapel_id', 'id');
    }

    public function event() {
        return $this->belongsTo('App\Event', 'event_id', 'id');
    }
}
