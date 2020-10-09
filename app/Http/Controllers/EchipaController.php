<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Echipa;

class EchipaController extends Controller
{
    //
    public function index()
	{
		$echipe = \App\Echipa::all();
    	return view('Echipe/echipa_index',compact('echipe'));
	}
	public function adaugare()
	{
		return view('Echipe/echipa_adaugare');
	}
	public function salvare()
	{
		$validat=request()->validate([
			'Nume' => ['required','min:3','max:35'],
			'Tara' => ['required','min:2','max:2'],
			'Liga' => ['required','min:4','max:25'],
			'Manager' => ['required','min:3','max:45']
		]);
		Echipa::create($validat);
		return redirect('/echipa');
	}
	public function actualizare( $id )
	{
		 $echipa = Echipa::findOrFail($id);
 		 $validat=request()->validate(['Nume' => ['required','min:3','max:35'],
			'Tara' => ['required','min:2','max:2'],
			'Liga' => ['required','min:4','max:25'],
			'Manager' => ['required','min:3','max:45']]);
		 $echipa->update($validat);

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
		// $jucatori = $echipa->jucatori();
		return view('Echipe/echipa_jucatori', compact('echipa') );
	}
}
