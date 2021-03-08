@extends('layouts.app-navbar')

@section('content')

<div class="custom_container"> 
    <form method="POST" action="/meci/filtrare">
        {{ csrf_field() }}
        <div class="d-flex div_filter">
            <div class="field" style="margin-left:10px; margin-right: 15px;">
                <div class="control">
                    <button type="submit" class="btn btn-primary">
                     <span class="material-icons" style="vertical-align: middle;">search</span>
                     <span style="vertical-align: middle;">Filtreaza</span></button>
                    </button>
                </div>
            </div>
            <div class="input-group mb-3 col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Echipa</span>
                </div>
                <input type="text" name="echipa" id="cauta_echipa" class="form-control" placeholder="Cauta echipa" value="{{old('echipa')}}" />
            </div>
            <div class="input-group mb-3 col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Data</span>
                </div>
                <input type="date" name="data" id="cauta_data" max="3000-12-31" min="1000-01-01" placeholder="Cauta data" class="form-control" value="{{old('data')}}">
            </div>
            @if( auth()->id() == 1 )
                <div class="text-right" style="margin-right: 10px; flex: auto;">
                    <a class="btn btn-adauga" href ="/meci/adaugare">
                        <span class="material-icons" style="vertical-align: middle;">add</span>
                        <span style="vertical-align: middle;">Adauga</span>
                    </a>
                </div>
     @endif
        </div>
    </form>

    @if( auth()->id() == 1 )
    <table class="table table-striped">
    @else
    <table class="table table-striped jucatori">
    @endif
        <thead>
            <tr class="text-center">
                <th>Echipa gazda</th>
                <th>Scor</th>
                <th>Echipa oaspete</th>
                <th>Competitie</th>
                <th>Data</th>
                @if( auth()->id() == 1 )
                    <th style="width:10rem">Actiuni</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($meciuri as $meci)
            @php
                $gazde_id=$meci->echipa_gazda->jucatori->pluck('id');
                $oaspeti_id=$meci->echipa_oaspete->jucatori->pluck('id');

                $marcatori1= App\Marcator::where('meci_id','=',$meci->id)->whereIn('jucator_id',$gazde_id)->orderBy('minut')->get('jucator_id');
                $marcatori1minut= App\Marcator::where('meci_id','=',$meci->id)->whereIn('jucator_id',$marcatori1)->orderBy('minut')->get('minut');

                $marcatori1nume= array();
                foreach($marcatori1 as $iterator)
                {
                    $jucator=App\Jucator::find($iterator);
                    if($jucator->first())
                    {
                        array_push($marcatori1nume, $jucator[0]->nume);
                    }
                }
                $marcatori1nume=implode(",",$marcatori1nume);

                $pasatori1= App\Marcator::where('meci_id','=',$meci->id)->whereIn('jucator_id',$gazde_id)->orderBy('minut')->get('assist_id');
                $pasatori1nume=array();
                foreach($pasatori1 as $iterator)
                {
                    $jucator=App\Jucator::find($iterator);
                    if($jucator->first())
                    {
                        array_push($pasatori1nume, $jucator[0]->nume);
                    }
                }
                $pasatori1nume=implode(",",$pasatori1nume);

                $marcatori2= App\Marcator::where('meci_id','=',$meci->id)->whereIn('jucator_id',$oaspeti_id)->orderBy('minut')->get('jucator_id');
                $marcatori2minut= App\Marcator::where('meci_id','=',$meci->id)->whereIn('jucator_id',$marcatori2)->orderBy('minut')->get('minut');

                $marcatori2nume= array();
                foreach($marcatori2 as $iterator)
                {
                    $jucator=App\Jucator::find($iterator);
                    if($jucator->first())
                    {
                        array_push($marcatori2nume, $jucator[0]->nume);
                    }
                }
                $marcatori2nume=implode(",",$marcatori2nume);

                $pasatori2= App\Marcator::where('meci_id','=',$meci->id)->whereIn('jucator_id',$oaspeti_id)->orderBy('minut')->get('assist_id');
                $pasatori2nume=array();
                foreach($pasatori2 as $iterator)
                {
                    $jucator=App\Jucator::find($iterator);
                    if($jucator->first())
                    {
                        array_push($pasatori2nume, $jucator[0]->nume);
                    }
                }
                $pasatori2nume=implode(",",$pasatori2nume);

                $cartonase1id=App\Cartonase::where('meci_id','=',$meci->id)->whereIn('jucator_id',$gazde_id)->orderBy('minut')->get('jucator_id');
                $cartonase2id=App\Cartonase::where('meci_id','=',$meci->id)->whereIn('jucator_id',$oaspeti_id)->orderBy('minut')->get('jucator_id');
                $cartonase1= App\Cartonase::where('meci_id','=',$meci->id)->whereIn('jucator_id',$cartonase1id)->select('minut','culoare')->orderBy('minut')->get();
                $cartonase2= App\Cartonase::where('meci_id','=',$meci->id)->whereIn('jucator_id',$cartonase2id)->select('minut','culoare')->orderBy('minut')->get();

                $cartonase1nume=array();
                foreach($cartonase1id as $iterator)
                {
                    $jucator=App\Jucator::find($iterator);
                    if($jucator->first())
                    {
                        array_push($cartonase1nume, $jucator[0]->nume);
                    }
                }
                $cartonase1nume=implode(",",$cartonase1nume);

                $cartonase2nume=array();
                foreach($cartonase2id as $iterator)
                {
                    $jucator=App\Jucator::find($iterator);
                    if($jucator->first())
                    {
                        array_push($cartonase2nume, $jucator[0]->nume);
                    }
                }
                $cartonase2nume=implode(",",$cartonase2nume);
            @endphp
                <tr data-toggle="modal" data-target="#exampleModalCenter" class="openDialog" data-meci="{{$meci}}" data-echipa1="{{$meci->echipa_gazda->nume}}" data-echipa2="{{$meci->echipa_oaspete->nume}}" data-steag1="{{$meci->echipa_gazda->tara->prescurtare}}" data-steag2="{{$meci->echipa_oaspete->tara->prescurtare}}" data-competitia="{{$meci->competitie->nume}}" data-marcatori1minut="{{$marcatori1minut}}" data-marcatori1nume="{{$marcatori1nume}}" data-marcatori2minut="{{$marcatori2minut}}" data-marcatori2nume="{{$marcatori2nume}}" data-cartonase1="{{$cartonase1}}" data-cartonase2="{{$cartonase2}}" data-pasatori1="{{$pasatori1nume}}" data-pasatori2="{{$pasatori2nume}}" data-cartonase1nume="{{$cartonase1nume}}" data-cartonase2nume="{{$cartonase2nume}}">
                    @if ( !empty( $meci->echipa_gazda->nume ) )
                        <td align="center">{{ $meci->echipa_gazda->nume }}</td>
                    @else
                        @php
                            $echipa = App\Echipa::findOrFail($meci->echipa_gazda_id);
                        @endphp
                        <td align="center">
                            {{ $echipa->nume }}
                        </td>
                    @endif
                    <td align="center">{{ $meci->goluri_gazde }} - {{ $meci->goluri_oaspeti }}</td>
                    @if ( !empty( $meci->echipa_oaspete->nume ) )
                        <td align="center">{{ $meci->echipa_oaspete->nume }}</td>
                    @else
                        @php
                            $echipa = App\Echipa::findOrFail($meci->echipa_oaspete_id);
                        @endphp
                        <td align="center">
                            {{ $echipa->nume }}
                        </td>
                    @endif
                    @if ( !empty( $meci->competitie->nume ) )
                        <td align="center">{{ $meci->competitie->nume }}</td>
                    @else
                        @php
                            $competitie = App\Competitie::findOrFail($meci->competitie_id);
                        @endphp
                        <td align="center">
                            {{ $competitie->nume }}
                        </td>
                    @endif
                    @php
                        $splitted=explode(':',$meci->data);
                    @endphp
                    <td align="center">{{ $splitted[0].':'.$splitted[1] }}</td>
                    
                    @if( auth()->id() == 1 )
                        <td class="text-center">
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Modifica meci"
                                href ="/meci/{{$meci->id}}/modificare">
                                <span class="material-icons edit-icon">create</span>
                            </a>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Sterge meci"
                                href ="/meci/{{$meci->id}}/stergere" onclick="return confirm('Sunteti sigur ca doriti stergerea?')">
                                <span class="material-icons remove-icon">remove_circle_outline</span>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>{{$meciuri->links()}}</div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Detalii meci</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div id="program" class="col-12">
                <div class="col-12 clasament" style="margin-bottom:2em; padding-bottom: 2em;">
                    <p style="font-size:20px; color:#FFF; margin:0;">
                        <img id="det-steag1" width="20px" class="img-circle">
                        <span id="det-echipa1" style="color:white; font-size:20px; font-weight: bold"></span> - 
                        <span id="det-echipa2" style="color:white; font-size:20px; font-weight: bold"></span>
                        <img id="det-steag2" width="20px" class="img-circle">
                    </p>
                    <div align="center" class="d-inline-flex mb-5">
                        <div class="clasament-circle-white mr-4" id="det-scor1" style="font-size: 14px;width: 26px; height: 26px;"></div>
                        <div class="clasament-circle-white mr-4" id="det-scor2" style="font-size: 14px;width: 26px; height: 26px;"></div>
                    </div>
                    <table style="font-weight: bold; width: 80%;" align="center">
                        <tbody>
                            <tr>
                                <td style="width: 10%; text-align: left">Competitia: </td>
                                <td style="width: 40%; text-align: left"><span style="color:white" id="det-competitia"></span></td>
                                <td style="width: 10%; text-align: left">Teren: </td>
                                <td style="width: 20%; text-align: left"><span style="color:white" id="det-teren"></span></td>
                            </tr>
                            <tr>
                                <td style="width: 10%; text-align: left">Data: </td>
                                <td style="width: 40%; text-align: left"><span style="color:white" id="det-data"></span></td>
                                <td style="width: 10%; text-align: left">Arbitru: </td>
                                <td style="width: 20%; text-align: left"><span style="color:white" id="det-arbitru"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div id="program" class="col-6">
                    <div class="col-12 meciul-urmator">
                        <p id="det-echipa1" style="font-size:20px; font-weight: bold"></p> <img id="det-steag1" width="20px" class="img-circle">
                        <span id="det-galbene"></span>
                        <span id="det-rosii"></span>
                        <span id="det-gol1"></span>
                        <span id="det-pase1"></span>
                        <span id="det-cart1"></span>

                    </div>
                </div>
                <div id="program" class="col-6">
                    <div class="col-12 ultimul-rezultat">
                        <p id="det-echipa2" style="font-size:20px; font-weight: bold"></p> <img id="det-steag2" width="20px" class="img-circle">
                        <span id="det-galbene"></span>
                        <span id="det-rosii"></span>
                        <span id="det-gol2"></span>
                        <span id="det-pase2"></span>
                        <span id="det-cart2"></span>
                    </div>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="Stylesheet" />
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){

    $("#cauta_echipa").autocomplete({
        source: function(request, response) {
             $.ajax({
                url:"{{ route('echipa.cauta') }}",
                method:'GET',
                dataType:'json',
                data: {
                    search: request.term
                },
                success:function(data) {
                    response(data);
                }
            })
        }
    });
    $("#cauta_tara").autocomplete({
        source: function(request, response) {
             $.ajax({
                url:"{{ route('tara.cauta') }}",
                method:'GET',
                dataType:'json',
                data: {
                    search: request.term
                },
                success:function(data) {
                    response(data);
                }
            })
        }
    });
});

$(document).on("click", ".openDialog", function() {
        $('.modal-body #det-gol1').html('');
        $('.modal-body #det-gol2').html('');
        $('.modal-body #det-cart1').html('');
        $('.modal-body #det-cart2').html('');
        var echipa1 = $(this).data('echipa1');
        var steag1 = $(this).data('steag1');
        var echipa2 = $(this).data('echipa2');
        var steag2 = $(this).data('steag2');
        var meci = $(this).data('meci');
        var competitia = $(this).data('competitia');
        var marcatori1minut = $(this).data('marcatori1minut');
        var marcatori1nume = $(this).data('marcatori1nume');
        var pasatori1nume = $(this).data('pasatori1');
        var marcatori2minut = $(this).data('marcatori2minut');
        var marcatori2nume = $(this).data('marcatori2nume');
        var pasatori2nume = $(this).data('pasatori2');
        var cartonase1 = $(this).data('cartonase1');
        var cartonase2 = $(this).data('cartonase2');
        var cartonase1nume = $(this).data('cartonase1nume');
        var cartonase2nume = $(this).data('cartonase2nume');
        var marcatori1html = "<div></div>";

        marcatori1nume = marcatori1nume.split(',');
        marcatori2nume = marcatori2nume.split(',');
        pasatori1nume = pasatori1nume.split(',');
        pasatori2nume = pasatori2nume.split(',');
        cartonase1nume = cartonase1nume.split(',');
        cartonase2nume = cartonase2nume.split(',');

        for(i=0;i<marcatori1minut.length;i++)
        {
            $('.modal-body #det-gol1').append(marcatori1nume[i] + " "+marcatori1minut[i].minut+"'");
            if(pasatori1nume[i])
            {
                $('.modal-body #det-gol1').append(" "+pasatori1nume[i]);
            }
            $('.modal-body #det-gol1').append("<br>");
        }
        for(i=0;i<marcatori2minut.length;i++)
        {
            $('.modal-body #det-gol2').append(marcatori2nume[i] + " "+marcatori2minut[i].minut+"'");
            if(pasatori2nume[i])
            {
                $('.modal-body #det-gol2').append(" "+pasatori2nume[i]);
            }
            $('.modal-body #det-gol2').append("<br>");
        }
        for(i=0;i<cartonase1.length;i++)
        {
            if(cartonase1[i].culoare)
            {
                $('.modal-body #det-cart1').append("<span class='material-icons' style='color:yellow'>style</span>" + " "+cartonase1[i].minut+"' "+cartonase1nume[i]);
                $('.modal-body #det-cart1').append("<br>");
            }
            else
            {
                $('.modal-body #det-cart1').append("<span class='material-icons' style='color:red'>style</span>"+ " "+cartonase1[i].minut+"' "+cartonase1nume[i]);
                $('.modal-body #det-cart1').append("<br>");
            }

        }
        for(i=0;i<cartonase2.length;i++)
        {
            if(cartonase2[i].culoare)
            {
                $('.modal-body #det-cart2').append("<span class='material-icons' style='color:yellow'>style</span>" + " "+cartonase2[i].minut+"' "+cartonase2nume[i]);
                $('.modal-body #det-cart2').append("<br>"); 
            }
            else
            {
                $('.modal-body #det-cart2').append("<span class='material-icons' style='color:red'>style</span>" + " "+cartonase2[i].minut+"' "+cartonase2nume[i]);
                $('.modal-body #det-cart2').append("<br>");
            }
        }
        $('.modal-body #det-echipa1').text(echipa1);
        $(".modal-body #det-echipa2").text(echipa2);
        $(".modal-body #det-steag1").attr('src',"/images/"+steag1+'.png');
        $(".modal-body #det-steag2").attr('src',"/images/"+steag2+'.png');
        $(".modal-body #det-scor1").text(meci['goluri_gazde']);
        $(".modal-body #det-scor2").text(meci['goluri_oaspeti']);
        $(".modal-body #det-teren").text(meci['teren']);
        $(".modal-body #det-arbitru").text(meci['arbitru']);
        $(".modal-body #det-data").text(meci['data'].split(':')[0]+":"+meci['data'].split(':')[1]);
        $(".modal-body #det-competitia").text(competitia);
        $(".modal-body #det-gol").text(meci['goluri']);
        $(".modal-body #det-pase").text(meci['pase_gol']);
        $(".modal-body #det-galbene").text(meci['cartonase_galbene']);
        $(".modal-body #det-rosii").text(meci['cartonase_rosii']);
    });
</script>

@endsection