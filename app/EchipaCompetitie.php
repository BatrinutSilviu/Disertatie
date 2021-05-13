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
    public function nationale()
    {
        return $this->hasMany(Nationala::class);
    }
    public function competitii()
    {
    	return $this->hasMany(Competitie::class);
    }
    public function echipa()
    {
    	return $this->belongsTo(Echipa::class);
    }
    public function nationala()
    {
        return $this->belongsTo(Nationala::class);
    }
}
