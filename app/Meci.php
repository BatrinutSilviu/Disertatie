<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meci extends Model
{
    protected $guarded=[];
    public function competitie()
    {
    	return $this->belongsTo(Competitie::class);
    }
}
