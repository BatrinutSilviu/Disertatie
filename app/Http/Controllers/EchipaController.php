<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Echipa;
use App\Tara;
use App\EchipaCompetitie;
use App\Competitie;
use App\Jucator;
use DB;
use Redirect;

class EchipaController extends Controller
{
	public function index()
	{		
		$echipe = DB::table('echipas');
		$nume = request('Nume');
		$tara = request('Tara');

		if( empty($nume) && empty($tara) )
		{
			$echipe = Echipa::Paginate(10);
			return view('Echipe/echipa_index',compact('echipe'));
		}

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
	public function cauta(Request $request)
	{
		$cauta = $request->search;
		$echipe = Echipa::orderby('nume','asc')->select('nume')->whereRaw('LOWER(`nume`) LIKE ? ',['%'.strtolower($cauta).'%'])->limit(5)->get();

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
			'Manager' => ['required','min:3','max:45']
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

		$tara = Tara::where('nume','=',request('Tara'))->value('id');
		$echipa = new Echipa;
		$echipa->nume = request('Nume');		
		$echipa->manager = request('Manager');
		$echipa->tara_id = $tara;
		$echipa->save();

		$competitii = request('competitii');
		for($i = 0; $i < count($competitii); $i++)
		{
			$entitate = new EchipaCompetitie;
			$entitate->echipa_id = $echipa->id;
			$id = Competitie::where('nume','=',$competitii[$i])->value('id');
			$entitate->competitie_id = $id;
			$entitate->save();
		}

		return redirect('/echipa');
	}
	public function actualizare( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		$echipa = Echipa::findOrFail($id);
		$validat=request()->validate([
			'Nume' => ['required','min:3','max:35'],
			'Tara' => ['required','min:4','max:15'],
			'Manager' => ['required','min:3','max:45']]);
		
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

		$tara = Tara::where('nume','=',request('Tara'))->value('id');
		$echipa->nume = request('Nume');
		$echipa->manager = request('Manager');
		$echipa->tara_id = $tara;

		$echipa->save();

		$competitii = request('competitii');
		$entitati = EchipaCompetitie::where('echipa_id','=',$echipa->id)->get();
		$min = min(count($competitii),count($entitati));
		for($i = 0; $i < $min; $i++)
		{
			$entitati[$i]->echipa_id = $echipa->id;
			$id = Competitie::where('nume','=',$competitii[$i])->value('id');
			$entitati[$i]->competitie_id = $id;
			$entitati[$i]->save();
		}
		$entitati = EchipaCompetitie::where('echipa_id','=',$echipa->id)->get();
		$diff = count($competitii) - count($entitati);
		for($i = 0; $i < $diff; $i++)
		{
			$entitate = new EchipaCompetitie;
			$entitate->echipa_id = $echipa->id;
			$id = Competitie::where('nume','=',$competitii[$i + count($entitati)])->value('id');
			$entitate->competitie_id = $id;
			$entitate->save();
		}
		$entitati = EchipaCompetitie::where('echipa_id','=',$echipa->id)->get();
		for($i = 0; $i < count($entitati) - count($competitii); $i++)
		{
			$entitati[$i + count($competitii)]->delete();
		}

		return redirect('echipa');
	}
	public function stergere( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		$entitati = EchipaCompetitie::where('echipa_id','=',$id);
		$entitati->delete();
		$jucatori = Jucator::where('echipa_id','=',$id)->get();
		foreach($jucatori as $jucator)
		{
			$jucator->echipa_id = NULL;
			$jucator->save();
		}
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
