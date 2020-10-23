<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nationala extends Model
{
    protected $guarded=[];
    public function jucatori()
    {
    	return $this->hasMany(Jucator::class);
    }
    public function tara()
    {
    	return $this->belongsTo(Tara::class);
    }
}
