<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jucator;
use App\Echipa;
use App\Nationala;
use App\Tara;
use DB;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class JucatorController extends Controller
{
	public function index()
	{
		$jucatori = Jucator::Paginate(10);
    	return view('Jucatori/jucator_index',compact('jucatori'));
	}
	public function adaugare()
	{
		abort_if( auth()->id() !==1 ,403);
		$echipe = Echipa::all();

		return view('Jucatori/jucator_adaugare', compact('echipe'));
	}
	public function cauta(Request $request)
	{
		$cauta = $request->search;
		$jucatori = Jucator::orderby('nume','asc')->select('nume')->whereRaw('LOWER(`nume`) LIKE ? ',['%'.strtolower($cauta).'%'])->limit(5)->get();

		$response = array();
		foreach($jucator as $jucatori){
			$response[] = array("value"=>$jucator->nume,"label"=>$jucator->nume);
		}

		return response()->json($response);
	}
	public function salvare()
	{		
		abort_if( auth()->id() !==1 ,403);
		request()->validate(['Nume' => ['required','min:3','max:45'],
			'Data_nasterii' => ['required','date','before:today'],
			'echipa_id' => ['nullable','exists:echipas,Nume'],
			'nationala_id' => ['nullable','exists:taras,Nume','same:Nationalitate'],
			'Nationalitate' => ['required','exists:taras,Nume'],
			'Inaltime'=> ['numeric','min:140','max:220'],
			'Picior_preferat'=> 'in:stangul,dreptul,ambele',
			'Post' => 'in:portar,fundas,mijlocas,atacant']);

		$echipa_id = Echipa::where('nume','=',request('echipa_id'))->value('id');
		$nationala_id = Tara::where('nume','=',request('nationala_id'))->value('id');
		$Nationalitate = Tara::where('nume','=',request('Nationalitate'))->value('prescurtare');
		$jucator = new Jucator;
		$jucator->nume = request('Nume');
		$jucator->data_nasterii = request('Data_nasterii');
		$jucator->echipa_id = $echipa_id;
		$jucator->nationala_id = $nationala_id;
		$jucator->nationalitate = $Nationalitate;
		$jucator->inaltime = request('Inaltime');
		$jucator->picior_preferat = request('Picior_preferat');
		$jucator->post = request('Post');
			
		$jucator->save();

		return redirect('/jucator');
	}
	public function actualizare( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		$jucator = Jucator::findOrFail($id);
		request()->validate(['Nume' => ['required','min:3','max:45'],
			'Data_nasterii' => ['required','date','before:today'],
			'echipa_id' => ['nullable','exists:echipas,Nume'],
			'nationala_id' => ['nullable','exists:taras,Nume','same:Nationalitate'],
			'Nationalitate' => ['required','exists:taras,Nume'],
			'Inaltime'=> ['numeric','min:140','max:220'],
			'Picior_preferat'=> 'in:stangul,dreptul,ambele',
			'Post' => 'in:portar,fundas,mijlocas,atacant']);

		$echipa_id = Echipa::where('nume','=',request('echipa_id'))->value('id');
		$nationala_id = Tara::where('nume','=',request('nationala_id'))->value('id');
		$Nationalitate = Tara::where('nume','=',request('Nationalitate'))->value('Prescurtare');
		$jucator->nume = request('Nume');
		$jucator->data_nasterii = request('Data_nasterii');
		$jucator->echipa_id = $echipa_id;
		$jucator->nationala_id = $nationala_id;
		$jucator->nationalitate = $Nationalitate;
		$jucator->inaltime = request('Inaltime');
		$jucator->picior_preferat = request('Picior_preferat');
		$jucator->post = request('Post');

		$jucator->save();

		return redirect('jucator');
	}
	public function stergere( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		Jucator::findOrFail($id)->delete();

		return redirect('jucator');
	}
	public function modificare( $id)
	{
		abort_if( auth()->id() !==1 ,403);
		$jucator = Jucator::findOrFail($id);

		return view('Jucatori/jucator_modificare', compact('jucator'));
	}
	public function filtrare()
	{
		$jucatori = DB::table('jucators');
		$nume = request('Nume');
		$echipa = request('echipa');
		$tara = request('Nationalitate');
		if( !empty( $nume ) )
		{
			$jucatori->whereRaw('LOWER(`nume`) LIKE ? ',['%'.strtolower($nume).'%']);
		}
		if( !empty( $echipa ) )
		{
			$echipa_id = Echipa::where('nume','=',$echipa)->value('id');
			$jucatori->where('echipa_id',$echipa_id);	
		}
		if( !empty( $tara ) )
		{
			$nationalitate = Tara::where('nume','=',$tara)->value('prescurtare');
			$jucatori->where('nationalitate',$nationalitate);
		}
		$jucatori = $jucatori->paginate(10);
    	return view('Jucatori/jucator_index',compact('jucatori'));
	}
	public function piton()
	{

		$process = new Process(['python', 'test.py']);
		$process->run();

		if (!$process->isSuccessful()) 
		{
		    throw new ProcessFailedException($process);
		}

		echo $process->getOutput();
	}
}
