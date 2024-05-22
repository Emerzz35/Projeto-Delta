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
            ->with('Produto')
            ->get()
            ->map(function($item) {
                $produto = $item->Produto;
                $produto->preco_com_desconto = $produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO;
                if ($produto->PRODUTO_DESCONTO > 0) {
                    $produto->porcentagem_desconto = ($produto->PRODUTO_DESCONTO / $produto->PRODUTO_PRECO) * 100;
                } else {
                    $produto->porcentagem_desconto = 0;
                }
                $item->produto = $produto;
                return $item;
            });

        $enderecos = Endereco::where('USUARIO_ID', Auth::user()->USUARIO_ID)
            ->get();

        // Calcula o preço total com desconto
        $precoTotal = $itens->sum(function($item) {
            return $item->ITEM_QTD * $item->Produto->preco_com_desconto;
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

