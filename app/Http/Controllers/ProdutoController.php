<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

class ProdutoController extends Controller
{
    function index(){
        return view('produto.index')
            ->with('produtos',Produto::all())
            ->with('categorias',Categoria::all());
    }
    function show(Produto $produto){
        $produtos = Produto::all();
        return view('produto.show')
            ->with('produto', $produto)
            ->with('produtos', $produtos);
    }
    
}
