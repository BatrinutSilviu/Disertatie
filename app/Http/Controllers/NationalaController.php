<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nationala;
use App\Tara;
use App\EchipaCompetitie;
use App\Competitie;
use DB;
use Redirect;

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
			'Nume' => ['required','min:3','max:25'],
			'Afiliere' => ['required','min:3','max:15'],
			'Selectioner' => ['required','min:3','max:45']
		]);

		if( request('competitii') == null && request('numar_competitii') > 0 )
		{
			return Redirect::back()->withWarning( 'Numarul de competitii si numarul de campuri nu corespund' );
		}
		if( request('competitii') != null )
		{
			if( count( request('competitii') ) != request('numar_competitii') )
			{
				return Redirect::back()->withWarning( 'Numarul de competitii si numarul de campuri nu corespund' );
			}
		}

		$tara = Tara::where('nume','=',request('Nume'))->value('id');
		$nationala = new Nationala;
		$nationala->afiliere = request('Afiliere');
		$nationala->selectioner = request('Selectioner');
		$nationala->tara_id = $tara;
		$nationala->save();

		$competitii = request('competitii');
		for($i = 0; $i < count($competitii); $i++)
		{
			$entitate = new EchipaCompetitie;
			$entitate->nationala_id = $nationala->id;
			$id = Competitie::where('nume','=',$competitii[$i])->value('id');
			$entitate->competitie_id = $id;
			$entitate->save();
		}
		return redirect('/nationala');
	}
	public function actualizare( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		$nationala = Nationala::findOrFail($id);
		$validat=request()->validate([
			'Nume' => ['required','min:3','max:25'],
			'Afiliere' => ['required','min:3','max:15'],
			'Selectioner' => ['required','min:3','max:45']]);

		if( request('competitii') == null && request('numar_competitii') > 0 )
		{
			return Redirect::back()->withWarning( 'Numarul de competitii si numarul de campuri nu corespund' );
		}
		if( request('competitii') != null )
		{
			if( count( request('competitii') ) != request('numar_competitii') )
			{
				return Redirect::back()->withWarning( 'Numarul de competitii si numarul de campuri nu corespund' );
			}
		}

		$tara = Tara::where('nume','=',request('Nume'))->value('id');
		$nationala->afiliere = request('Afiliere');
		$nationala->selectioner = request('Selectioner');
		$nationala->tara_id = $tara;
		
		$nationala->save();

		$competitii = request('competitii');
		$entitati = EchipaCompetitie::where('nationala_id','=',$nationala->id)->get();
		$min = min(count($competitii),count($entitati));
		for($i = 0; $i < $min; $i++)
		{
			$entitati[$i]->nationala_id = $nationala->id;
			$id = Competitie::where('nume','=',$competitii[$i])->value('id');
			$entitati[$i]->competitie_id = $id;
			$entitati[$i]->save();
		}
		$entitati = EchipaCompetitie::where('nationala_id','=',$nationala->id)->get();
		$diff = count($competitii) - count($entitati);
		for($i = 0; $i < $diff; $i++)
		{
			$entitate = new EchipaCompetitie;
			$entitate->nationala_id = $nationala->id;
			$id = Competitie::where('nume','=',$competitii[$i + count($entitati)])->value('id');
			$entitate->competitie_id = $id;
			$entitate->save();
		}
		$entitati = EchipaCompetitie::where('nationala_id','=',$nationala->id)->get();
		for($i = 0; $i < count($entitati) - count($competitii); $i++)
		{
			$entitati[$i + count($competitii)]->delete();
		}

		return redirect('nationala');
	}
	public function stergere( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		$entitati = EchipaCompetitie::where('nationala_id','=',$id);
		$entitati->delete();
		$jucatori = Jucator::where('nationala_id','=',$id)->get();
		foreach($jucatori as $jucator)
		{
			$jucator->nationala_id = NULL;
			$jucator->save();
		}
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
