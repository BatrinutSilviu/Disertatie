<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tara;

class TaraController extends Controller
{
	public function cauta(Request $request)
	{
		$cauta = $request->search;
		$tari = Tara::orderby('Nume','asc')->select('Nume')->whereRaw('LOWER(`Nume`) LIKE ? ',['%'.strtolower($cauta).'%'])->limit(5)->get();

		$response = array();
		foreach($tari as $tara){
			$response[] = array("value"=>$tara->Nume,"label"=>$tara->Nume);
		}

		return response()->json($response);
	}
}
