<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competitie;

class CompetitieController extends Controller
{
	public function cauta(Request $request)
	{
		$cauta = $request->search;
		$competitii = Competitie::orderby('nume','asc')->select('nume')->whereRaw('LOWER(`nume`) LIKE ? ',['%'.strtolower($cauta).'%'])->limit(5)->get();

		$response = array();
		foreach($competitii as $competitie){
			$response[] = array("value"=>$competitie->nume,"label"=>$competitie->nume);
		}

		return response()->json($response);
	}
}
