<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Estoque;

class ProdutoController extends Controller
{
    function index(){
        $produtos = Produto::with('estoque')
            ->where('PRODUTO_ATIVO', 1)
            ->whereHas('estoque', function($query) {
                $query->where('PRODUTO_QTD', '>', 0);
            })
            ->get();
        $categorias = Categoria::all();

        return view('produto.index')
            ->with('produtos', $produtos)
            ->with('categorias', $categorias);
    }
    function show(Produto $produto){
        $produtos = Produto::all();
        return view('produto.show')
            ->with('produto', $produto)
            ->with('produtos', $produtos);
    }
    
}
