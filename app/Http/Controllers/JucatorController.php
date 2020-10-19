<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jucator;
use App\Echipa;
use App\Nationala;
use App\Tara;
use DB;

class JucatorController extends Controller
{
	public function index()
	{
		$jucatori = Jucator::all();
    	return view('Jucatori/jucator_index',compact('jucatori'));
	}
	public function adaugare()
	{
		$echipe = Echipa::all();

		return view('Jucatori/jucator_adaugare', compact('echipe'));
	}
	public function salvare()
	{		

		//$validat=
		request()->validate(['Nume' => ['required','min:3','max:45'],
			'Data_nasterii' => ['required','date','before:today'],
			'echipa_id' => ['nullable','exists:echipas,Nume'],
			'nationala_id' => ['nullable','exists:nationalas,Nume'],
			'Nationalitate' => ['required','min:4'],
			'Inaltime'=> ['numeric','min:140','max:220'],
			'Picior_preferat'=> 'in:stangul,dreptul,ambele',
			'Post' => 'in:portar,fundas,mijlocas,atacant']);

		$echipa_id = Echipa::where('Nume','=',request('echipa_id'))->value('id');
		$nationala_id = Nationala::where('Nume','=',request('nationala_id'))->value('id');
		$Nationalitate = Tara::where('Nume','=',request('Nationalitate'))->value('Prescurtare');
		$jucator = new Jucator;
		$jucator->Nume = request('Nume');
		$jucator->Data_nasterii = request('Data_nasterii');
		$jucator->echipa_id = $echipa_id;
		$jucator->nationala_id = $nationala_id;
		$jucator->Nationalitate = $Nationalitate;
		$jucator->Inaltime = request('Inaltime');
		$jucator->Picior_preferat = request('Picior_preferat');
		$jucator->Post = request('Post');
			
		$jucator->save();

		return redirect('/jucator');
	}
	public function actualizare( $id )
	{
		$jucator = Jucator::findOrFail($id);
		request()->validate(['Nume' => ['required','min:3','max:45'],
			'Data_nasterii' => ['required','date','before:today'],
			'echipa_id' => ['nullable','exists:echipas,Nume'],
			'nationala_id' => ['nullable','exists:nationalas,Nume'],
			'Nationalitate' => ['required','min:4'],
			'Inaltime'=> ['numeric','min:140','max:220'],
			'Picior_preferat'=> 'in:stangul,dreptul,ambele',
			'Post' => 'in:portar,fundas,mijlocas,atacant']);

		$echipa_id = Echipa::where('Nume','=',request('echipa_id'))->value('id');
		$nationala_id = Nationala::where('Nume','=',request('nationala_id'))->value('id');
		$Nationalitate = Tara::where('Nume','=',request('Nationalitate'))->value('Prescurtare');
;
		$jucator->Nume = request('Nume');
		$jucator->Data_nasterii = request('Data_nasterii');
		$jucator->echipa_id = $echipa_id;
		$jucator->nationala_id = $nationala_id;
		$jucator->Nationalitate = $Nationalitate;
		$jucator->Inaltime = request('Inaltime');
		$jucator->Picior_preferat = request('Picior_preferat');
		$jucator->Post = request('Post');

		$jucator->save();

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
	public function cautare()
	{
		$jucatori = DB::table('jucators');
		$nume = request('Nume');
		$echipa = request('echipa');
		$tara = request('Nationalitate');
		if( !empty( $nume ) )
		{
			$jucatori->whereRaw('LOWER(`Nume`) LIKE ? ',['%'.strtolower($nume).'%']);
		}
		if( !empty( $echipa ) )
		{
			$echipa_id = Echipa::where('Nume','=',$echipa)->value('id');
			$jucatori->where('echipa_id',$echipa_id);	
		}
		if( !empty( $tara ) )
		{
			$nationalitate = Tara::where('Nume','=',$tara)->value('Prescurtare');
			$jucatori->where('Nationalitate',$nationalitate);
		}
		$jucatori = $jucatori->get();
    	return view('Jucatori/jucator_index',compact('jucatori'));
	}
}
