<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penilaian extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    protected static function boot() {
        parent::boot();
        static::deleting(function ($penilaians) {
            foreach ($penilaians->jawabans()->get() as $jawaban) {
                $jawaban->delete();
            }
        });
    }

    public function jawabans() {
        return $this->hasMany('App\Jawaban', 'penilaian_id', 'id');
    }
}
