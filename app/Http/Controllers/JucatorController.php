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
		$jucatori = DB::table('jucators');
		$nume = request('Nume');
		$echipa = request('echipa');
		$tara = request('Nationalitate');

		//index
		if( empty($nume) && empty($echipa) && empty($tara) )
		{
			$jucatori = Jucator::sortable()->paginate(10);
			return view('Jucatori/jucator_index',compact('jucatori'));
		}

		//filtrare
		if( !empty( $nume ) )
		{
			$jucatori->whereRaw('LOWER(`nume`) LIKE ? ',['%'.strtolower($nume).'%']);
		}
		if( !empty( $echipa ) )
		{
			if( $echipa == "-" )
			{
				$jucatori->where('echipa_id',null);	
			}
			else
			{
				$echipa_id = Echipa::where('nume','=',$echipa)->value('id');
				$jucatori->where('echipa_id',$echipa_id);	
			}
		}
		if( !empty( $tara ) )
		{
			$nationalitate = Tara::where('nume','=',$tara)->value('prescurtare');
			$jucatori->where('nationalitate',$nationalitate);
		}
		$jucatori = $jucatori->paginate(10);
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
		foreach($jucatori as $jucator){
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
		if( request('Post') == "portar")
		{
			$jucator->parade = request('parade');
			$jucator->iesiri_din_poarta = request('iesiri_din_poarta');
			$jucator->boxari = request('boxari');
			$jucator->plonjari = request('plonjari');
			$jucator->goluri_primite = request('goluri_primite');
		}
		else
		{
			$jucator->pase = request('pase');
			$jucator->pase_cheie = request('pase_cheie');
			$jucator->precizie_pase = request('precizie_pase');
			$jucator->sanse_create = request('sanse_create');
			$jucator->goluri_primite = request('goluri_primite');
			$jucator->suturi = request('suturi');
			$jucator->suturi_blocate = request('suturi_blocate');
			$jucator->precizie_suturi = request('precizie_suturi');
			$jucator->centrari = request('centrari');
			$jucator->dueluri_aeriene_castigate = request('dueluri_aeriene_castigate');
			$jucator->dueluri_aeriene_pierdute = request('dueluri_aeriene_pierdute');
			$jucator->degajari = request('degajari');
			$jucator->mingi_profunzime = request('mingi_profunzime');
			$jucator->deposedat = request('deposedat');
			$jucator->driblinguri_incercate = request('driblinguri_incercate');
			$jucator->driblinguri_reusite = request('driblinguri_reusite');
			$jucator->dueluri_pierdute = request('dueluri_pierdute');
			$jucator->dueluri_castigate = request('dueluri_castigate');
			$jucator->faulturi = request('faulturi');
			$jucator->interceptii = request('interceptii');
			$jucator->recuperari = request('recuperari');
			$jucator->faultat = request('faultat');
			$jucator->deposedari_incercate = request('deposedari_incercate');
			$jucator->deposedari_reusite = request('deposedari_reusite');
		}

		$jucator->save();
		$this->evaluare($id);

		return redirect('jucator');
	}

	public function stergere( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		Jucator::findOrFail($id)->delete();

		return redirect('jucator');
	}

	public function modificare( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		$jucator = Jucator::findOrFail($id);

		return view('Jucatori/jucator_modificare', compact('jucator'));
	}

	public function evaluare( $id )
	{
		$jucator = Jucator::findOrFail($id);
		$process = new Process(['python', 'evaluare.py', $jucator->post, $jucator->iesiri_din_poarta, $jucator->plonjari, $jucator->goluri_primite, $jucator->minute_jucate, $jucator->boxari, $jucator->parade, $jucator->pase_gol, $jucator->sanse_create, $jucator->goluri, $jucator->precizie_pase, $jucator->suturi, $jucator->suturi_blocate, $jucator->precizie_suturi, $jucator->centrari, $jucator->pase_cheie, $jucator->mingi_profunzime, $jucator->pase, $jucator->dueluri_aeriene_pierdute, $jucator->dueluri_aeriene_castigate, $jucator->degajari, $jucator->deposedat, $jucator->driblinguri_incercate, $jucator->driblinguri_reusite, $jucator->dueluri_pierdute, $jucator->dueluri_castigate, $jucator->faulturi, $jucator->interceptii, $jucator->recuperari, $jucator->deposedari_incercate, $jucator->deposedari_reusite, $jucator->faultat, $jucator->cartonase_galbene, $jucator->cartonase_rosii]);
		$process->run();

		if (!$process->isSuccessful()) 
		{
			throw new ProcessFailedException($process);
		}

		echo $process->getOutput();
		$jucator->rating = $process->getOutput();
		$jucator->save(); 
	}

	public function propriu()
	{
		$echipa_id = Echipa::where('user_id','=',auth()->id() )->value('id');
		$jucatori = Jucator::where('echipa_id', '=', $echipa_id)->sortable()->paginate(10);
		if(empty($echipa_id))
		{
			$echipa_id = Nationala::where('user_id','=',auth()->id() )->value('id');
			$jucatori = Jucator::where('nationala_id', '=', $echipa_id)->sortable()->paginate(10);
		}

		return view('Jucatori/jucator_propriu', compact('jucatori'));
	}

	public function actualizare_jucator_dupa_meci($echip1aid, $echipa2id, $assist1, $assist2, $marcator1, $marcator2, $cul_cart1, $cul_cart2, $cartonat1, $cartonat2, $assist1vechi, $assist2vechi, $marcator1vechi, $marcator2vechi, $cartonat1vechi, $cartonat2vechi )
	{
		//actualizat minute si meciuri si la cei ce nu au marcat/cartonat
		$jucatori_prezenti = Jucator::where('echipa_id','=',$echip1aid)->orWhere('echipa_id','=',$echipa2id)->get();
		foreach( $jucatori_prezenti as $jucator )
		{
			$jucator->meciuri_jucate++;
			$jucator->minute_jucate++;
			$jucator->save();
		}

		//assist gazde
		if( $assist1 != null && !empty($assist1[0]) )
		{
			for ( $i=0; $i < count($assist1); $i++ ) 
			{
				$jucator = Jucator::where('nume','=',$assist1[$i])->get();
				$jucator[0]->pase_gol++;
				$jucator[0]->save();
				$this->evaluare($jucator[0]->id);
			}
		}
		// if( count($assist1) < count($assist1vechi) )
		// {
		// 	for ( $i=0; $i < count($assist1); $i++ ) 
		// 	{
		// 		$jucator = Jucator::where('nume','=',$assist1vechi[$i + count($assist1)])->get();
		// 		$jucator[0]->pase_gol--;
		// 		$jucator[0]->save();
		// 	}
		// }

		//assist oaspeti
		if( $assist2 != null && !empty($assist2[0]) )
		{
			for ( $i=0; $i < count($assist2); $i++ ) 
			{
				$jucator = Jucator::where('nume','=',$assist2[$i])->get();
				$jucator[0]->pase_gol++;
				$jucator[0]->save();
				$this->evaluare($jucator[0]->id);
			}
		}
		// if( count($assist2) < count($assist2vechi) )
		// {
		// 	for ( $i=0; $i < count($assist2); $i++ ) 
		// 	{
		// 		$jucator = Jucator::where('nume','=',$assist2vechi[$i + count($assist2)])->get();
		// 		$jucator[0]->pase_gol--;
		// 		$jucator[0]->save();
		// 	}
		// }

		//marcatori gazde
		if( $marcator1 != null && !empty($marcator1[0]) )
		{
			for ( $i=0; $i < count($marcator1); $i++ ) 
			{
				$jucator = Jucator::where('nume','=',$marcator1[$i])->get();
				$jucator[0]->goluri++;
				$jucator[0]->save();
				$this->evaluare($jucator[0]->id);
			}
		}
		// if( count($marcator1) < count($marcator1vechi) )
		// {
		// 	for ( $i=0; $i < count($marcator1); $i++ ) 
		// 	{
		// 		$jucator = Jucator::where('nume','=',$marcator1vechi[$i + count($marcator1)])->get();
		// 		$jucator[0]->goluri--;
		// 		$jucator[0]->save();
		// 	}
		// }

		//marcatori oaspeti
		if( $marcator2 != null && !empty($marcator2[0]) )
		{
			for ( $i=0; $i < count($marcator2); $i++ ) 
			{
				$jucator = Jucator::where('nume','=',$marcator2[$i])->get();
				$jucator[0]->goluri++;
				$jucator[0]->save();
				$this->evaluare($jucator[0]->id);
			}
		}
		// if( count($marcator2) < count($marcator2vechi) )
		// {
		// 	for ( $i=0; $i < count($marcator2); $i++ ) 
		// 	{
		// 		$jucator = Jucator::where('nume','=',$marcator2vechi[$i + count($marcator2)])->get();
		// 		$jucator[0]->goluri--;
		// 		$jucator[0]->save();
		// 	}
		// }

		//cartonas gazde
		if( $cartonat1 != null && !empty($cartonat1[0]) && !empty($cul_cart1[0]) )
		{
			for ( $i=0; $i < count($cartonat1); $i++ ) 
			{
				$jucator = Jucator::where('nume','=',$cartonat1[$i])->get();
				if($cul_cart1[$i]  == 1)
				{
					$jucator[0]->cartonase_galbene++;
				}
				else
				{
					$jucator[0]->cartonase_rosii++;
				}
				$jucator[0]->save();
				$this->evaluare($jucator[0]->id);
			}
		}
		// if( count($cartonat1) < count($cartonat1vechi) )
		// {
		// 	for ( $i=0; $i < count($cartonat1); $i++ ) 
		// 	{
		// 		$jucator = Jucator::where('nume','=',$cartonat1vechi[$i + count($cartonat1)])->get();
		// 		if($cul_cart1[$i + count($cartonat1)]  == 1)
		// 		{
		// 			$jucator[0]->cartonase_galbene--;
		// 		}
		// 		else
		// 		{
		// 			$jucator[0]->cartonase_rosii--;
		// 		}
		// 		$jucator[0]->save();
		// 	}
		// }

		//casrtonas oaspeti
		if( $cartonat2 != null && !empty($cartonat2[0]) && !empty($cul_cart2[0]) )
		{
			for ( $i=0; $i < count($cartonat2); $i++ ) 
			{
				$jucator = Jucator::where('nume','=',$cartonat2[$i])->get();
				if($cul_cart2[$i] == 1)
				{
					$jucator[0]->cartonase_galbene++;
				}
				else
				{
					$jucator[0]->cartonase_rosii++;
				}
				$jucator[0]->save();
				$this->evaluare($jucator[0]->id);
			}
		}
		// if( count($cartonat2) < count($cartonat2vechi) )
		// {
		// 	for ( $i=0; $i < count($cartonat2); $i++ ) 
		// 	{
		// 		$jucator = Jucator::where('nume','=',$cartonat2vechi[$i + count($cartonat2)])->get();
		// 		if($cul_cart1[$i + count($cartonat2)]  == 1)
		// 		{
		// 			$jucator[0]->cartonase_galbene--;
		// 		}
		// 		else
		// 		{
		// 			$jucator[0]->cartonase_rosii--;
		// 		}
		// 		$jucator[0]->save();
		// 	}
		// }
	}
}
