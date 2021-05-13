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
                <th>@sortablelink('nume')</th>
                <th>@sortablelink('data_nasterii','Data nasterii')</th>
                <th>Nationalitate</th>
                <th>@sortablelink('inaltime')</th>
                <th>Picior preferat</th>
                <th>Post</th>
                <th>Nationala</th>
                <th>@sortablelink('meciuri_jucate','meciuri')</th>
                <th>@sortablelink('minute_jucate','minute')</th>
                <th>@sortablelink('cartonase_galbene','galbene')</th>
                <th>@sortablelink('cartonase_rosii','rosii')</th>
                <th>@sortablelink('rating','evaluare')</th>
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
                <th>@sortablelink('nume')</th>
                <th title="Goluri">@sortablelink('goluri','Gol.')</th>
                <th title="Sanse Create">@sortablelink('sanse_create','S. c.')</th>
                <th title="Suturi">@sortablelink('suturi','Sut.')</th>
                <th title="Suturi blocate">@sortablelink('suturi_blocate','Sut. b.')</th>
                <th title="Precizie suturi">@sortablelink('precizie_suturi','P. s.')</th>
                <th title="Dueluri aeriene castigate">@sortablelink('dueluri_aeriene_castigate','D. a. c.')</th>
                <th title="Dueluri aeriene pierdute">@sortablelink('dueluri_aeriene_pierdute','D. a. p.')</th>
                <th title="Deposedat">@sortablelink('deposedat','Dep.')</th>
                <th title="Driblunguri incercate">@sortablelink('driblinguri_incercate','Dr. i.')</th>
                <th title="Driblunguri reusite">@sortablelink('driblinguri_reusite','Dr. r.')</th>
                <th title="Dueluri pierdute">@sortablelink('dueluri_pierdute','Du. p.')</th>
                <th title="Dueluri castigate">@sortablelink('dueluri_castigate','Du. c.')</th>
                <th title="Faultat">@sortablelink('faultat','Fau.')</th>
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
                <th>@sortablelink('nume')</th>
                <th title="Dueluri aeriene castigate">@sortablelink('dueluri_aeriene_castigate','D. a. c.')</th>
                <th title="Dueluri aeriene pierdute">@sortablelink('dueluri_aeriene_pierdute','D. a. p.')</th>
                <th title="Degajari">@sortablelink('degajari','Deg.')</th>
                <th title="Dueluri pierdute">@sortablelink('dueluri_pierdute','Du. p.')</th>
                <th title="Dueluri castigate">@sortablelink('dueluri_castigate','Du. c.')</th>
                <th title="Falturi">@sortablelink('faulturi','Fa.')</th>
                <th title="Interceptii">@sortablelink('interceptii','In.')</th>
                <th title="Recuperari">@sortablelink('recuperari','Re.')</th>
                <th title="Deposedari incercate">@sortablelink('deposedari_incercate','De. i.')</th>
                <th title="Deposedari reusite">@sortablelink('deposedari_reusite','De. r.')</th>
                <th title="Goluri primite">@sortablelink('goluri_primite','G. p').</th>
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
                <th>@sortablelink('nume')</th>
                <th>@sortablelink('pase','Pase')</th>
                <th>@sortablelink('pase_gol','Pase gol')</th>
                <th>@sortablelink('pase_cheie','Pase cheie')</th>
                <th>@sortablelink('precizie_pase','Precizie pase')</th>
                <th>@sortablelink('centrari','Centrari')</th>
                <th>@sortablelink('mingi_profunzime','Mingi profunzime')</th>
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
                <th>@sortablelink('nume')</th>
                <th>@sortablelink('goluri_primite','Goluri primite')</th>
                <th>@sortablelink('parade','Parade')</th>
                <th>@sortablelink('iesiri_din_poarta','Iesiri poarta')</th>
                <th>@sortablelink('boxari','Boxari')</th>
                <th>@sortablelink('plonjari','Plonjari')</th>
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
                    <td align="center">{{ $jucator->plonjari }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

  </div>    
</div>

{!! $jucatori->appends(\Request::except('page'))->render() !!}
<!--     @if( !empty( $jucatori->links() ) )
        <div>{{$jucatori->links()}}</div>
    @endif -->
</div>

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>

$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
    }
});
</script>

@endsection