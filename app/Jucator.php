<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jucator extends Model
{
    protected $guarded=[];
    public function echipa()
    {
    	return $this->belongsTo(Echipa::class);
    }
    public function nationala()
    {
        return $this->belongsTo(Nationala::class);
    }
}
