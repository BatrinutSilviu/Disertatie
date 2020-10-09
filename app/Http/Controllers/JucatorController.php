<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jucator;
use App\Echipa;

class JucatorController extends Controller
{
	public function index()
	{
		$jucatori = \App\Jucator::all();

    	return view('Jucatori/jucator_index',compact('jucatori'));
	}
	public function adaugare()
	{
		$echipe = \App\Echipa::all();

		return view('Jucatori/jucator_adaugare', compact('echipe'));
	}
	public function salvare()
	{		
		$validat=request()->validate(['Nume' => ['required','min:3','max:45'],
			'Data_nasterii' => ['required','date','before:today'],
			'echipa_id' => ['numeric'],
			'nationala_id' => ['numeric'],
			'Nationalitate' => ['required','min:2','max:2'],
			'Inaltime'=> ['numeric','min:140','max:220'],
			'Picior_preferat'=> 'in:stangul,dreptul,ambele',
			'Post' => 'in:portar,fundas,mijlocas,atacant']);
		Jucator::create($validat);

		return redirect('/jucator');
	}
	public function actualizare( $id )
	{
		 $jucator = Jucator::findOrFail($id);
 		 $validat=request()->validate(['Nume' => ['required','min:3','max:45'],
			'Data_nasterii' => ['required','date','before:today'],
			'echipa_id' => ['numeric'],
			'nationala_id' => ['numeric'],
			'Nationalitate' => ['required','min:2','max:2'],
			'Inaltime'=> ['numeric','min:140','max:220'],
			'Picior_preferat'=> 'in:stangul,dreptul,ambele',
			'Post' => 'in:portar,fundas,mijlocas,atacant']);
		 $jucator->update($validat);

		return redirect('jucator');
	}
	public function stergere( $id )
	{
		Jucator::findOrFail($id)->delete();

		return redirect('jucator');
	}
	public function modificare( $id)
	{
		$jucator = Jucator::findOrFail($id);

		return view('Jucatori/jucator_modificare', compact('jucator'));
	}
}
