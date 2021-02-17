@extends('layouts.app-navbar')

@section('content')

@if( auth()->check() )
	@if( auth()->id() !== 1 )
    @php
        $echipa_id = App\Echipa::where('user_id','=',auth()->id() )->value('id');
        $competitii = App\EchipaCompetitie::where('echipa_id', '=', $echipa_id)->get('competitie_id');
        $contor=0;
        $ultimul_meci = App\Meci::where('echipa_gazda_id','=',$echipa_id)->orWhere('echipa_oaspete_id','=',$echipa_id);
        $ultimul_meci = App\Meci::where('data','<', date('Y-m-d H:i:s'))->orderBy('data','desc')->take(1)->get();
        $urmatorul_meci = App\Meci::where('echipa_gazda_id','=',$echipa_id)->orWhere('echipa_oaspete_id','=',$echipa_id);
        $urmatorul_meci = App\Meci::where('data','>', date('Y-m-d H:i:s'))->orderBy('data','asc')->take(1)->get();
    @endphp
    <div class="container echipa-mea-container">
        <div class="row">
            <div id="program" class="col-6">
                <div class="col-12 meciul-urmator">
                    <p style="font-size:20px; font-weight: bold">Meciul urmator - {{$urmatorul_meci[0]->data}}</p>
                    <p style="font-size:20px; color:#FFF">{{$urmatorul_meci[0]->echipa_gazda->nume}} - {{$urmatorul_meci[0]->echipa_oaspete->nume}}</p>
                    <p style="padding:5.5em 0em 2em 0em;"><a href ="/register">Vezi meciurile urmatoare</a></p>
                </div>
            </div>
            <div id="rezultat" class="col-6">
                <div class="col-12 ultimul-rezultat">
                    <p style="font-size:20px; font-weight: bold">Ultimul meci - {{$ultimul_meci[0]->data}} </p>
                    <p style="font-size:20px; color:#FFF">{{$ultimul_meci[0]->echipa_gazda->nume}} - {{$ultimul_meci[0]->echipa_oaspete->nume}}</p>
                    <div class="d-inline-flex">
                        <div class="clasament-circle-white mr-4">{{$ultimul_meci[0]->goluri_gazde}}</div>
                        <div class="clasament-circle-white ml-4">{{$ultimul_meci[0]->goluri_oaspeti}}</div>
                    </div>
                    <p style="padding:3em 0em 2em 0em;"><a href ="/register">Vezi meciurile jucate</a></p>
                </div>
            </div>
        </div>
        <div id="clasament" class="col-12 clasament mt-4">
<div id="carouselExampleIndicators" class="carousel slide" data-interval="false">
  <ol class="carousel-indicators">
    @foreach($competitii as $competitie)
    @if($contor == 0)
    <li data-target="#carouselExampleIndicators" data-slide-to="{{$contor++}}" class="active"></li>
    @else
    <li data-target="#carouselExampleIndicators" data-slide-to="{{$contor++}}"></li>
    @endif
    @endforeach
    @php
    $contor=0;
    @endphp
  </ol>
    <div class="carousel-inner">
  @foreach($competitii as $competitie)
    @php
        $nume_competitie = App\Competitie::where('id','=',$competitie->competitie_id)->value('nume');
        $max_loc = App\EchipaCompetitie::where('competitie_id','=',$competitie->competitie_id)->max('loc');
        $echipa= App\EchipaCompetitie::where('echipa_id','=',$echipa_id)->where('competitie_id','=',$competitie->competitie_id)->first();
        if( $echipa->loc == 1 || $echipa->loc == 2 || $echipa->loc == 3 )
        {
            $echipe_competitii = App\EchipaCompetitie::where('competitie_id','=',$competitie->competitie_id)->orderBy('puncte','desc')->take(5)->get();
        }
        elseif( $echipa->loc == $max_loc || $echipa->loc == $max_loc - 1 || $echipa->loc == $max_loc - 2 )
        {
            $echipe_competitii = App\EchipaCompetitie::where('competitie_id','=',$competitie->competitie_id)->orderBy('puncte','desc')->skip( $max_loc - 5 )->take(5)->get();
        }
        else
        {
            $echipe_competitii = App\EchipaCompetitie::where('competitie_id','=',$competitie->competitie_id)->orderBy('puncte','desc')->skip( $echipa->loc - 2 )->take(5)->get();
        }

    @endphp
    @if($contor == 0)
        <div class="carousel-item active">
            <div>
                <h3 style="color: #FFF; font-weight: bold; margin-bottom: 25px;">{{$nume_competitie}}</h3>
                <table class="table-carousel">
                    <thead>
                    </thead>
                    <tbody>
                        @foreach($echipe_competitii as $entitate)
                        <tr>
                            @if( $entitate->echipa_id == $echipa_id )
                            <td style="width: 5%">
                                <div class="clasament-circle-white mb-2 mr-4 font-weight-normal">{{$entitate->loc}}</div>
                            </td>
                            <td style="color: #FFF; width: 90%; text-align: left">
                                {{$entitate->echipa->nume}}
                            </td>
                            <td style="color: #FFF; width: 5%">
                                {{$entitate->puncte}}
                            </td>
                            @else
                            <td style="width: 5%">
                                <div class="clasament-circle-black mb-2 mr-4 font-weight-normal">{{$entitate->loc}}</div>
                            </td>

                            <td style="width: 90%; text-align: left">
                                {{$entitate->echipa->nume}}
                            </td>
                            <td style="width: 5%">
                                {{$entitate->puncte}}
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p style="padding:4em 0em 2em 0em;"><a href ="/competitie/clasament/{{$competitie->competitie_id}}">Vezi clasamentul</a></p>
            </div>
        </div>
        @else
        <div class="carousel-item">
            <div>
                <h3 style="color: #FFF; font-weight: bold; margin-bottom: 25px;">{{$nume_competitie}}</h3>
                <table class="table-carousel">
                    <thead>
                    </thead>
                    <tbody>
                        @foreach($echipe_competitii as $entitate)
                        <tr>
                            @if( $entitate->echipa_id == $echipa_id )
                            <td style="width: 5%">
                                <div class="clasament-circle-white mb-2 mr-4 font-weight-normal">{{$entitate->loc}}</div>
                            </td>
                            <td style="color: #FFF; width: 90%; text-align: left">
                                {{$entitate->echipa->nume}}
                            </td>
                            <td style="color: #FFF; width: 5%">
                                {{$entitate->puncte}}
                            </td>
                            @else
                            <td style="width: 5%">
                                <div class="clasament-circle-black mb-2 mr-4 font-weight-normal">{{$entitate->loc}}</div>
                            </td>

                            <td style="width: 90%; text-align: left">
                                {{$entitate->echipa->nume}}
                            </td>
                            <td style="width: 5%">
                                {{$entitate->puncte}}
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p style="padding:4em 0em 2em 0em;"><a href ="/competitie/clasament/{{$competitie->competitie_id}}">Vezi clasamentul</a></p>
            </div>
        </div>
    @endif
    @php
        $contor++;
    @endphp
@endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    </div>
    @php
        $jucatori = App\Jucator::where('echipa_id','=',$echipa_id)->orderBy('goluri','desc')->take(5)->get();
    @endphp
        <div id="statut" class="col-12 statut mt-5">
            <table class="table-carousel" style="color: #FFF">
                <thead>
                    <tr>
                        <th>Nume</th>
                        <th>Goluri</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jucatori as $jucator)
                    <tr>
                        <td style="width: 90%; text-align: left">{{$jucator->nume}}</td>
                        <td style="width: 5%">{{$jucator->goluri}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p style="padding:3em 0em 1em 0em;"><a style="color: #FFF" href ="/jucator/propriu">Vezi statutul lotului</a></p>
        </div>
    </div>

	@else

	<table class="table">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Email</th>
                <th>Echipa</th>
            </tr>
        </thead>
        <tbody class="text-center">
        	@php
        		$utilizatori = App\User::all();
				foreach ( $utilizatori as $utilizator )
				{
        	@endphp
                <tr>
                    <td>
    	        	{{ $utilizator->name }}
                    </td>
                    <td>
					{{ $utilizator->email }}
                    </td>
					@php
						$echipa = App\Echipa::where('user_id','=',$utilizator->id)->value('nume');
					@endphp
                    <td>
                    	{{ $echipa }}
                	</td>
                </tr>
            @php
        	}
        	@endphp
        </tbody>
    </table>
    @endif
@else
	<h1>Se pare ca nu ai cont la noi. Daca doresti sa iti gestionezi propria echipa de fotbal, atunci inregistreaza-te chiar acum</h1>
	<a class="btn btn-primary" href ="/register">Inregistrare</a>
@endif

@endsection