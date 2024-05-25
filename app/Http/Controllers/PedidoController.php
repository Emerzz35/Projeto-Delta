<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Carrinho;
use App\Models\PedidoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        $pedido = Pedido::create([
            'USUARIO_ID' => Auth()->user()->USUARIO_ID,
            'STATUS_ID' => 1,
            'PEDIDO_DATA' => date("Y-m-d"),
            'ENDERECO_ID' => $request->ENDERECO_NOME,
        ]);

        // BUSCA O CARRINHO DO USUARIO
        $itensCarrinho = Carrinho::where('USUARIO_ID', Auth::user()->USUARIO_ID)
            ->where('ITEM_QTD', '>', 0)
            ->get(); 
        // FOR PARA ITEM DO CARRINHO > 0 UNIDADES
        foreach($itensCarrinho as $itemCarrinho){
            // CRIA NA TABELA DE PEDIDO ITEM
            PedidoItem::create([
                'PRODUTO_ID' => $itemCarrinho->PRODUTO_ID,
                'PEDIDO_ID' => $pedido->PEDIDO_ID,
                'ITEM_QTD' => $itemCarrinho->ITEM_QTD,
                'ITEM_PRECO' => $itemCarrinho->Produto->PRODUTO_PRECO
            ]);

            
            
           
            
        }
         // ZERA O CARRINHO DO USUARIO
        Carrinho::where('USUARIO_ID', Auth::user()->USUARIO_ID)
        ->update([
            'ITEM_QTD' => 0
        ]);
        return back();
    }
}
