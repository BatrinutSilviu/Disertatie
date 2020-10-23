<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nationala;
use App\Tara;
use DB;

class NationalaController extends Controller
{
    public function index()
    {
		$nationale = Nationala::all();
    	return view('Nationale/nationala_index',compact('nationale'));
    }
	public function cauta(Request $request)
	{
		$cauta = $request->search;
		$nationale = Nationala::orderby('Nume','asc')->select('Nume')->whereRaw('LOWER(`Nume`) LIKE ? ',['%'.strtolower($cauta).'%'])->limit(5)->get();

		$response = array();
		foreach($nationale as $nationala){
			$response[] = array("value"=>$nationala->Nume,"label"=>$nationala->Nume);
		}

		return response()->json($response);
	}
    public function adaugare()
	{
		return view('Nationale/nationala_adaugare');
	}
	public function salvare()
	{
		$validat=request()->validate([
			'Nume' => ['required','min:4','max:25'],
			'Afiliere' => ['required','min:4','max:15'],
			'Selectioner' => ['required','min:3','max:45']
		]);

		$tara = Tara::where('Nume','=',request('Nume'))->value('id');
		$nationala = new Nationala;
		$nationala->Afiliere = request('Afiliere');
		$nationala->Selectioner = request('Selectioner');
		$nationala->tara_id = $tara;
		$nationala->save();
		return redirect('/nationala');
	}
	public function actualizare( $id )
	{
		 $nationala = Nationala::findOrFail($id);
 		 $validat=request()->validate([
 		 	'Nume' => ['required','min:4','max:25'],
			'Afiliere' => ['required','min:4','max:15'],
			'Selectioner' => ['required','min:3','max:45']]);
		 
 		$tara = Tara::where('Nume','=',request('Nume'))->value('id');
		$nationala->Afiliere = request('Afiliere');
		$nationala->Selectioner = request('Selectioner');
		$nationala->tara_id = $tara;
		$nationala->save();

		return redirect('nationala');
	}
	public function stergere( $id )
	{
		Nationala::findOrFail($id)->delete();
		return redirect('nationala');
	}
	public function modificare( $id)
	{
		$nationala = Nationala::findOrFail($id);
		return view('Nationale/nationala_modificare', compact('nationala'));
	}
	public function getJucatori( $id )
	{
		$nationala = Nationala::findOrFail($id);
		return view('Nationale/nationala_jucatori', compact('nationala') );
	}
	public function filtrare()
	{
		$nationale = DB::table('nationalas');
		$nume = request('Nume');
		if( !empty( $nume ) )
		{
			$nationale->whereRaw('LOWER(`Nume`) LIKE ? ',['%'.strtolower($nume).'%']);
		}
		$nationale = $nationale->get();
    	return view('Nationale/nationala_index',compact('nationale'));
	}
}
