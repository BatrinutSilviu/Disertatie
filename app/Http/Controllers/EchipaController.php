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
		$echipe = Echipa::Paginate(10);
    	return view('Echipe/echipa_index',compact('echipe'));
	}
	public function cauta(Request $request)
	{
		$cauta = $request->search;
		$echipe = Echipa::orderby('Nume','asc')->select('nume')->whereRaw('LOWER(`nume`) LIKE ? ',['%'.strtolower($cauta).'%'])->limit(5)->get();

		$response = array();
		foreach($echipe as $echipa){
			$response[] = array("value"=>$echipa->nume,"label"=>$echipa->nume);
		}

		return response()->json($response);
	}
	public function adaugare()
	{
		abort_if( auth()->id() !==1 ,403);
		return view('Echipe/echipa_adaugare');
	}
	public function salvare()
	{
		abort_if( auth()->id() !==1 ,403);
		$validat=request()->validate([
			'Nume' => ['required','min:3','max:35'],
			'Tara' => ['required','min:4','max:15'],
			'Liga' => ['required','min:4','max:25'],
			'Manager' => ['required','min:3','max:45']
		]);
		$tara = Tara::where('nume','=',request('Tara'))->value('id');
		$echipa = new Echipa;
		$echipa->nume = request('Nume');
		$echipa->liga = request('Liga');			
		$echipa->manager = request('Manager');
		$echipa->tara_id = $tara;
		$echipa->save();
		return redirect('/echipa');
	}
	public function actualizare( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		 $echipa = Echipa::findOrFail($id);
 		 $validat=request()->validate(['Nume' => ['required','min:3','max:35'],
			'Tara' => ['required','min:4','max:15'],
			'Liga' => ['required','min:4','max:25'],
			'Manager' => ['required','min:3','max:45']]);
		
		$tara = Tara::where('nume','=',request('Tara'))->value('id');
		$echipa->nume = request('Nume');
		$echipa->liga = request('Liga');
		$echipa->manager = request('Manager');
		$echipa->tara_id = $tara;

		$echipa->save();

		return redirect('echipa');
	}
	public function stergere( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		Echipa::findOrFail($id)->delete();
		return redirect('echipa');
	}
	public function modificare( $id)
	{
		abort_if( auth()->id() !==1 ,403);
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
			$echipe->whereRaw('LOWER(`nume`) LIKE ? ',['%'.strtolower($nume).'%']);
		}
		if( !empty( $tara ) )
		{
			$nationalitate = Tara::where('nume','=',$tara)->value('id');
			$echipe->where('tara_id',$nationalitate);
		}
		$echipe = $echipe->paginate(10);
    	return view('Echipe/echipa_index',compact('echipe'));
	}
}
