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

	public function actualizare_clasament_dupa_meci($competitie_id, $echipa1, $echipa2, $goluri1, $goluri2, $nat_sau_ech)
	{
		if( $nat_sau_ech== "on" )
		{
			$entitate1 = EchipaCompetitie::where('competitie_id','=',$competitie_id)->where('echipa_id','=',$echipa1)->get();
			$entitate2 = EchipaCompetitie::where('competitie_id','=',$competitie_id)->where('echipa_id','=',$echipa2)->get();
		}
		else
		{
			$entitate1 = EchipaCompetitie::where('competitie_id','=',$competitie_id)->where('nationala_id','=',$echipa1)->get();
			$entitate2 = EchipaCompetitie::where('competitie_id','=',$competitie_id)->where('nationala_id','=',$echipa2)->get();
		}

		if( $competitie_id != 1)
		{
			if($goluri1 > $goluri2)
			{
				$entitate1[0]->puncte += 3;

			}
			elseif($goluri1 < $goluri2)
			{
				$entitate2[0]->puncte += 3;
			}
			else
			{
				$entitate1[0]->puncte += 1;
				$entitate2[0]->puncte += 1;
			}

			$entitate1[0]->meciuri_jucate++;
			$entitate1[0]->goluri_date += $goluri1;
			$entitate1[0]->goluri_primite += $goluri2;
			$entitate1[0]->gol_averaj = $entitate1[0]->goluri_date - $entitate1[0]->goluri_primite;
			$entitate1[0]->save();

			$entitate2[0]->meciuri_jucate++;
			$entitate2[0]->goluri_date += $goluri2;
			$entitate2[0]->goluri_primite += $goluri1;
			$entitate2[0]->gol_averaj = $entitate2[0]->goluri_date - $entitate2[0]->goluri_primite;
			$entitate2[0]->save();

			$this->calculare_loc_clasament($competitie_id);
		}
	}

	public function calculare_loc_clasament( $competitie_id )
	{
		$echipe_competitii=EchipaCompetitie::where('competitie_id','=',$competitie_id)->orderBy('puncte','desc')->get();
		$contor=0;
		foreach($echipe_competitii as $entitate)
		{
			$entitate->loc=++$contor;
			$entitate->save();
		}
	}

	public function afisare_clasament( $competitie_id )
	{
		$echipe_competitii=EchipaCompetitie::where('competitie_id','=',$competitie_id)->orderBy('loc')->get();
		return view('clasament', compact('echipe_competitii') );
	}
}
