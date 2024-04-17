<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    function index(){
        return view('categoria.index')->with('categorias',Categoria::all());
    }
}
