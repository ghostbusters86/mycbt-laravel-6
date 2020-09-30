<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jawaban extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function pertanyaan() {
        return $this->belongsTo('App\Pertanyaan', 'pertanyaan_id', 'id');
    }

    public function penilaian() {
        return $this->belongsTo('App\Penilaian', 'penilaian_id', 'id');
    }
}
