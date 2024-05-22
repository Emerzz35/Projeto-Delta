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
            ->get()
            ->map(function($produto) {
                $produto->preco_com_desconto = $produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO;
                return $produto;
            })
            ->map(function($produto) {
             if($produto->PRODUTO_DESCONTO>0){   
                $produto->porcentagem_desconto = ($produto->PRODUTO_DESCONTO /  $produto->PRODUTO_PRECO)*100;
                return $produto;
            }
            else{
                $produto->porcentagem_desconto = 0;
                return $produto;
            }
            });

        $categorias = Categoria::all();
           
        return view('produto.index')
            ->with('produtos', $produtos)
            ->with('categorias', $categorias);
    }
    function show(Produto $produto){
        $produtos = Produto::with('estoque')
        ->whereNot('PRODUTO_ID',$produto->PRODUTO_ID)
        ->where('PRODUTO_ATIVO', 1)
        ->whereHas('estoque', function($query) {
                $query->where('PRODUTO_QTD', '>', 0);
            })
            ->get()
            ->map(function($produto) {
                if($produto->PRODUTO_DESCONTO>0){   
                   $produto->porcentagem_desconto = ($produto->PRODUTO_DESCONTO /  $produto->PRODUTO_PRECO)*100;
                   return $produto;
               }
               else{
                   $produto->porcentagem_desconto = 0;
                   return $produto;
               }
               });
   

        return view('produto.show')
            ->with('produto', $produto)
            ->with('produtos', $produtos);
    }
    
}
