@extends('layouts.app-navbar')

@section('content')
<div class="custom_container"> 

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="ofensiv-tab" data-toggle="tab" href="#ofensiv" role="tab" aria-controls="ofensiv" aria-selected="true">Ofensiv</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="defensiv-tab" data-toggle="tab" href="#defensiv" role="tab" aria-controls="defensiv" aria-selected="true">Defensiv</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pase-tab" data-toggle="tab" href="#pase" role="tab" aria-controls="pase" aria-selected="true">Pase</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="portar-tab" data-toggle="tab" href="#portar" role="tab" aria-controls="portar" aria-selected="true">Portar</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
      
 <table class="table table-striped jucatori">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Data nasterii</th>
                <th>Nationalitate</th>
                <th>Inaltime</th>
                <th>Picior preferat</th>
                <th>Post</th>
                <th>Nationala</th>
                <th>Meciuri</th>
                <th>Minute</th>
                <th>Galbene</th>
                <th>Rosii</th>
                <th>Evaluare</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jucatori as $jucator)
                <tr>
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
                    <td align="center">{{ $jucator->post }}</td>

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
                    <td align="center">{{ $jucator->meciuri_jucate }}</td>
                    <td align="center">{{ $jucator->minute_jucate }}</td>
                    <td align="center">{{ $jucator->cartonase_galbene }}</td>
                    <td align="center">{{ $jucator->cartonase_rosii }}</td>
                    <td align="center">{{ $jucator->rating }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="ofensiv" role="tabpanel" aria-labelledby="ofensiv-tab">
      
<table class="table table-striped jucatori">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th title="Goluri">Gol.</th>
                <th title="Sanse Create">S. c.</th>
                <th title="Suturi">Sut.</th>
                <th title="Suturi blocate">Sut. b.</th>
                <th title="Precizie suturi">P. s.</th>
                <th title="Dueluri aeriene castigate">D. a. c.</th>
                <th title="Dueluri aeriene pierdute">D. a. p.</th>
                <th title="Deposedat">Dep.</th>
                <th title="Driblunguri incercate">Dr. i.</th>
                <th title="Driblunguri reusite">Dr. r.</th>
                <th title="Dueluri pierdute">Du. p.</th>
                <th title="Dueluri castigate">Du. c.</th>
                <th title="Faultat">Fau.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jucatori as $jucator)
                <tr>
                    <td align="center">{{ $jucator->nume }}</td>
                    <td align="center">{{ $jucator->goluri }}</td>
                    <td align="center">{{ $jucator->sanse_create }}</td>
                    <td align="center">{{ $jucator->suturi }}</td>
                    <td align="center">{{ $jucator->suturi_blocate }}</td>
                    <td align="center">{{ $jucator->precizie_suturi }}</td>
                    <td align="center">{{ $jucator->dueluri_aeriene_castigate }}</td>
                    <td align="center">{{ $jucator->dueluri_aeriene_pierdute }}</td>
                    <td align="center">{{ $jucator->deposedat }}</td>
                    <td align="center">{{ $jucator->driblinguri_incercate }}</td>
                    <td align="center">{{ $jucator->driblinguri_reusite }}</td>
                    <td align="center">{{ $jucator->dueluri_pierdute }}</td>
                    <td align="center">{{ $jucator->dueluri_castigate }}</td>
                    <td align="center">{{ $jucator->faultat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

  </div>
  <div class="tab-pane fade" id="defensiv" role="tabpanel" aria-labelledby="defensiv-tab">
      
<table class="table table-striped jucatori">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th title="Dueluri aeriene castigate">D. a. c.</th>
                <th title="Dueluri aeriene pierdute">D. a. p.</th>
                <th title="Degajari">Deg.</th>
                <th title="Dueluri pierdute">Du. p.</th>
                <th title="Dueluri castigate">Du. c.</th>
                <th title="Falturi">Fa.</th>
                <th title="Interceptii">In.</th>
                <th title="Recuperari">Re.</th>
                <th title="Deposedari incercate">De. i.</th>
                <th title="Deposedari reusite">De. r.</th>
                <th title="Goluri primite">G. p.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jucatori as $jucator)
                <tr>
                    <td align="center">{{ $jucator->nume }}</td>
                    <td align="center">{{ $jucator->dueluri_aeriene_castigate }}</td>
                    <td align="center">{{ $jucator->dueluri_aeriene_pierdute }}</td>
                    <td align="center">{{ $jucator->degajari }}</td>
                    <td align="center">{{ $jucator->dueluri_pierdute }}</td>
                    <td align="center">{{ $jucator->dueluri_castigate }}</td>
                    <td align="center">{{ $jucator->faulturi }}</td>
                    <td align="center">{{ $jucator->interceptii }}</td>
                    <td align="center">{{ $jucator->recuperari }}</td>
                    <td align="center">{{ $jucator->deposedari_incercate }}</td>
                    <td align="center">{{ $jucator->deposedari_reusite }}</td>
                    <td align="center">{{ $jucator->goluri_primite }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

  </div>
  <div class="tab-pane fade" id="pase" role="tabpanel" aria-labelledby="pase-tab">

<table class="table table-striped jucatori">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Pase</th>
                <th>Pase gol</th>
                <th>Pase cheie</th>
                <th>Precizie pase</th>
                <th>Centrari</th>
                <th>Mingi profunzime</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jucatori as $jucator)
                <tr>
                    <td align="center">{{ $jucator->nume }}</td>
                    <td align="center">{{ $jucator->pase }}</td>
                    <td align="center">{{ $jucator->pase_gol }}</td>
                    <td align="center">{{ $jucator->pase_cheie }}</td>
                    <td align="center">{{ $jucator->precizie_pase }}</td>
                    <td align="center">{{ $jucator->centrari }}</td>
                    <td align="center">{{ $jucator->mingi_profunzime }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

  </div>

    <div class="tab-pane fade" id="portar" role="tabpanel" aria-labelledby="portar-tab">

    <table class="table table-striped jucatori">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Goluri primite</th>
                <th>Parade</th>
                <th>Iesiri poarta</th>
                <th>Boxari</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jucatori as $jucator)
                <tr>
                    <td align="center">{{ $jucator->nume }}</td>
                    <td align="center">{{ $jucator->goluri_primite }}</td>
                    <td align="center">{{ $jucator->parade }}</td>
                    <td align="center">{{ $jucator->iesiri_din_poarta }}</td>
                    <td align="center">{{ $jucator->boxari }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

  </div>    
</div>

    @if( !empty( $jucatori->links() ) )
        <div>{{$jucatori->links()}}</div>
    @endif
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
</script>

@endsection