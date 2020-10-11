<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitie extends Model
{
    protected $guarded=[];
    public function meciuri()
    {
    	return $this->hasMany(Meci::class);
    }
}
