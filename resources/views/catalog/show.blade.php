@extends('layouts.master')

@section('title', 'catalog show')

@section('content')

<div class="row"> 
    <div class="col-sm-5"> 
        <img src="{{$pelicula->poster}}" style="height:480px"/> </div> 
        <div class="col-sm-6"> 

        <h2>  {{$pelicula->title}} </h2> 

        <h4> Año: {{$pelicula->year}}</h4>

        <h5> Director: {{$pelicula->director}} </h5> <br>

        <p> <strong>Sinopsis:</strong> {{ $pelicula->synopsi}}</p>
        
        <p><strong> Estado: </strong>
        @if ($pelicula -> rented)   
        Pelicula actualmente alquilada!
        @else
        Pelicula actualmente disponible!
        @endif
        </p>

            @if ($pelicula->rented)
    <form action="{{ route('catalog.return', $pelicula->id) }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        
        <button class="btn btn-danger" type="submit">Devolver película</button>
    </form>
    @else
    <form action="{{ route('catalog.rent', $pelicula->id) }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <button class="btn btn-success" type="submit">Alquilar película</button>
    </form>
    @endif


        <a type="button" href="{{url('/catalog/edit/' . $pelicula -> id)}}" class="btn btn-warning"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
</svg> Editar película</a> 


        <form action="{{ route('catalog.destroy', $pelicula->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-secondary" type="submit">Eliminar</button>
</form>

        <a type="button" href="/catalog" class="btn btn-default"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
</svg> Volver</a>

           
    </div>  
        
        
</div> 

@endsection
