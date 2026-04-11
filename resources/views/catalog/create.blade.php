@extends('layouts.master')

@section('title', 'catalog creamosh')

@section('content')

<div class="row" style="margin-top:40px">
    <div class="offset-md-3 col-md-6">
        <div class="card">
            <div class="card-header text-center">
                Añadir película
            </div>
            <div class="card-body" style="padding:30px">

                <form action="{{ route('catalog.new') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Títol</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old( 'title' ) }}">
                        @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                        
                    </div>

                    <div class="form-group">
                        <label for="year">Any</label>
                        <input type="text" name="year" id="year" class="form-control  @error('year') is-invalid @enderror" value="{{ old( 'year' ) }}">
                    @error('year')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                   
                   
                    </div>

                    <div class="form-group">
                        <label for="director" >Director</label>
                        <input type="text" name="director" id="director" class="form-control  @error('director') is-invalid @enderror" value="{{ old( 'director' ) }}">
                    @error('director')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="poster">Poster</label>
                        <input type="text" name="poster" id="poster" class="form-control  @error('poster') is-invalid @enderror" value="{{ old( 'poster' ) }}">
                    @error('poster')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="synopsis">Resum</label>
                        <textarea name="synopsis" id="synopsis" class="form-control @error('synopsis') is-invalid @enderror" value="{{ old( 'synopsis' ) }}" rows="3"></textarea>
                    @error('synopsis')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                            Afegir pel·lícula
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
