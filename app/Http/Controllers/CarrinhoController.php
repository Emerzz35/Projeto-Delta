<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{
    function show(){
        return view('carrinho')
        ->with('itens',Carrinho::where('USUARIO_ID', Auth::user()->USUARIO_ID)->where('ITEM_QTD','>','0')->get());

    }
    public function store(Produto $produto)
    {
        Carrinho::create([
            'USUARIO_ID' => Auth()->user()->USUARIO_ID,
            'PRODUTO_ID' => $produto->PRODUTO_ID,
            'ITEM_QTD' => 1
        ]);
    }
    public function delete(Produto $produto)
    {
        $item = Carrinho::where('USUARIO_ID',Auth()->user()->USUARIO_ID)->where('PRODUTO_ID', $produto->PRODUTO_ID);
        $item->update([
            'ITEM_QTD' => 0
        ]);
    }
    public function remover(Produto $produto)
    {
        $item = Carrinho::where('USUARIO_ID',Auth()->user()->USUARIO_ID)->where('PRODUTO_ID', $produto->PRODUTO_ID);
        $total = $item->first()->ITEM_QTD -1;
        $item->update([
            'ITEM_QTD' => $total
        ]);
    }
}

