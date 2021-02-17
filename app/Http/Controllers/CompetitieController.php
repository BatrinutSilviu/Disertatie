<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competitie;
use App\EchipaCompetitie;

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
	
	public function calculare_puncte_clasament()
	{

	}

	public function afisare_clasament( $competitie_id )
	{
		$echipe_competitii=EchipaCompetitie::where('competitie_id','=',$competitie_id)->orderBy('puncte','desc')->get();
		$contor=0;
		foreach($echipe_competitii as $entitate)
		{
			$entitate->loc=++$contor;
			$entitate->save();
		}
		return view('clasament', compact('echipe_competitii') );
	}
}
