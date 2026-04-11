<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\models\Movie;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
 


    public function index(Request $request)
{
    $query = Movie::query();  //para consultar
    
    // BÚSQUEDA 
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }
    
    // FILTRAR POR RENTED
    if ($request->filled('status') && $request->status !== 'todos') {
        if ($request->status === 'disponible') {
            $query->where('rented', false);  // ← rented = false = disponible
        } elseif ($request->status === 'alquilada') {
            $query->where('rented', true);   // ← rented = true = alquilada
        }
    }
    
    // ORDENAR
    if ($request->filled('orden')) {
        if ($request->orden === 'a-z') {
            $query->orderBy('title', 'asc');
        } elseif ($request->orden === 'z-a') {
            $query->orderBy('title', 'desc');
        }
    }
    
    $pelicula = $query->get();
    
    return view('catalog.index', ["pelicula" => $pelicula]);
}


    public function create() {

    return view('catalog.create');

	
    }

	public function new (Request $request) {


	$validated = $request->validate(
	 [

		'title' => 'required' ,
		'year' => 'required',
		'director' => 'required',
		'poster' => 'required',
		'synopsis' => 'required'


	 ]
	);
  
	$pelicula = new Movie;

	$pelicula->title = $request->title;
	$pelicula->year = $request->year;
	$pelicula->director = $request->director;
	$pelicula->poster = $request->poster; 
	$pelicula->synopsi = $request->synopsis;
	$pelicula->rented = false;
	$pelicula->save();


	return redirect()->route('catalog.index');

	}



public function update(Request $request, $id)
{
    $validated = $request->validate([
        'title'    => 'required',
        'year'     => 'required',
        'director' => 'required',
        'poster'   => 'required',
        'synopsis' => 'required'
    ]);

    $pelicula = Movie::findOrFail($id);

    $pelicula->title    = $request->title;
    $pelicula->year     = $request->year;
    $pelicula->director = $request->director;
    $pelicula->poster   = $request->poster;
    $pelicula->synopsi  = $request->synopsis; // ojo: mismo nombre de columna que en BD
    $pelicula->save();

    return redirect()->route('catalog.show', $pelicula->id);

}


    public function show($id) { 
     
		$pelicula = Movie::findOrFail($id);

    return view('catalog.show', ["pelicula" => $pelicula]); 
    }

    
    public function edit($id) { 

		$pelicula = Movie::findOrFail($id);
        
    return view('catalog.edit', ["pelicula" => $pelicula]); 
	 
    }


	public function destroy($id) {
    $pelicula = Movie::find($id);
    $pelicula->delete();
    return redirect()->route('catalog.index');
	}


	public function rent($id) {

	$pelicula = Movie::findOrFail($id);
	$pelicula -> rented = true;
	$pelicula->save();

	return redirect()->route('catalog.index');

	}

	public function return($id) {

	$pelicula = Movie::findOrFail($id);
	$pelicula -> rented = false;
	$pelicula->save();

	return redirect()->route('catalog.index');

	}


	
}
