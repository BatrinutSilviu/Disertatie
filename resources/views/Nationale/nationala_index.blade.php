@extends('layouts.app-navbar')

@section('content')

<div class="custom_container"> 
    <form method="POST" action="/nationala/filtrare">
        {{ csrf_field() }}
        <div class="row div_filter">
            <div class="field col-2">
                <div class="control">
                    <button type="submit" class="btn btn-primary">
                     <span class="material-icons" style="vertical-align: middle;">search</span>
                     <span style="vertical-align: middle;">Filtreaza</span></button>
                    </button>
                </div>
            </div>
            <div class="input-group mb-3 col-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nume</span>
                </div>
                <input id="cauta_tara" type="text" class="form-control" name="Nume" value="{{old('Nume')}}" placeholder="Cauta nume">
            </div>
            @if( auth()->id() == 1 )
                <div class="col-8 text-right">
                    <a class="btn btn-primary" href ="/nationala/adaugare">
                        <span class="material-icons" style="vertical-align: middle;">add</span>
                        <span style="vertical-align: middle;">Adaugare</span>
                    </a>
                </div>
            @endif
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Steag</th>
                <th>Afiliere</th>
                <th>Selectioner</th>
                @if( auth()->id() == 1 )
                    <th style="width:10rem">Actiuni</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($nationale as $nationala)
                <tr>
                    @if ( !empty( $nationala->Tara->nume ) )
                        <td>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Lot"
                                href ="/nationala/{{$nationala->id}}/jucatori">{{ $nationala->Tara->nume }}</a>
                        </td>
                    @elseif( !empty( $nationala->tara_id ) )
                        @php
                            $tara = App\Tara::findOrFail($nationala->tara_id);
                        @endphp         
                        <td>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Lot"
                                href ="/nationala/{{$nationala->id}}/jucatori">{{ $tara->nume }}</a>
                        </td>
                    @endif
                    @if ( !empty( $nationala->Tara->prescurtare ) )
                        <td align="center">
                            <img width="20px" class="img-circle" src="/images/{{$nationala->Tara->prescurtare}}.png">
                        </td>
                    @elseif( !empty( $nationala->tara_id ) )
                        @php
                            $tara = App\Tara::findOrFail($nationala->tara_id);
                        @endphp         
                        <td><img width="20px" class="img-circle" src="/images/{{$tara->prescurtare}}.png"></td>
                    @endif

                    <td>{{ $nationala->afiliere }}</td>
                    <td>{{ $nationala->selectioner }}</td>
                    @if( auth()->id() == 1 )
                        <td class="text-center">
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Modifica echipa"
                                href ="/nationala/{{$nationala->id}}/modificare">
                                <span class="material-icons edit-icon">create</span>
                            </a>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Sterge echipa"
                                href ="/nationala/{{$nationala->id}}/stergere" onclick="return confirm('Sure Want Delete?')">
                                <span class="material-icons remove-icon">remove_circle_outline</span>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>{{$nationale->links()}}</div>
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
