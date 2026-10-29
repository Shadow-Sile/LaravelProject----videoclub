<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActualidadController extends Controller
{
    public function index(Request $request)
    {
        $file = database_path('data/actualidad.json');
        $items = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        return view('actualidad', [
            'items' => $items ?? [],
            'lastUpdated' => file_exists($file) ? date('d/m/Y H:i', filemtime($file)) : '-',
        ]);
    }
}
