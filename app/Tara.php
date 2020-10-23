<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tara extends Model
{
    protected $guarded=[];
    public function nationala()
    {
        return $this->hasOne(Nationala::class);
    }
    public function echipa()
    {
        return $this->hasOne(Echipa::class);
    }
}
