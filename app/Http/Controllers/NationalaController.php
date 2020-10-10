<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nationala;

class NationalaController extends Controller
{
    public function index()
    {
		$nationale = \App\Nationala::all();
    	return view('Nationale/nationala_index',compact('nationale'));
    }
	public function cauta(Request $request)
	{
		$cauta = $request->search;
		$nationale = Nationala::orderby('Nume','asc')->select('id','Nume')->whereRaw('LOWER(`Nume`) LIKE ? ',['%'.strtolower($cauta).'%'])->limit(5)->get();

		$response = array();
		foreach($nationale as $nationala){
			$response[] = array("value"=>$nationala->id,"label"=>$nationala->Nume);
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
			'Prescurtare' => ['required','min:2','max:2'],
			'Afiliere' => ['required','min:4','max:15'],
			'Selectioner' => ['required','min:3','max:45']
		]);
		Nationala::create($validat);
		return redirect('/nationala');
	}
	public function actualizare( $id )
	{
		 $nationala = Nationala::findOrFail($id);
 		 $validat=request()->validate([
 		 	'Nume' => ['required','min:4','max:25'],
			'Prescurtare' => ['required','min:2','max:2'],
			'Afiliere' => ['required','min:4','max:15'],
			'Selectioner' => ['required','min:3','max:45']]);
		 $nationala->update($validat);

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
}
