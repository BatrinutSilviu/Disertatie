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
    public function marcatori()
    {
    	return $this->hasMany(Marcator::class, 'meci_id', 'id');
    }
    public function echipa_gazda()
    {
    	return $this->hasOne(Echipa::class,'id','echipa_gazda_id');
    }
    public function echipa_oaspete()
    {
    	return $this->hasOne(Echipa::class,'id', 'echipa_oaspete_id');
    }
    // public function marcatori()
    // {
    // 	return $this->hasMany(Marcator::class, 'meci_id', 'id');
    // }
}
