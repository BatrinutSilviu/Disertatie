@extends('layouts.app-navbar')

@section('content')
<div class="row">
    <div class="col-2">
        <form method="POST" action="/nationala/filtrare">
            {{ csrf_field() }}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nume</span>
                </div>
                <input type="text" class="form-control" name="Nume" value="{{old('Nume')}}" placeholder="Cauta nume">
            </div>
            <button class="btn btn-primary" type="submit">Filtreaza</button>
        </form>
    </div>
	<table class="table table-striped table-bordered col-10">
        <thead>
            <tr class="text-center">
                <th>Nume</th>
                <th>Steag</th>
                <th>Afiliere</th>
                <th>Selectioner</th>
                @if( auth()->check() )
                    <th>Actiuni</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($nationale as $nationala)
                <tr>
                    <td>
                        <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Lot"
                            href ="/nationala/{{$nationala->id}}/jucatori">{{ $nationala->tara->Nume }}</a>
                    </td>
                    <td><img width="20px" class="img-circle" src="/images/{{$nationala->tara->Prescurtare}}.png"></td>
                    <td>{{ $nationala->Afiliere }}</td>
                    <td>{{ $nationala->Selectioner }}</td>
                    @if( auth()->check() )
                        <td>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Modifica echipa"
                                href ="/nationala/{{$nationala->id}}/modificare">
                                <span class="material-icons">create</span>
                            </a>
                            <a class="btn" type="button" data-toggle="tooltip" data-placement="top" title="Sterge echipa"
                                href ="/nationala/{{$nationala->id}}/stergere" onclick="return confirm('Sure Want Delete?')">
                                <span class="material-icons">remove_circle_outline</span>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
  	</table>
</div>
@if( auth()->check() )
    <div align="center">
        <a class="btn btn-primary" href ="/nationala/adaugare">Adaugare</a>
    </div>
@endif

@endsection
