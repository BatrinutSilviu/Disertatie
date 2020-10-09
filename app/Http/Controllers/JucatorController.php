<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jucator;

class JucatorController extends Controller
{
	public function index()
	{
		$jucatori = \App\Jucator::all();
    	return view('Jucatori/jucator_index',compact('jucatori'));
	}
	public function adaugare()
	{
		return view('Jucatori/jucator_adaugare');
	}
	public function salvare()
	{
		$validat=request()->validate(['Nume' => ['required','min:3','max:45'],
			'Data_nasterii' => ['required','date','before:today'],
			'echipa_id' => ['numeric'],
			'Nationalitate' => ['required','min:2','max:2'],
			'Inaltime'=> ['numeric','min:140','max:220'],
			'Picior_preferat'=> 'in:stangul,dreptul,ambele',
			'Post' => 'in:portar,fundas,mijlocas,atacant']);
		Jucator::create($validat);
		// Jucator::create(request(['Nume','Data_nasterii','Inaltime','Picior_preferat','Post','Echipa','Nationalitate']));
		// Jucator::create([
		// 	'Nume' =>request('Nume'),
		// 	'Data_nasterii' =>request('Data_nasterii'),
		// 	'Echipa' =>request('Echipa'),
		// 	'Nationalitate' =>request('Nationalitate')
		// ]);
		// $jucator = new Jucator();
		// $jucator->Nume= request('Nume');
		// $jucator->Data_nasterii= request('Data_nasterii');
		// $jucator->Echipa= request('Echipa');
		// $jucator->Nationalitate= request('Nationalitate');
		//$jucator->save();
		return redirect('/jucator');
	}
	public function actualizare( $id )
	{
		 $jucator = Jucator::findOrFail($id);
 		 $validat=request()->validate(['Nume' => ['required','min:3','max:45'],
			'Data_nasterii' => ['required','date','before:today'],
			'echipa_id' => ['numeric'],
			'Nationalitate' => ['required','min:2','max:2'],
			'Inaltime'=> ['numeric','min:140','max:220'],
			'Picior_preferat'=> 'in:stangul,dreptul,ambele',
			'Post' => 'in:portar,fundas,mijlocas,atacant']);
		 $jucator->update($validat);
		// $jucator->Nume = request('Nume');
		// $jucator->save();

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
