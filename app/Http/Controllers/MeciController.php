<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meci;
use App\Marcator;
use App\Echipa;
use App\Competitie;
use App\Jucator;
use DB;

class MeciController extends Controller
{
    public function index()
	{
		$meciuri = \App\Meci::Paginate(10);

    	return view('Meciuri/meciuri_index',compact('meciuri'));
	}
	public function adaugare()
	{
		abort_if( auth()->id() !==1 ,403);
		return view('Meciuri/meciuri_adaugare');
	}
	public function salvare()
	{		
		abort_if( auth()->id() !==1 ,403);
		$validat=request()->validate(['echipa_gazda_id' => ['required','exists:echipas,nume','different:echipa_oaspete_id'],
			'data' => ['required','date','before:tomorrow'],
			'echipa_oaspete_id' => ['required','exists:echipas,nume','different:echipa_gazda_id'],
			'goluri_gazde' => ['required','numeric','min:0','max:50'],
			'goluri_oaspeti' => ['required','numeric','min:0','max:50'],
			'competitie_id'=> ['required','exists:competities,nume'],
			'teren'=> ['min:5','max:50'],
			'arbitru' => ['min:5','max:50']]);

		$echipa_gazda_id = Echipa::where('nume','=',request('echipa_gazda_id'))->value('id');
		$echipa_oaspete_id = Echipa::where('nume','=',request('echipa_oaspete_id'))->value('id');
		$competitie_id = Competitie::where('nume','=',request('competitie_id'))->value('id');
		$meci = new Meci;
		$meci->echipa_gazda_id = $echipa_gazda_id;
		$meci->echipa_oaspete_id = $echipa_oaspete_id;
		$meci->data = request('data');
		$meci->goluri_gazde = request('goluri_gazde');
		$meci->goluri_oaspeti = request('goluri_gazde');
		$meci->competitie_id = $competitie_id;
		$meci->teren = request('teren');
		$meci->arbitru = request('arbitru');	
		$meci->save();

		for ( $i=0; $i < count(request('marcator')); $i++ ) 
		{ 
			$marcator = new Marcator();
			$marcator->jucator_id = Jucator::where('nume','=',request('marcator')[$i])->value('id');
			$marcator->assist_id = Jucator::where('nume','=',request('assist')[$i])->value('id');
			$marcator->minut = request('minut')[$i];
			$marcator->penalty = request('penalty')[$i];
			$marcator->picior = request('picior')[$i];
			$meci->marcatori()->save($marcator);
		}
		return redirect('/meci');
	}
	public function actualizare( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		$meci = Meci::findOrFail($id);
		$validat=request()->validate(['echipa_gazda_id' => ['required','exists:echipas,nume','different:echipa_oaspete_id'],
			'data' => ['required','date','before:tomorrow'],
			'echipa_oaspete_id' => ['required','exists:echipas,nume','different:echipa_gazda_id'],
			'goluri_gazde' => ['required','numeric','min:0','max:50'],
			'goluri_oaspeti' => ['required','numeric','min:0','max:50'],
			'competitie_id'=> ['required','exists:competities,nume'],
			'teren'=> ['min:5','max:50'],
			'arbitru' => ['min:5','max:50']]);

		$echipa_gazda_id = Echipa::where('nume','=',request('echipa_gazda_id'))->value('id');
		$echipa_oaspete_id = Echipa::where('nume','=',request('echipa_oaspete_id'))->value('id');
		$competitie_id = Competitie::where('nume','=',request('competitie_id'))->value('id');
		$meci->echipa_gazda_id = $echipa_gazda_id;
		$meci->echipa_oaspete_id = $echipa_oaspete_id;
		$meci->data = request('data');
		$meci->goluri_gazde = request('goluri_gazde');
		$meci->goluri_oaspeti = request('goluri_gazde');
		$meci->competitie_id = $competitie_id;
		$meci->teren = request('teren');
		$meci->arbitru = request('arbitru');
		$meci->save();

		return redirect('meci');
	}
	public function stergere( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		Meci::findOrFail($id)->delete();

		return redirect('meci');
	}
	public function modificare( $id)
	{
		abort_if( auth()->id() !==1 ,403);
		$meci = Meci::findOrFail($id);

		return view('Meciuri/meciuri_modificare', compact('meci'));
	}
	public function filtrare()
	{
		$meciuri = DB::table('mecis');
		$echipa = request('echipa');
		$data = request('data');
		if( !empty( $echipa ) )
		{
			$echipa_id = Echipa::where('nume','=',$echipa)->value('id');
			$meciuri->where('echipa_gazda_id',$echipa_id)->orWhere('echipa_oaspete_id',$echipa_id);
		}
		if( !empty( $data ) )
		{
			$meciuri->where('data',$data);
		}
		$meciuri = $meciuri->paginate(10);
    	return view('Meciuri/meciuri_index',compact('meciuri'));
	}
}
