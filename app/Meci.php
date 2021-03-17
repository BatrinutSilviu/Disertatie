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
    public function cartonase()
    {
        return $this->hasMany(Cartonase::class, 'meci_id', 'id');
    }
    public function echipa_gazda()
    {
    	return $this->hasOne(Echipa::class,'id','echipa_gazda_id');
    }
    public function echipa_oaspete()
    {
    	return $this->hasOne(Echipa::class,'id', 'echipa_oaspete_id');
    }
    public function nationala_gazda()
    {
        return $this->hasOne(Nationala::class,'id','nationala_gazda_id');
    }
    public function nationala_oaspete()
    {
        return $this->hasOne(Nationala::class,'id', 'nationala_oaspete_id');
    }
}
