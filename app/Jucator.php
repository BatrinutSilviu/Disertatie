<?php

namespace App;

// use Spatie\Searchable\Searchable;
// use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;

class Jucator extends Model// implements Searchable
{
    protected $guarded=[];
    public function echipa()
    {
    	return $this->belongsTo(Echipa::class);
    }
    // public function getSearchResult(): SearchResult
    // {
    //    $url = route('members.show', $this->id);
         
    //    return new SearchResult($this, $this->Nume, $url);
    // }
}
