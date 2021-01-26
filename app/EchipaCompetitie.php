<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EchipaCompetitie extends Model
{
	protected $guarded=[];
    public function echipe()
    {
    	return $this->hasMany(Echipa::class);
    }
    public function competitii()
    {
    	return $this->hasMany(Competitie::class);
    }
}
