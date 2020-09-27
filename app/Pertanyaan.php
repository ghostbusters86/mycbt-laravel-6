<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $guarded = [];

    public function mapel() {
        return $this->belongsTo('App\Mapel', 'mapel_id', 'id');
    }
}
