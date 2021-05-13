<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Jucator extends Model
{
	use Sortable;
	public $sortable = ['nume','inaltime','rating','data_nasterii','meciuri_jucate','minute_jucate','goluri','pase','pase_gol','pase_cheie','precizie_pase','sanse_create','cartonase_galbene','cartonase_rosii','parade','iesiri_din_poarta','boxari','goluri_primite','suturi','suturi_blocate','precizie_suturi','centrari','dueluri_aeriene_castigate','dueluri_aeriene_pierdute','degajari','mingi_profunzime','deposedat','driblinguri_incercate','driblinguri_reusite','dueluri_pierdute','dueluri_castigate','faulturi','interceptii','recuperari','faultat','deposedari_incercate','deposedari_reusite','plonjari'];
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
