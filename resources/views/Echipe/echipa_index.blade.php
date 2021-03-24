@extends('layouts.app-navbar')

@section('content')
<div class="custom_container"> 
    <form method="GET" action="/echipa">
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
                    <span class="input-group-text">Nume</span>
                </div>
                <input type="text" class="form-control" name="Nume" value="{{old('Nume')}}" placeholder="Cauta nume">
            </div>
            <div class="input-group mb-3 col-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Tara</span>
                </div>
                <input type="text" name="Tara" id="cauta_tara" class="form-control" placeholder="Cauta tara" value="{{old('Tara')}}">
            </div>
            @if( auth()->id() == 1 )
                <div class="text-right" style="margin-right: 10px; flex: auto;">
                    <a class="btn btn-adauga" href ="/echipa/adaugare">
                        <span class="material-icons" style="vertical-align: middle;">add</span>
                        <span style="vertical-align: middle;">Adauga</span>
                    </a>
                </div>
            @endif
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Tara</th>
                <th>Competitii</th>
                <th>Manager</th>
                @if( auth()->id() == 1 )
                    <th style="width:10rem">Actiuni</th>
                @endif
                
            </tr>
        </thead>
        <tbody>
            @foreach ($echipe as $echipa)
                <tr>
                    <td align="center">
                        <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Lot"
                            href ="/echipa/{{$echipa->id}}/jucatori">{{ $echipa->nume }}</a>
                    </td>                 
                    @if ( !empty( $echipa->Tara->prescurtare ) )
                         @php
                         $nationalitate = App\Tara::where('prescurtare','=',$echipa->Tara->prescurtare)->value('nume');
                         @endphp
                    <td align="center" title="{{$nationalitate}}">
                            <img width="20px" class="img-circle" src="/images/{{$echipa->Tara->prescurtare}}.png">
                        </td>
                    @elseif( !empty( $echipa->tara_id ) )
                        @php
                            $tara = App\Tara::findOrFail($echipa->tara_id);
                        @endphp         
                        @php
                        $nationalitate = App\Tara::where('prescurtare','=',$tara->prescurtare)->value('nume');
                        @endphp
                    <td align="center" title="{{$nationalitate}}">
                            <img width="20px" class="img-circle" src="/images/{{ $tara->prescurtare }}.png">
                        </td>
                    @endif

                    <td align="center">
                        @php
                        $competitii= App\EchipaCompetitie::where('echipa_id','=',$echipa->id)->pluck('competitie_id');
                        $total = count($competitii) - 1;
                        $contor = 0;
                        foreach ($competitii as $iterator)
                        {
                            $competitie= App\Competitie::findOrFail($iterator);
                            if( $contor != $total )
                                echo $competitie->nume.', ';
                            else
                                echo $competitie->nume;
                            $contor = $contor + 1;
                        }
                        @endphp
                    </td>
                    <td align="center">{{ $echipa->manager }}</td>
                    @if( auth()->id() == 1 )
                        <td class="text-center">
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Modifica echipa"
                                href ="/echipa/{{$echipa->id}}/modificare">
                                <span class="material-icons edit-icon">create</span>
                            </a>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Sterge echipa"
                                href ="/echipa/{{$echipa->id}}/stergere" onclick="return confirm('Sunteti sigur ca doriti stergerea?')">
                                <span class="material-icons remove-icon">remove_circle_outline</span>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>{{$echipe->appends(Request::all())->links()}}</div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="Stylesheet" />
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){

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
