@extends('layouts.app-navbar')

@section('content')
<div class="custom_container"> 
    <form method="POST" action="/jucator/filtrare">
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
                <input type="text" class="form-control" name="Nume" value="{{old('Nume')}}" placeholder="Cauta nume">
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Data nasterii</th>
                <th>Nationalitate</th>
                <th>Inaltime</th>
                <th>Picior preferat</th>
                <th>Post</th>
                <th>Nationala</th>
                <th>Evaluare</th>
                <th>Meciuri</th>
                <th>Minute</th>
                <th>Goluri</th>
                <th>Pase</th>
                <th>Pase gol</th>
                <th>Pase cheie</th>
                <th>Precizie pase</th>
                <th>Sanse create</th>
                <th>Galbene</th>
                <th>Rosii</th>
                <th>Suturi</th>
                <th>Suturi blocate</th>
                <th>Precizie suturi</th>
                <th>Centrari</th>
                <th>Dueluri aeriene castigate</th>
                <th>Dueluri aeriene pierdute</th>
                <th>Degajari</th>
                <th>Mingi profunzime</th>
                <th>Deposedat</th>
                <th>Driblunguri incercate</th>
                <th>Driblunguri reusite</th>
                <th>Dueluri pierdute</th>
                <th>Dueluri castigate</th>
                <th>Faulturi</th>
                <th>Interceptii</th>
                <th>Recuperari</th>
                <th>Faultat</th>
                <th>Deposedari incercate</th>
                <th>Deposedari reusite</th>
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
                    <td class="center">{{ $jucator->rating }}</td>
                    <td class="center">{{ $jucator->meciuri_jucate }}</td>
                    <td class="center">{{ $jucator->minute_jucate }}</td>
                    <td class="center">{{ $jucator->goluri }}</td>
                    <td class="center">{{ $jucator->pase }}</td>
                    <td class="center">{{ $jucator->pase_gol }}</td>
                    <td class="center">{{ $jucator->pase_cheie }}</td>
                    <td class="center">{{ $jucator->precizie_pase }}</td>
                    <td class="center">{{ $jucator->sanse_create }}</td>
                    <td class="center">{{ $jucator->cartonase_galbene }}</td>
                    <td class="center">{{ $jucator->cartonase_rosii }}</td>
                    <td class="center">{{ $jucator->suturi }}</td>
                    <td class="center">{{ $jucator->suturi_blocate }}</td>
                    <td class="center">{{ $jucator->precizie_suturi }}</td>
                    <td class="center">{{ $jucator->centrari }}</td>
                    <td class="center">{{ $jucator->dueluri_aeriene_castigate }}</td>
                    <td class="center">{{ $jucator->dueluri_aeriene_pierdute }}</td>
                    <td class="center">{{ $jucator->degajari }}</td>
                    <td class="center">{{ $jucator->mingi_profunzime }}</td>
                    <td class="center">{{ $jucator->deposedat }}</td>
                    <td class="center">{{ $jucator->driblinguri_incercate }}</td>
                    <td class="center">{{ $jucator->driblinguri_reusite }}</td>
                    <td class="center">{{ $jucator->dueluri_pierdute }}</td>
                    <td class="center">{{ $jucator->dueluri_castigate }}</td>
                    <td class="center">{{ $jucator->faulturi }}</td>
                    <td class="center">{{ $jucator->interceptii }}</td>
                    <td class="center">{{ $jucator->recuperari }}</td>
                    <td class="center">{{ $jucator->faultat }}</td>
                    <td class="center">{{ $jucator->deposedari_incercate }}</td>
                    <td class="center">{{ $jucator->deposedari_reusite }}</td>
                    <td class="center">{{ $jucator->goluri_primite }}</td>
                    <td class="center">{{ $jucator->parade }}</td>
                    <td class="center">{{ $jucator->iesiri_din_poarta }}</td>
                    <td class="center">{{ $jucator->boxari }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
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