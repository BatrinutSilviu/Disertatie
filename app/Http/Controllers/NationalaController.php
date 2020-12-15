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
		$nationale = Nationala::Paginate(10);
    	return view('Nationale/nationala_index',compact('nationale'));
    }
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
    public function adaugare()
	{
		abort_if( auth()->id() !==1 ,403);
		return view('Nationale/nationala_adaugare');
	}
	public function salvare()
	{
		abort_if( auth()->id() !==1 ,403);
		$validat=request()->validate([
			'Nume' => ['required','min:4','max:25'],
			'Afiliere' => ['required','min:4','max:15'],
			'Selectioner' => ['required','min:3','max:45']
		]);

		$tara = Tara::where('nume','=',request('Nume'))->value('id');
		$nationala = new Nationala;
		$nationala->afiliere = request('Afiliere');
		$nationala->selectioner = request('Selectioner');
		$nationala->tara_id = $tara;
		$nationala->save();
		return redirect('/nationala');
	}
	public function actualizare( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		 $nationala = Nationala::findOrFail($id);
 		 $validat=request()->validate([
 		 	'Nume' => ['required','min:4','max:25'],
			'Afiliere' => ['required','min:4','max:15'],
			'Selectioner' => ['required','min:3','max:45']]);
		 
 		$tara = Tara::where('nume','=',request('Nume'))->value('id');
		$nationala->afiliere = request('Afiliere');
		$nationala->selectioner = request('Selectioner');
		$nationala->tara_id = $tara;
		$nationala->save();

		return redirect('nationala');
	}
	public function stergere( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		Nationala::findOrFail($id)->delete();
		return redirect('nationala');
	}
	public function modificare( $id)
	{
		abort_if( auth()->id() !==1 ,403);
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
		$tara = Tara::where('nume','=',request('Nume'))->value('id');
		if( !empty( $tara) )
		{
			$nationale = Nationala::where('tara_id','=',$tara);
		}
		$nationale = $nationale->paginate(10);
    	return view('Nationale/nationala_index',compact('nationale'));
	}
}
