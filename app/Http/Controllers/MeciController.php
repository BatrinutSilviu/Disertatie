<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meci;
use App\Marcator;
use App\Echipa;
use App\Tara;
use App\Competitie;
use App\Jucator;
use App\Cartonase;
use DB;
use Redirect;

class MeciController extends Controller
{
	public function index()
	{
		$meciuri = DB::table('mecis');
		$echipa = request('echipa');
		$data = request('data');
		$toggler = request('toggler');
		if( empty($echipa) && empty($data) )
		{
			$meciuri = \App\Meci::Paginate(10);

			return view('Meciuri/meciuri_index',compact('meciuri'));
		}

		if( !empty( $data ) )
		{
			$meciuri->whereDate('data',$data);
		}
		if( !empty( $echipa ) )
		{
			if( $toggler == "on")
			{
				$echipa_id = Echipa::where('nume','=',$echipa)->value('id');
				$meciuri->where(function ($query) use ($echipa_id){
					$query->where('echipa_gazda_id',$echipa_id);
					$query->orWhere('echipa_oaspete_id',$echipa_id);
				});

			}
			else
			{
				$echipa_id = Tara::where('nume','=',$echipa)->value('id');
				$meciuri->where(function ($query) use ($echipa_id){
					$query->where('nationala_gazda_id',$echipa_id);
					$query->orWhere('nationala_oaspete_id',$echipa_id);
				});
			}
		}

		$meciuri = $meciuri->paginate(10);

		return view('Meciuri/meciuri_index',compact('meciuri'));
	}

	public function adaugare()
	{
		abort_if( auth()->id() !==1 ,403);

		return view('Meciuri/meciuri_adaugare');
	}

	public function salvare()
	{
		abort_if( auth()->id() !== 1 ,403);
		if( request('marcator_oaspete') == null && request('goluri_oaspeti') > 0 )
		{
			return Redirect::back()->withWarning( 'Numarul de marcatori si numarul de goluri nu corespund la oaspeti' );
		}
		if( request('marcator_oaspete') != null )
		{
			if( count( request('marcator_oaspete') ) != request('goluri_oaspeti') )
			{
				return Redirect::back()->withWarning( 'Numarul de marcatori si numarul de goluri nu corespund la oaspeti' );
			}
			$goluri_oaspeti = count(request('marcator_oaspete'));
		}
		if( request('marcator_gazda') == null && request('goluri_gazde') > 0 )
		{
			return Redirect::back()->withWarning( 'Numarul de marcatori si numarul de goluri nu corespund la gazde' );
		}
		if( request('marcator_gazda') != null )
		{
			if( count( request('marcator_gazda') ) != request('goluri_gazde') )
			{
				return Redirect::back()->withWarning( 'Numarul de marcatori si numarul de goluri nu corespund la gazde' );
			}
			$goluri_gazde = count(request('marcator_gazda'));
		}
		if( request('cartonas_gazda') )
		{
			$assist_gazde = count(request('cartonas_gazda'));
		}
		if( request('cartonas_oaspete') )
		{
			$assist_oaspeti = count(request('cartonas_oaspete'));
		}
		$meci = new Meci;
		if(request('toggler') == null)	//nationale
		{
			$validat=request()->validate(['echipa_gazda_id' => ['required','different:echipa_oaspete_id'],
				'data' => ['required','date','before:tomorrow'],
				'echipa_oaspete_id' => ['required','different:echipa_gazda_id'],
				'goluri_gazde' => ['required','numeric','min:0','max:50'],
				'goluri_oaspeti' => ['required','numeric','min:0','max:50'],
				'competitie_id'=> ['required','exists:competities,nume'],
				'teren'=> ['min:5','max:50'],
				'arbitru' => ['min:5','max:50'],
			]);
			$echipa_gazda_id = Tara::where('nume','=',request('echipa_gazda_id'))->value('id');
			$echipa_oaspete_id = Tara::where('nume','=',request('echipa_oaspete_id'))->value('id');
			$meci->nationala_gazda_id = $echipa_gazda_id;
			$meci->nationala_oaspete_id = $echipa_oaspete_id;
		}
		elseif(request('toggler') == "on") 	//cluburi
		{
			$validat=request()->validate(['echipa_gazda_id' => ['required','exists:echipas,nume','different:echipa_oaspete_id'],
				'data' => ['required','date','before:tomorrow'],
				'echipa_oaspete_id' => ['required','exists:echipas,nume','different:echipa_gazda_id'],
				'goluri_gazde' => ['required','numeric','min:0','max:50'],
				'goluri_oaspeti' => ['required','numeric','min:0','max:50'],
				'competitie_id'=> ['required','exists:competities,nume'],
				'teren'=> ['min:5','max:50'],
				'arbitru' => ['min:5','max:50'],
			]);
			$echipa_gazda_id = Echipa::where('nume','=',request('echipa_gazda_id'))->value('id');
			$echipa_oaspete_id = Echipa::where('nume','=',request('echipa_oaspete_id'))->value('id');
			$meci->echipa_gazda_id = $echipa_gazda_id;
			$meci->echipa_oaspete_id = $echipa_oaspete_id;
		}
		
		$goluri_gazde=0;
		$goluri_oaspeti=0;
		$assist_gazde=0;
		$assist_oaspeti=0;

		$competitie_id = Competitie::where('nume','=',request('competitie_id'))->value('id');
		$meci->data = request('data');
		$meci->goluri_gazde = request('goluri_gazde');
		$meci->goluri_oaspeti = request('goluri_oaspeti');
		$meci->competitie_id = $competitie_id;
		$meci->teren = request('teren');
		$meci->arbitru = request('arbitru');
		$meci->save();

		for ( $i=0; $i < $goluri_gazde; $i++ ) 
		{ 
			$marcator = new Marcator();
			$marcator->jucator_id = Jucator::where('nume','=',request('marcator_gazda')[$i])->value('id');
			$marcator->assist_id = Jucator::where('nume','=',request('assist_gazda')[$i])->value('id');
			$marcator->minut = request('minut_gazda')[$i];
			$marcator->penalty = request('penalty_gazda')[$i];
			$marcator->picior = request('picior_gazda')[$i];
			$meci->marcatori()->save($marcator);
		}

		for ( $i=0; $i < $goluri_oaspeti; $i++ ) 
		{ 
			$marcator = new Marcator();
			$marcator->jucator_id = Jucator::where('nume','=',request('marcator_oaspete')[$i])->value('id');
			$marcator->assist_id = Jucator::where('nume','=',request('assist_oaspete')[$i])->value('id');
			$marcator->minut = request('minut_oaspete')[$i];
			$marcator->penalty = request('penalty_oaspete')[$i];
			$marcator->picior = request('picior_oaspete')[$i];
			$meci->marcatori()->save($marcator);
		}

		for ( $i=0; $i < $assist_gazde; $i++ ) 
		{ 
			$cartonas = new Cartonase();
			$cartonas->jucator_id = Jucator::where('nume','=',request('cartonas_gazda')[$i])->value('id');
			$cartonas->minut = request('cart_minut_gazde')[$i];
			$cartonas->culoare =  request('culoare_gazde')[$i];
			$meci->cartonase()->save($cartonas);
		}

		for ( $i=0; $i < $assist_oaspeti; $i++ ) 
		{ 
			$cartonas = new Cartonase();
			$cartonas->jucator_id = Jucator::where('nume','=',request('cartonas_oaspete')[$i])->value('id');
			$cartonas->minut = request('cart_minut_oaspete')[$i];
			$cartonas->culoare = request('culoare_oaspete')[$i];
			$meci->cartonase()->save($cartonas);
		}

		$this->actualizare_tabele( $competitie_id, $echipa_gazda_id, $echipa_oaspete_id, $meci->goluri_gazde, $meci->goluri_oaspeti, request('assist_gazda'), request('assist_oaspete'), request('marcator_gazda'), request('marcator_oaspete'), request('culoare_gazda'), request('culoare_oaspete'), request('cartonas_gazda'), request('cartonas_oaspete'), request('toggler'), null, null, null, null, null, null, null, null, null, null,);
		return redirect('/meci');
	}

	public function actualizare( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		$meci = Meci::findOrFail($id);

		if(request('toggler') == null)	//nationale
		{
			$validat=request()->validate(['echipa_gazda_id' => ['required','different:echipa_oaspete_id'],
				'data' => ['required','date','before:tomorrow'],
				'echipa_oaspete_id' => ['required','different:echipa_gazda_id'],
				'goluri_gazde' => ['required','numeric','min:0','max:50'],
				'goluri_oaspeti' => ['required','numeric','min:0','max:50'],
				'competitie_id'=> ['required','exists:competities,nume'],
				'teren'=> ['min:5','max:50'],
				'arbitru' => ['min:5','max:50'],
			]);
			$echipa_gazda_id = Tara::where('nume','=',request('echipa_gazda_id'))->value('id');
			$echipa_oaspete_id = Tara::where('nume','=',request('echipa_oaspete_id'))->value('id');
			$meci->nationala_gazda_id = $echipa_gazda_id;
			$meci->nationala_oaspete_id = $echipa_oaspete_id;
		}
		elseif(request('toggler') == "on") 	//cluburi
		{
			$validat=request()->validate(['echipa_gazda_id' => ['required','exists:echipas,nume','different:echipa_oaspete_id'],
				'data' => ['required','date','before:tomorrow'],
				'echipa_oaspete_id' => ['required','exists:echipas,nume','different:echipa_gazda_id'],
				'goluri_gazde' => ['required','numeric','min:0','max:50'],
				'goluri_oaspeti' => ['required','numeric','min:0','max:50'],
				'competitie_id'=> ['required','exists:competities,nume'],
				'teren'=> ['min:5','max:50'],
				'arbitru' => ['min:5','max:50'],
			]);
			$echipa_gazda_id = Echipa::where('nume','=',request('echipa_gazda_id'))->value('id');
			$echipa_oaspete_id = Echipa::where('nume','=',request('echipa_oaspete_id'))->value('id');
			$meci->echipa_gazda_id = $echipa_gazda_id;
			$meci->echipa_oaspete_id = $echipa_oaspete_id;
		}

		$competitie_id = Competitie::where('nume','=',request('competitie_id'))->value('id');
		$meci->echipa_gazda_id = $echipa_gazda_id;
		$meci->echipa_oaspete_id = $echipa_oaspete_id;
		$meci->data = request('data');
		$meci->goluri_gazde = request('goluri_gazde');
		$meci->goluri_oaspeti = request('goluri_oaspeti');
		$meci->competitie_id = $competitie_id;
		$meci->teren = request('teren');
		$meci->arbitru = request('arbitru');
		$meci->save();

		//Goluri gazde
		$marcatori_gazda = Marcator::where('meci_id','=',$meci->id)->whereIn('jucator_id',$meci->echipa_gazda->jucatori->pluck('id'))->get();
		$goluri_gazde_request = request('goluri_gazde');
		$min = min($goluri_gazde_request,count($marcatori_gazda));
		for ( $i=0; $i < $min; $i++ ) 
		{ 
			$marcatori_gazda[$i]->jucator_id = Jucator::where('nume','=',request('marcator_gazda')[$i])->value('id');
			$marcatori_gazda[$i]->assist_id = Jucator::where('nume','=',request('assist_gazda')[$i])->value('id');
			$marcatori_gazda[$i]->minut = request('minut_gazda')[$i];
			$marcatori_gazda[$i]->penalty = request('penalty_gazda')[$i];
			$marcatori_gazda[$i]->picior = request('picior_gazda')[$i];
			$meci->marcatori()->save($marcatori_gazda[$i]);
		}
		$diff = $goluri_gazde_request - count($marcatori_gazda);
		for ( $i=0; $i < $diff; $i++ ) 
		{ 
			$marcator = new Marcator();
			$marcator->jucator_id = Jucator::where('nume','=',request('marcator_gazda')[$i + count($marcatori_gazda)])->value('id');
			$marcator->assist_id = Jucator::where('nume','=',request('assist_gazda')[$i + count($marcatori_gazda)])->value('id');
			$marcator->minut = request('minut_gazda')[$i + count($marcatori_gazda)];
			$marcator->penalty = request('penalty_gazda')[$i + count($marcatori_gazda)];
			$marcator->picior = request('picior_gazda')[$i + count($marcatori_gazda)];
			$meci->marcatori()->save($marcator);
		}
		for ( $i=0; $i < count($marcatori_gazda) - $goluri_gazde_request; $i++ ) 
		{ 
			$marcatori_gazda[$i + $goluri_gazde_request]->delete();
		}

		//Goluri oaspeti
		$marcatori_oaspeti= Marcator::where('meci_id','=',$meci->id)->whereIn('jucator_id',$meci->echipa_oaspete->jucatori->pluck('id'))->get();
		$goluri_oaspeti_request = request('goluri_oaspeti');
		$min = min($goluri_oaspeti_request,count($marcatori_oaspeti));
		for ( $i=0; $i < $min; $i++ ) 
		{ 
			$marcatori_oaspeti[$i]->jucator_id = Jucator::where('nume','=',request('marcator_oaspete')[$i])->value('id');
			$marcatori_oaspeti[$i]->assist_id = Jucator::where('nume','=',request('assist_oaspete')[$i])->value('id');
			$marcatori_oaspeti[$i]->minut = request('minut_oaspete')[$i];
			$marcatori_oaspeti[$i]->penalty = request('penalty_oaspete')[$i];
			$marcatori_oaspeti[$i]->picior = request('picior_oaspete')[$i];
			$meci->marcatori()->save($marcatori_oaspeti[$i]);
		}
		$diff = $goluri_oaspeti_request - count($marcatori_oaspeti);
		for ( $i=0; $i < $diff; $i++ ) 
		{ 
			$marcator = new Marcator();
			$marcator->jucator_id = Jucator::where('nume','=',request('marcator_oaspete')[$i + count($marcatori_gazda)])->value('id');
			$marcator->assist_id = Jucator::where('nume','=',request('assist_oaspete')[$i + count($marcatori_gazda)])->value('id');
			$marcator->minut = request('minut_oaspete')[$i + count($marcatori_gazda)];
			$marcator->penalty = request('penalty_oaspete')[$i + count($marcatori_gazda)];
			$marcator->picior = request('picior_oaspete')[$i + count($marcatori_gazda)];
			$meci->marcatori()->save($marcator);
		}
		for ( $i=0; $i < count($marcatori_oaspeti) - $goluri_oaspeti_request; $i++ ) 
		{ 
			$marcatori_oaspeti[$i + $goluri_oaspeti_request]->delete();
		}

		//Cartonase gazde
		$cart_gazde = Cartonase::where('meci_id','=',$meci->id)->whereIn('jucator_id',$meci->echipa_gazda->jucatori->pluck('id'))->get();
		$cart_gazde_request = request('cartonase_gazde');
		$min = min($cart_gazde_request,count($cart_gazde));
		for ( $i=0; $i < $min; $i++ ) 
		{ 
			$cart_gazde[$i]->jucator_id = Jucator::where('nume','=',request('cartonas_gazda')[$i])->value('id');
			$cart_gazde[$i]->minut = request('cart_minut_gazde')[$i];
			$cart_gazde[$i]->culoare =  request('culoare_gazde')[$i];
			$meci->cartonase()->save($cart_gazde[$i]);
		}
		$diff = $cart_gazde_request - count($cart_gazde);
		for ( $i=0; $i < $diff; $i++ ) 
		{ 
			$cartonas = new Cartonase();
			$cartonas->jucator_id = Jucator::where('nume','=',request('cartonas_gazda')[$i + count($cart_gazde)])->value('id');
			$cartonas->minut = request('cart_minut_gazde')[$i + count($cart_gazde)];
			$cartonas->culoare =  request('culoare_gazde')[$i + count($cart_gazde)];
			$meci->cartonase()->save($cartonas);
		}
		for ( $i=0; $i < count($cart_gazde) - $cart_gazde_request; $i++ ) 
		{ 
			$cart_gazde[$i + $cart_gazde_request]->delete();
		}

		//Cartonase oaspeti
		$cart_oaspeti = Cartonase::where('meci_id','=',$meci->id)->whereIn('jucator_id',$meci->echipa_oaspete->jucatori->pluck('id'))->get();
		$cart_oaspeti_request = request('cartonase_oaspeti');
		$min = min($cart_oaspeti_request,count($cart_oaspeti));
		for ( $i=0; $i < $min; $i++ ) 
		{ 
			$cart_oaspeti[$i]->jucator_id = Jucator::where('nume','=',request('cartonas_oaspete')[$i])->value('id');
			$cart_oaspeti[$i]->minut = request('cart_minut_oaspete')[$i];
			$cart_oaspeti[$i]->culoare = request('culoare_oaspete')[$i];
			$meci->cartonase()->save($cart_oaspeti[$i]);
		}
		$diff = $cart_oaspeti_request - count($cart_oaspeti);
		for ( $i=0; $i < $diff; $i++ ) 
		{ 
			$cartonas = new Cartonase();
			$cartonas->jucator_id = Jucator::where('nume','=',request('cartonas_oaspete')[$i + count($cart_oaspeti)])->value('id');
			$cartonas->minut = request('cart_minut_oaspete')[$i + count($cart_oaspeti)];
			$cartonas->culoare = request('culoare_oaspete')[$i + count($cart_oaspeti)];
			$meci->cartonase()->save($cartonas);
		}
		for ( $i=0; $i < count($cart_oaspeti) - $cart_oaspeti_request; $i++ ) 
		{ 
			$cart_oaspeti[$i + $cart_oaspeti_request]->delete();
		}

		$this->actualizare_tabele( $competitie_id, $echipa_gazda_id, $echipa_oaspete_id, $meci->goluri_gazde, $meci->goluri_oaspeti, request('assist_gazda'), request('assist_oaspete'), request('marcator_gazda'), request('marcator_oaspete'), request('culoare_gazda'), request('culoare_oaspete'), request('cartonas_gazda'), request('cartonas_oaspete'), request('toggler'), count($marcatori_gazda) , count($marcatori_oaspeti), null, null, null, null, null, null, null, null);

		return redirect('meci');
	}

	public function stergere( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		$marcatori = Marcator::where('meci_id','=',$id);
		$cartonase = Cartonase::where('meci_id','=',$id);
		$marcatori->delete();
		$cartonase->delete();
		Meci::findOrFail($id)->delete();

		return redirect('meci');
	}

	public function modificare( $id )
	{
		abort_if( auth()->id() !==1 ,403);
		$meci = Meci::findOrFail($id);

		return view('Meciuri/meciuri_modificare', compact('meci'));
	}

	public function actualizare_tabele( $competitie_id, $echipa1, $echipa2, $goluri1, $goluri2, $assist1, $assist2, $marcator1, $marcator2, $cul_cart1, $cul_cart2, $cartonat1, $cartonat2, $nat_sau_ech, $goluri1vechi, $goluri2vechi, $assist1vechi, $assist2vechi, $marcator1vechi, $marcator2vechi, $cartonat1vechi, $cartonat2vechi )
	{
		app('App\Http\Controllers\CompetitieController')->actualizare_clasament_dupa_meci($competitie_id, $echipa1, $echipa2, $goluri1, $goluri2, $nat_sau_ech, $goluri1vechi, $goluri2vechi);
		app('App\Http\Controllers\JucatorController')->actualizare_jucator_dupa_meci($echipa1, $echipa2, $assist1, $assist2, $marcator1, $marcator2, $cul_cart1, $cul_cart2, $cartonat1, $cartonat2, $assist1vechi, $assist2vechi, $marcator1vechi, $marcator2vechi, $cartonat1vechi, $cartonat2vechi );

	}
}
