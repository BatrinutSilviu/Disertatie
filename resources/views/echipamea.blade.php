@extends('layouts.app-navbar')

@section('content')

@if( auth()->check() )
@if( auth()->id() !== 1 )
@php
$echipa_id = App\Echipa::where('user_id','=',auth()->id() )->value('id');
$ech_nat = false;
if(empty($echipa_id))
{
    $echipa_id = App\Nationala::where('user_id','=',auth()->id() )->value('id');
    $ech_nat = true;
}

if(!$ech_nat)
{
    $competitii = App\EchipaCompetitie::where('echipa_id', '=', $echipa_id)->get('competitie_id');

    $urmatorul_meci = App\Meci::where('data','>', date('Y-m-d H:i:s'));
    $urmatorul_meci->where(function ($query) use ($echipa_id){
    $query->where('echipa_gazda_id','=',$echipa_id);
    $query->orWhere('echipa_oaspete_id','=',$echipa_id);
    });
    $urmatorul_meci = $urmatorul_meci->orderBy('data','asc')->take(1)->get();

    $ultimul_meci = App\Meci::where('data','<', date('Y-m-d H:i:s'));
    $ultimul_meci->where(function ($query) use ($echipa_id){
    $query->where('echipa_gazda_id','=',$echipa_id);
    $query->orWhere('echipa_oaspete_id','=',$echipa_id);
    });

    $ultimul_meci = $ultimul_meci->orderBy('data','desc')->take(1)->get();
}
else
{
    $competitii = App\EchipaCompetitie::where('nationala_id', '=', $echipa_id)->get('competitie_id');

    $urmatorul_meci = App\Meci::where('data','>', date('Y-m-d H:i:s'));
    $urmatorul_meci->where(function ($query) use ($echipa_id){
    $query->where('nationala_gazda_id','=',$echipa_id);
    $query->orWhere('nationala_oaspete_id','=',$echipa_id);
    });
    $urmatorul_meci = $urmatorul_meci->orderBy('data','asc')->take(1)->get();

    $ultimul_meci = App\Meci::where('data','<', date('Y-m-d H:i:s'));
    $ultimul_meci->where(function ($query) use ($echipa_id){
    $query->where('nationala_gazda_id','=',$echipa_id);
    $query->orWhere('nationala_oaspete_id','=',$echipa_id);
    });

    $ultimul_meci = $ultimul_meci->orderBy('data','desc')->take(1)->get();
}

$contor=0;

@endphp
<div class="container echipa-mea-container">
    <div class="row">
        <div id="program" class="col-6">
            <div class="col-12 meciul-urmator">
                @php
                $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $urmatorul_meci[0]->data);
                $data_urmator_meci = $myDateTime->format('Y-m-d H:i');      
                $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $ultimul_meci[0]->data);
                $data_ultimul_meci = $myDateTime->format('Y-m-d H:i');

                $viitor = date('Y-m-d H:i:s', strtotime("+2 Months") );
                $trecut = date('Y-m-d H:i:s', strtotime("-2 Months") );

            if(!$ech_nat)
            {
                $meciuriviitoare = App\Meci::where('data','>', date('Y-m-d H:i:s'))->where('data','<',$viitor);
                $meciuriviitoare->where(function ($query) use ($echipa_id){
                $query->where('echipa_gazda_id','=',$echipa_id);
                $query->orWhere('echipa_oaspete_id','=',$echipa_id);
                });

                $meciuritrecute = App\Meci::where('data','<', date('Y-m-d H:i:s'))->where('data','>',$trecut);
                $meciuritrecute->where(function ($query) use ($echipa_id){
                $query->where('echipa_gazda_id','=',$echipa_id);
                $query->orWhere('echipa_oaspete_id','=',$echipa_id);
                });
            }
            else
            {
                $meciuriviitoare = App\Meci::where('data','>', date('Y-m-d H:i:s'))->where('data','<',$viitor);
                $meciuriviitoare->where(function ($query) use ($echipa_id){
                $query->where('nationala_gazda_id','=',$echipa_id);
                $query->orWhere('nationala_oaspete_id','=',$echipa_id);
                });

                $meciuritrecute = App\Meci::where('data','<', date('Y-m-d H:i:s'))->where('data','>',$trecut);
                $meciuritrecute->where(function ($query) use ($echipa_id){
                $query->where('nationala_gazda_id','=',$echipa_id);
                $query->orWhere('nationala_oaspete_id','=',$echipa_id);
                });
            }
        $unde1=[];
        $adversar1=[];
        $unde2=[];
        $adversar2=[];
        $data1=[];
        $data2=[];
        $goluri_gazde=[];
        $goluri_oaspeti=[];
        foreach( $meciuriviitoare->get() as $meci)
        {
            array_push($data1,$meci->data);
            if(!$ech_nat)
            {
                if( $meci->echipa_oaspete_id ==  $echipa_id )
                {
                    array_push($adversar1, $meci->echipa_gazda->nume);
                    array_push($unde1,"D");

                }
                else
                {
                    array_push($adversar1, $meci->echipa_oaspete->nume);
                    array_push($unde1,"A");
                }
            }
            else
            {
                if( $meci->nationala_oaspete_id ==  $echipa_id )
                {
                    array_push($adversar1, $meci->nationala_gazda->tara->nume);
                    array_push($unde1,"D");

                }
                else
                {
                    array_push($adversar1, $meci->nationala_oaspete->tara->nume);
                    array_push($unde1,"A");
                }
            }
        }

        foreach( $meciuritrecute->get() as $meci)
        {
            array_push($data2,$meci->data);
            array_push($goluri_gazde, $meci->goluri_gazde);
            array_push($goluri_oaspeti, $meci->goluri_oaspeti);
            if(!$ech_nat)
            {
                if( $meci->echipa_oaspete_id ==  $echipa_id )
                {
                    array_push($adversar2, $meci->echipa_gazda->nume);
                    array_push($unde2,"D");

                }
                else
                {
                    array_push($adversar2, $meci->echipa_oaspete->nume);
                    array_push($unde2,"A");
                }
            }
            else
            {
                if( $meci->nationala_oaspete_id ==  $echipa_id )
                {
                    array_push($adversar2, $meci->nationala_gazda->tara->nume);
                    array_push($unde2,"D");

                }
                else
                {
                    array_push($adversar2, $meci->nationala_oaspete->tara->nume);
                    array_push($unde2,"A");
                }
            }
        }
        @endphp
            <p style="font-size:20px; font-weight: bold">Meciul urmator - {{$data_urmator_meci}}</p>
            @if(!$ech_nat)
                <p style="font-size:20px; color:#FFF"><img width="20px" class="img-circle" src="/images/{{$urmatorul_meci[0]->echipa_gazda->tara->prescurtare}}.png"> {{$urmatorul_meci[0]->echipa_gazda->nume}} - {{$urmatorul_meci[0]->echipa_oaspete->nume}} <img width="20px" class="img-circle" src="/images/{{$urmatorul_meci[0]->echipa_oaspete->tara->prescurtare}}.png"></p>
            @else
                <p style="font-size:20px; color:#FFF"><img width="20px" class="img-circle" src="/images/{{$urmatorul_meci[0]->nationala_gazda->tara->prescurtare}}.png"> {{$urmatorul_meci[0]->nationala_gazda->tara->nume}} - {{$urmatorul_meci[0]->nationala_oaspete->tara->nume}} <img width="20px" class="img-circle" src="/images/{{$urmatorul_meci[0]->nationala_oaspete->tara->prescurtare}}.png"></p>
            @endif
                <p style="padding:5.5em 0em 2em 0em;" data-toggle="modal" data-data="{{json_encode($data1)}}" data-adversar="{{json_encode($adversar1)}}" data-unde="{{json_encode($unde1)}}" data-target="#exampleModalCenter" class="openDialog">
                    <a style="cursor: pointer">Vezi meciurile urmatoare</a>
                </p>
            </div>
        </div>
        <div id="rezultat" class="col-6">
            <div class="col-12 ultimul-rezultat">
                <p style="font-size:20px; font-weight: bold">Ultimul meci - {{$data_ultimul_meci}} </p>
                @if(!$ech_nat)
                    <p style="font-size:20px; color:#FFF"><img width="20px" class="img-circle" src="/images/{{$ultimul_meci[0]->echipa_gazda->tara->prescurtare}}.png"> {{$ultimul_meci[0]->echipa_gazda->nume}} - {{$ultimul_meci[0]->echipa_oaspete->nume}} <img width="20px" class="img-circle" src="/images/{{$ultimul_meci[0]->echipa_oaspete->tara->prescurtare}}.png"></p>
                @else
                    <p style="font-size:20px; color:#FFF"><img width="20px" class="img-circle" src="/images/{{$ultimul_meci[0]->nationala_gazda->tara->prescurtare}}.png"> {{$ultimul_meci[0]->nationala_gazda->tara->nume}} - {{$ultimul_meci[0]->nationala_oaspete->tara->nume}} <img width="20px" class="img-circle" src="/images/{{$ultimul_meci[0]->nationala_oaspete->tara->prescurtare}}.png"></p>
                @endif
                <div class="d-inline-flex">
                    <div class="clasament-circle-white mr-4">{{$ultimul_meci[0]->goluri_gazde}}</div>
                    <div class="clasament-circle-white ml-4">{{$ultimul_meci[0]->goluri_oaspeti}}</div>
                </div>
                <p style="padding:3em 0em 2em 0em;" data-goluri_oaspeti="{{json_encode($goluri_oaspeti)}}" data-goluri_gazde="{{json_encode($goluri_gazde)}}" data-toggle="modal" data-data="{{json_encode($data2)}}" data-adversar="{{json_encode($adversar2)}}" data-unde="{{json_encode($unde2)}}" data-target="#exampleModalCenter" class="openDialog"><a style="cursor: pointer">Vezi meciurile jucate</a></p>
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
            if(!$ech_nat)
            {
                $echipa= App\EchipaCompetitie::where('echipa_id','=',$echipa_id)->where('competitie_id','=',$competitie->competitie_id)->first();
            }
            else
            {
                $echipa= App\EchipaCompetitie::where('nationala_id','=',$echipa_id)->where('competitie_id','=',$competitie->competitie_id)->first();
            }
            
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
                            @if(!$ech_nat)
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
                                @elseif( $entitate->echipa_id !=null )
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
                            @else
                                @if( $entitate->nationala_id == $echipa_id )
                                    <td style="width: 5%">
                                        <div class="clasament-circle-white mb-2 mr-4 font-weight-normal">{{$entitate->loc}}</div>
                                    </td>
                                    <td style="color: #FFF; width: 90%; text-align: left">
                                        {{$entitate->nationala->tara->nume}}
                                    </td>
                                    <td style="color: #FFF; width: 5%">
                                        {{$entitate->puncte}}
                                    </td>
                                @elseif( $entitate->nationala_id !=null )
                                    <td style="width: 5%">
                                        <div class="clasament-circle-black mb-2 mr-4 font-weight-normal">{{$entitate->loc}}</div>
                                    </td>

                                    <td style="width: 90%; text-align: left">
                                        {{$entitate->nationala->tara->nume}}
                                    </td>
                                    <td style="width: 5%">
                                        {{$entitate->puncte}}
                                    </td>
                                @endif
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
                            @if(!$ech_nat)
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
                                @elseif( $entitate->echipa_id !=null )
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
                            @else
                                @if( $entitate->nationala_id == $echipa_id )
                                    <td style="width: 5%">
                                        <div class="clasament-circle-white mb-2 mr-4 font-weight-normal">{{$entitate->loc}}</div>
                                    </td>
                                    <td style="color: #FFF; width: 90%; text-align: left">
                                        {{$entitate->nationala->tara->nume}}
                                    </td>
                                    <td style="color: #FFF; width: 5%">
                                        {{$entitate->puncte}}
                                    </td>
                                @elseif( $entitate->nationala_id !=null )
                                    <td style="width: 5%">
                                        <div class="clasament-circle-black mb-2 mr-4 font-weight-normal">{{$entitate->loc}}</div>
                                    </td>

                                    <td style="width: 90%; text-align: left">
                                        {{$entitate->nationala->tara->nume}}
                                    </td>
                                    <td style="width: 5%">
                                        {{$entitate->puncte}}
                                    </td>
                                @endif
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
    if(!$ech_nat)
    {
        $jucatori = App\Jucator::where('echipa_id','=',$echipa_id)->orderBy('goluri','desc')->take(5)->get();
    }
    else
    {
        $jucatori = App\Jucator::where('nationala_id','=',$echipa_id)->orderBy('goluri','desc')->take(5)->get();
    }

    @endphp
    <div id="statut" class="col-12 statut mt-5">
        <table class="table-carousel" style="color: #FFF">
            <thead>
                <tr style="border-bottom: 1px solid;">
                    <th class="text-left">Nume</th>
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
        <p style="padding:3em 0em 1em 0em;"><a href ="/jucator/propriu">Vezi statutul lotului</a></p>
    </div>

</div>

@else

<div class="custom_container">
    <table class="table table-striped jucatori">
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
                if(empty($echipa))
                {
                    $nationala = App\Nationala::where('user_id','=',$utilizator->id)->value('id');
                    $echipa = App\Tara::where('id','=',$nationala)->value('nume');
                }
                if(empty($echipa))
                {
                    $echipa = "admin";
                }
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
</div>
@endif
@else
    <h1>Se pare ca nu ai cont la noi. Daca doresti sa iti gestionezi propria echipa de fotbal, atunci inregistreaza-te chiar acum</h1>
    <a class="btn btn-primary" href ="/register">Inregistrare</a>
@endif

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Calendar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).on("click", ".openDialog", function() {
        var adversari = $(this).data('adversar');
        var goluri_gazde = $(this).data('goluri_gazde');
        var goluri_oaspeti = $(this).data('goluri_oaspeti');
        var dati = $(this).data('data');
        var undeuri = $(this).data('unde');
        var today = new Date();
        var dataAzi = today.getFullYear()+'-';
        var evenimente=[];
        if(today.getMonth() >= 9 )
        {
            dataAzi += (today.getMonth() + 1);
        }
        else
        {
            dataAzi = dataAzi + '0' + (today.getMonth() + 1);
        }

        dataAzi += '-';
        if(today.getDate() + 1 >= 10 )
        {
            dataAzi += today.getDate();
        }
        else
        {
            dataAzi = dataAzi + '0' + (today.getDate() + 1);
        }

        for( var iterator = 0; iterator < adversari.length; iterator++ )
        {
            dati[iterator] = dati[iterator].split(" ")[0];
            if(goluri_gazde)
            {
                var eveniment = 
                {
                    title: adversari[iterator]+" "+undeuri[iterator]+" "+goluri_gazde[iterator]+"-"+goluri_oaspeti[iterator],
                    start: dati[iterator],
                    display: 'background',
                    backgroundColor: '#007CDB',
                    textColor: '#000000'
                };
            }
            else
            {
                var eveniment = 
                {
                    title: adversari[iterator]+" "+undeuri[iterator],
                    start: dati[iterator],
                    display: 'background',
                    backgroundColor: '#007CDB',
                    textColor: '#000000'
                };
            }

            evenimente.push(eveniment);
        }

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            initialDate: dataAzi,
            headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          events: evenimente
      });

        calendar.render();
    });

</script>
@endsection