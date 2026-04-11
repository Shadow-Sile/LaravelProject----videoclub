    @extends('layouts.master')

    @section('title', 'catalog index')

    @section('content')

    <!-- BARRA DE BÚSQUEDA Y FILTROS -->
    <div class="mb-4">
        <form method="GET" action="{{ url('/catalog') }}" class="row g-3">
            <!-- BÚSQUEDA -->
            <div class="col-md-5">
                <input 
                    type="text" 
                    name="search" 
                    class="form-control" 
                    placeholder="Buscar película..." 
                    value="{{ request('search') }}">
            </div>
            
            <!-- FILTRO DISPONIBILIDAD -->
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="todos" 
            @if(request('status') === 'todos' || !request('status')) selected @endif>
                Todas
            </option>
            <option value="disponible" 
            @if(request('status') === 'disponible') selected @endif>
                Disponibles
            </option>
            <option value="alquilada" 
            @if(request('status') === 'alquilada') selected @endif>
                Alquiladas
            </option>
        </select>
    </div>

    <!-- FILTRO ORDEN -->
    <div class="col-md-3">
        <select name="orden" class="form-select">
            <option value="a-z" 
            @if(request('orden') === 'a-z') selected @endif>
                A → Z
            </option>
            <option value="z-a" 
            @if(request('orden') === 'z-a') selected @endif>
                Z → A
            </option>
        </select>
    </div>

            
            <!-- BOTÓN BUSCAR -->
             <div class="col-md-1">
            <button type="submit" class="btn btn-outline-secondary w-80">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>
            </button>

            </div>
        </form>
    </div>

    <!-- GRID DE PELÍCULAS -->
   <!-- GRID DE PELÍCULAS -->
<div class="row">
    @foreach($pelicula as $peli)
        <div class="col-xs-6 col-sm-4 col-md-3 mb-4">
            <div class="movie-card">
                <a href="{{ url('/catalog/show/' . $peli->id) }}" class="d-block text-decoration-none text-white">

                    @if ($peli->rented)
                        <span class="badge text-bg-danger position-absolute top-0 start-0 z-1">Alquilada</span>
                    @else
                        <span class="badge text-bg-success position-absolute top-0 start-0 z-1">Disponible</span>
                    @endif

                    <img src="{{ $peli->poster }}"
                         alt="{{ $peli->title }}"
                         class="w-100"
                         style="height:400px; object-fit: cover;">

                    {{-- Caja que se ve al hacer hover: mini show.blade --}}
                    <div class="movie-info-hover">
                        <h6 class="mb-1">{{ $peli->title }}</h6>
                        <small class="d-block mb-1">
                            {{ $peli->year }} · {{ $peli->director }}
                        </small>
                        <p class="mb-0">
                            {{ \Illuminate\Support\Str::limit($peli->synopsi, 120) }}
                        </p>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
</div>


    @endsection
