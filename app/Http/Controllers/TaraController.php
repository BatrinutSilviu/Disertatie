<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tara;

class TaraController extends Controller
{
	public function cauta(Request $request)
	{
		$cauta = $request->search;
		$tari = Tara::orderby('nume','asc')->select('nume')->whereRaw('LOWER(`nume`) LIKE ? ',['%'.strtolower($cauta).'%'])->limit(5)->get();

		$response = array();
		foreach($tari as $tara){
			$response[] = array("value"=>$tara->nume,"label"=>$tara->nume);
		}

		return response()->json($response);
	}
}
