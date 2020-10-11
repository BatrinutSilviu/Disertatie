<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meci;

class MeciController extends Controller
{
    public function index()
	{
		$meciuri = \App\Meci::all();

    	return view('Meciuri/meciuri_index',compact('meciuri'));
	}
	public function adaugare()
	{
		return view('Meciuri/meciuri_adaugare');
	}
	public function salvare()
	{		
		$validat=request()->validate(['echipa_gazda_id' => ['required','numeric','exists:echipas,id','different:echipa_oaspete_id'],
			'data' => ['required','date','before:tomorrow'],
			'echipa_oaspete_id' => ['required','numeric','exists:echipas,id','different:echipa_gazda_id'],
			'goluri_gazde' => ['required','numeric','min:0','max:50'],
			'goluri_oaspeti' => ['required','numeric','min:0','max:50'],
			'competitie_id'=> ['required','numeric','exists:competities,id'],
			'teren'=> ['min:5','max:50'],
			'arbitru' => ['min:5','max:50']]);
		Meci::create($validat);

		return redirect('/meci');
	}
	public function actualizare( $id )
	{
		 $meci = Meci::findOrFail($id);
		$validat=request()->validate(['echipa_gazda_id' => ['required','numeric','exists:echipas,id'],
			'data' => ['required','date','before:tomorrow'],
			'echipa_oaspete_id' => ['required','numeric','exists:echipas,id'],
			'goluri_gazde' => ['required','numeric','min:0','max:50'],
			'goluri_oaspeti' => ['required','numeric','min:0','max:50'],
			'competitie_id'=> ['required','numeric','exists:competities,id'],
			'teren'=> ['min:5','max:50'],
			'arbitru' => ['min:5','max:50']]);
		 $meci->update($validat);

		return redirect('meci');
	}
	public function stergere( $id )
	{
		Meci::findOrFail($id)->delete();

		return redirect('meci');
	}
	public function modificare( $id)
	{
		$meci = Meci::findOrFail($id);

		return view('Meciuri/meciuri_modificare', compact('meci'));
	}
}
