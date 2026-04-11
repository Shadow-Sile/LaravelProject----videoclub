<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $libro = new Libro;
        $libro->titulo = "El señor de los anillos";
        $libro->autor = "JR TOLKIEN";
        $libro->anyo = "2040";
        $libro->save(); //ESTO HACE QUE SE AÑADA ALA BASE DE DATOS

       // $libro = Libro::first();
        
       // return $libro->titulo . "" . $libro->anyo; // devuelve solamente er titulo y el año  
                                                   // cuando entramos dentro de videoclub.test/libros

        //return view('libros.index');
    }   //y aqui seria que en el controlador de libros, donde el libros.blade.php, que muestre lo que haya ahi dentro

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
