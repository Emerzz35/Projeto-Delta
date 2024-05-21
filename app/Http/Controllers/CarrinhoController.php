<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{
    function show(){
        $itens = Carrinho::where('USUARIO_ID', Auth::user()->USUARIO_ID)
            ->where('ITEM_QTD', '>', 0)
            ->get();

        $enderecos = Endereco::where('USUARIO_ID', Auth::user()->USUARIO_ID)
            ->get();

        // Calcula o preço total
        $precoTotal = $itens->sum(function($item) {
            return $item->ITEM_QTD * $item->Produto->PRODUTO_PRECO;
        });

        return view('carrinho')
            ->with('itens', $itens)
            ->with('enderecos', $enderecos)
            ->with('precoTotal', $precoTotal);
    }
    public function store(Produto $produto)
    {
        Carrinho::create([
            'USUARIO_ID' => Auth()->user()->USUARIO_ID,
            'PRODUTO_ID' => $produto->PRODUTO_ID,
            'ITEM_QTD' => 1
        ]);
        return back();
    }
    public function delete(Produto $produto)
    {
        $item = Carrinho::where('USUARIO_ID',Auth()->user()->USUARIO_ID)->where('PRODUTO_ID', $produto->PRODUTO_ID);
        $item->update([
            'ITEM_QTD' => 0
        ]);
        return back();
    }
    public function remover(Produto $produto)
    {
        $item = Carrinho::where('USUARIO_ID',Auth()->user()->USUARIO_ID)->where('PRODUTO_ID', $produto->PRODUTO_ID);
        $total = $item->first()->ITEM_QTD -1;
        $item->update([
            'ITEM_QTD' => $total
        ]);
        return back();
    }
    public function adicionar(Produto $produto)
    {
        $item = Carrinho::where('USUARIO_ID',Auth()->user()->USUARIO_ID)->where('PRODUTO_ID', $produto->PRODUTO_ID);
        $total = $item->first()->ITEM_QTD +1;
        $item->update([
            'ITEM_QTD' => $total
        ]);
        return back();
    }
}

