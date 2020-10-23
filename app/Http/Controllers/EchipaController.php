<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Echipa;
use App\Tara;
use DB;

class EchipaController extends Controller
{
    public function index()
	{
		$echipe = Echipa::all();
    	return view('Echipe/echipa_index',compact('echipe'));
	}
	public function cauta(Request $request)
	{
		$cauta = $request->search;
		$echipe = Echipa::orderby('Nume','asc')->select('Nume')->whereRaw('LOWER(`Nume`) LIKE ? ',['%'.strtolower($cauta).'%'])->limit(5)->get();

		$response = array();
		foreach($echipe as $echipa){
			$response[] = array("value"=>$echipa->Nume,"label"=>$echipa->Nume);
		}

		return response()->json($response);
	}
	public function adaugare()
	{
		return view('Echipe/echipa_adaugare');
	}
	public function salvare()
	{
		$validat=request()->validate([
			'Nume' => ['required','min:3','max:35'],
			'Tara' => ['required','min:4','max:15'],
			'Liga' => ['required','min:4','max:25'],
			'Manager' => ['required','min:3','max:45']
		]);
		$tara = Tara::where('Nume','=',request('Tara'))->value('id');
		$echipa = new Echipa;
		$echipa->Nume = request('Nume');
		$echipa->Liga = request('Liga');			
		$echipa->Manager = request('Manager');
		$echipa->tara_id = $tara;
		$echipa->save();
		return redirect('/echipa');
	}
	public function actualizare( $id )
	{
		 $echipa = Echipa::findOrFail($id);
 		 $validat=request()->validate(['Nume' => ['required','min:3','max:35'],
			'Tara' => ['required','min:4','max:15'],
			'Liga' => ['required','min:4','max:25'],
			'Manager' => ['required','min:3','max:45']]);
		
		$tara = Tara::where('Nume','=',request('Tara'))->value('id');
		$echipa->Nume = request('Nume');
		$echipa->Liga = request('Liga');
		$echipa->Manager = request('Manager');
		$echipa->tara_id = $tara;

		$echipa->save();

		return redirect('echipa');
	}
	public function stergere( $id )
	{
		Echipa::findOrFail($id)->delete();
		return redirect('echipa');
	}
	public function modificare( $id)
	{
		$echipa = Echipa::findOrFail($id);
		return view('Echipe/echipa_modificare', compact('echipa'));
	}
	public function getJucatori( $id )
	{
		$echipa = Echipa::findOrFail($id);
		return view('Echipe/echipa_jucatori', compact('echipa') );
	}
	public function afisare_echipa_mea()
	{
		return view('echipamea');
	}
	public function filtrare()
	{
		$echipe = DB::table('echipas');
		$nume = request('Nume');
		$tara = request('Tara');
		if( !empty( $nume ) )
		{
			$echipe->whereRaw('LOWER(`Nume`) LIKE ? ',['%'.strtolower($nume).'%']);
		}
		if( !empty( $tara ) )
		{
			$nationalitate = Tara::where('Nume','=',$tara)->value('Prescurtare');
			$echipe->where('Tara',$nationalitate);
		}
		$echipe = $echipe->get();
    	return view('Echipe/echipa_index',compact('echipe'));
	}
}
