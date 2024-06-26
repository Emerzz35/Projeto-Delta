<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;

class ProdutoController extends Controller
{
    public function index(){
        $produtos = $this->getProdutos();
        $categorias = Categoria::all();
           
        return view('produto.index')
            ->with('produtos', $produtos)
            ->with('categorias', $categorias);
    }

    public function show(Produto $produto){
        $produtos = $this->getProdutos();
        
        // Aplicar o cálculo de desconto ao produto atual
        $produto = $this->calcularDesconto($produto);


        return view('produto.show')
            ->with('produto', $produto)
            ->with('produtos', $produtos);
    }

    public function FiltroCategoria($categoriaId)
    {
        $produtos = $this->getProdutos()
            ->where('CATEGORIA_ID', $categoriaId);
        $categorias = Categoria::all();

        return view('produto.index-filtro')
            ->with('produtos', $produtos)
            ->with('categorias', $categorias);
    }

    public function FiltroPesquisa(Request $request)
    {
        $query = $request->input('query');
        $produtos = Produto::with('estoque')
            ->where('PRODUTO_ATIVO', 1)
            ->whereHas('estoque', function($query) {
                $query->where('PRODUTO_QTD', '>', 0);
            })
            ->where('PRODUTO_NOME', 'like', '%' . $query . '%')
            ->get()
            ->map(function($produto) {
                return $this->calcularDesconto($produto);
            });

        $categorias = Categoria::all();

        return view('produto.index-filtro')
            ->with('produtos', $produtos)
            ->with('categorias', $categorias);
    }

    public function FiltroOfertas()
    {
        $produtos = $this->getProdutos()
            ->sortByDesc('porcentagem_desconto'); // Use sortByDesc para ordenar a coleção
        $categorias = Categoria::all();
        
        return view('produto.index')
            ->with('produtos', $produtos)
            ->with('categorias', $categorias);
    }
    
    private function getProdutos()
    {
        return Produto::with('estoque')
            ->where('PRODUTO_ATIVO', 1)
            ->whereHas('estoque', function($query) {
                $query->where('PRODUTO_QTD', '>', 0);
            })
            ->get()
            ->map(function($produto) {
                return $this->calcularDesconto($produto);
            });
    }

    private function calcularDesconto($produto)
    {
        $produto->preco_com_desconto = $produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO;
        if ($produto->PRODUTO_DESCONTO > 0) {
            $produto->porcentagem_desconto = ($produto->PRODUTO_DESCONTO / $produto->PRODUTO_PRECO) * 100;
        } else {
            $produto->porcentagem_desconto = 0;
        }
        return $produto;
    }
}
