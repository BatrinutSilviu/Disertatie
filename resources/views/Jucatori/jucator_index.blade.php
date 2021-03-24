@extends('layouts.app-navbar')

@section('content')
<div class="custom_container"> 
    <form method="GET" action="/jucator">
        {{ csrf_field() }}
        <div class="d-flex div_filter">
            <div class="field" style="margin-left:10px; margin-right: 15px;">
                <div class="control">
                    <button type="submit" class="btn btn-primary">                       
                     <span class="material-icons" style="vertical-align: middle;">search</span>
                     <span style="vertical-align: middle;">Filtreaza</span></button>
                </div>
            </div>
            <div class="input-group mb-3 col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nume</span>
                </div>
                <input id="cauta_jucator" type="text" class="form-control" name="Nume" value="{{old('Nume')}}" placeholder="Cauta nume">
            </div>
            <div class="input-group mb-3 col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Echipa</span>
                </div>
                <input type="text" name="echipa" id="cauta_echipa" class="form-control" placeholder="Cauta echipa" value="{{old('echipa')}}" />
            </div>
            <div class="input-group mb-3 col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nationalitate</span>
                </div>
                <input type="text" name="Nationalitate" id="cauta_tara" class="form-control" placeholder="Cauta tara" value="{{old('Nationalitate')}}">
            </div>
            @if( auth()->id() == 1 )
                <div class="text-right" style="margin-right: 10px; flex: auto;">
                    <a class="btn btn-adauga" href ="/jucator/adaugare">
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
                <th>@sortablelink('nume')</th>
                <th>@sortablelink('data_nasterii','Data nasterii')</th>
                <th>Nationalitate</th>
                <th>@sortablelink('inaltime')</th>
                <th>Picior preferat</th>
                <th>Post</th>
                <th>Echipa</th>
                <th>Nationala</th>
                @if( auth()->id() == 1 )
                    <th style="width:10rem">Actiuni</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($jucatori as $jucator)
            @if( !empty( $jucator->Nationala->Tara->nume) && !empty($jucator->echipa->nume) )
                <tr data-toggle="modal" data-echipa="{{$jucator->echipa->nume}}" data-nationala="{{ $jucator->Nationala->Tara->nume }}" data-jucator="{{$jucator}}" data-target="#exampleModalCenter" class="openDialog">
            @elseif( empty( $jucator->Nationala->Tara->nume) && !empty($jucator->echipa->nume) )
                 <tr data-toggle="modal" data-echipa="{{$jucator->echipa->nume}}" data-nationala="-" data-jucator="{{$jucator}}" data-target="#exampleModalCenter" class="openDialog">
            @elseif( !empty( $jucator->Nationala->Tara->nume) && empty($jucator->echipa->nume) )
                 <tr data-toggle="modal" data-echipa="-" data-nationala="{{ $jucator->Nationala->Tara->nume }}" data-jucator="{{$jucator}}" data-target="#exampleModalCenter" class="openDialog">
            @else
                @php
                    if( empty($jucator->echipa) )
                    {
                        $jucator = App\Jucator::findOrFail($jucator->id);
                    }
                @endphp
                <tr data-toggle="modal" data-echipa="-" data-nationala="-" data-jucator="{{$jucator}}" data-target="#exampleModalCenter" class="openDialog">
            @endif        
                    <td align="center">{{ $jucator->nume }}</td>
                    <td align="center">{{ $jucator->data_nasterii }}</td>
                    @php
                        $nationalitate = App\Tara::where('prescurtare','=',$jucator->nationalitate)->value('nume');
                    @endphp
                    <td align="center" title="{{$nationalitate}}">
                        <img width="20px" class="img-circle" src="/images/{{$jucator->nationalitate}}.png">
                    </td>
                    <td align="center">{{ $jucator->inaltime }}</td>
                    <td align="center">{{ $jucator->picior_preferat }}</td>
                    <td class="center">{{ $jucator->post }}</td>
                    @if ( !empty( $jucator->Echipa->nume ) )
                        <td align="center">
                            {{ $jucator->Echipa->nume }}
                        </td>
                    @elseif( !empty( $jucator->echipa_id ) )
                        @php
                            $echipa = App\Echipa::findOrFail($jucator->echipa_id);
                        @endphp
                        <td align="center">
                            {{ $echipa->nume }}
                        </td>
                    @else
                        <td align="center">Fara echipa</td>
                    @endif

                    @if ( !empty( $jucator->Nationala->Tara->nume ) )
                        <td align="center">
                            {{ $jucator->Nationala->Tara->nume }}
                        </td>
                    @elseif( !empty( $jucator->nationala_id ) )
                        @php
                            $nationala = App\Nationala::findOrFail($jucator->nationala_id);
                        @endphp
                        <td align="center">
                            {{ $nationala->Tara->nume }}
                        </td>
                    @else
                        <td align="center">Fara nationala</td>
                    @endif

                    @if( auth()->id() == 1 )
                        <td class="text-center">
                            <a class="btn action-button" type="button" data-toggle="tooltip" data-placement="top" title="Modifica jucator"
                                href ="/jucator/{{$jucator->id}}/modificare">
                                <span class="material-icons edit-icon">create</span>
                            </a>
                            <a class="btn action-button" type="button" data-toggle="tooltip" data-placement="top" title="Sterge jucator"
                                href ="/jucator/{{$jucator->id}}/stergere" onclick="return confirm('Sunteti sigur ca doriti stergerea?')">
                                <span class="material-icons remove-icon">remove_circle_outline</span>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- {!! $jucatori->appends(\Request::except('page'))->render() !!} -->
    {{$jucatori->appends(Request::all())->links()}}

<!--     @if( !empty( $jucatori->links() ) )
        <div>{{$jucatori->links()}}</div>
    @endif -->
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
         
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Detalii jucator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div id="program" class="col-12">
                <div class="col-12 clasament" style="margin-bottom:2em; padding-top:2em; padding-bottom:2em; font-weight: bold">
                    <p id="det-nume" style="margin-bottom:0 ;color:white; font-size:20px;"></p>
                    <span id="det-data_nasterii"></span>
                    <table style="width:85%; margin-top:2em;" align="center">
                        <tbody>
                            <tr>
                                <td style="width: 20%; text-align: left;">Nationalitatea:</td>
                                <td style="width: 30%; text-align: left;"> 
                                    <span style="color:white" id="det-nationalitate"></span> <img id="det-steag" width="20px" class="img-circle"> 
                                </td>
                                <td style="width: 20%; text-align: left;">Inaltimea:</td>
                                <td style="width: 20%; text-align: left; color:white" id="det-inaltime"> </td>
                            </tr>
                            <tr>
                                <td style="width: 20%; text-align: left;">Echipa curenta:</td>
                                <td style="width: 30%; text-align: left;color:white" id="det-echipa"> </td>
                                <td style="width: 20%; text-align: left;">Piciorul preferat:</td>
                                <td style="width: 20%; text-align: left;color:white" id="det-picior"> </td>
                            </tr>
                            <tr>
                                <td style="width: 20%; text-align: left;">Echipa nationala:</td>
                                <td style="width: 30%; text-align: left;color:white" id="det-nationala"> </td>
                                <td style="width: 20%; text-align: left;">Postul:</td>
                                <td style="width: 20%; text-align: left;color:white" id="det-post"> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div id="program" class="col-6">
                    <div class="col-12 meciul-urmator" style="padding-top:2em; font-weight: bold;">
                        <p style="font-size:20px; font-weight: bold">Sezonul 2020-2021</p>
                         <table align="center" class="ml-5 w-100">
                            <tbody>
                                <tr>
                                    <td style="width: 20%; text-align: left;">Meciuri jucate: </td>
                                    <td style="width: 25%; text-align: left; color:white" class="d-flex">
                                        <span id="det-meciuri" class="d-inline-flex"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; text-align: left;">Minute jucate: </td>
                                    <td style="width: 25%; text-align: left; color:white" class="d-flex">
                                        <span id="det-minute" class="d-inline-flex"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; text-align: left;">Evaluare: </td>
                                    <td style="width: 25%; text-align: left; color:white">
                                        <span id="det-evaluare"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="program" class="col-6">
                    <div class="col-12 ultimul-rezultat" style="padding-top:2em; padding-bottom: 2em; font-weight: bold;">
                        <p style="font-size:20px; font-weight: bold">Sezonul 2020-2021</p>
                        <table align="center" class="ml-5 w-100">
                            <tbody>
                                <tr>
                                    <td style="width: 20%; text-align: left;">Cartonase galbene: </td>
                                    <td style="width: 25%; text-align: left; color:white" class="d-flex">
                                        <span id="det-galbene" class="d-inline-flex"></span>
                                        <span class="material-icons" style="color:yellow; font-size:20px; margin-left:5px;">style</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; text-align: left;">Cartonase rosii: </td>
                                    <td style="width: 25%; text-align: left; color:white" class="d-flex">
                                        <span id="det-rosii" class="d-inline-flex"></span>
                                        <span class="material-icons" style="color:red; font-size:20px; margin-left:5px;">style</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; text-align: left;">Goluri: </td>
                                    <td style="width: 25%; text-align: left; color:white"><span id="det-gol"></span> </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; text-align: left;">Pase: </td>
                                    <td style="width: 25%; text-align: left; color:white"><span id="det-pase"></span> </td>
                                </tr>
                            </tbody>
                        </table>
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
    $("#cauta_jucator").autocomplete({
        source: function(request, response) {
             $.ajax({
                url:"{{ route('jucator.cauta') }}",
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
    $(".action-button").on("click", function (e) {
        e.stopPropagation();
    });
});
$(document).on("click", ".openDialog", function() {
    var echipa = $(this).data('echipa');
    var nationala = $(this).data('nationala');
    var jucator = $(this).data('jucator');
    dob = new Date(jucator['data_nasterii']);
    var today = new Date();
    var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
    $('.modal-body #det-data_nasterii').text(jucator['data_nasterii']+' ('+age+' ani)');
    $(".modal-body #det-nationalitate").text(jucator['nationalitate']);
    $(".modal-body #det-steag").attr('src',"/images/"+jucator['nationalitate']+'.png');
    $(".modal-body #det-inaltime").text(jucator['inaltime']);
    $(".modal-body #det-post").text(jucator['post']);
    $(".modal-body #det-picior").text(jucator['picior_preferat']);
    $(".modal-body #det-nationala").text(nationala);
    $(".modal-body #det-echipa").text(echipa);
    $(".modal-body #det-nume").text(jucator['nume']);
    $(".modal-body #det-gol").text(jucator['goluri']);
    $(".modal-body #det-pase").text(jucator['pase_gol']);
    $(".modal-body #det-galbene").text(jucator['cartonase_galbene']);
    $(".modal-body #det-rosii").text(jucator['cartonase_rosii']);
    $(".modal-body #det-meciuri").text(jucator['meciuri_jucate']);
    $(".modal-body #det-minute").text(jucator['minute_jucate']);
    $(".modal-body #det-evaluare").text(jucator['rating']);
});

</script>

@endsection