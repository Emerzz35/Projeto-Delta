<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Produto;
use App\Models\Categoria;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $produtos = $this->getProdutos();
        $categorias = Categoria::all();
            
        // Pode definir a variável de sessão para exibir o modal
        session()->flash('showModal', true);
        return view('produto.index')
        ->with('produtos', $produtos)
            ->with('categorias', $categorias);

    }
    

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('produto.index'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
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
                $produto->preco_com_desconto = $produto->PRODUTO_PRECO - $produto->PRODUTO_DESCONTO;
                if($produto->PRODUTO_DESCONTO > 0){   
                    $produto->porcentagem_desconto = ($produto->PRODUTO_DESCONTO / $produto->PRODUTO_PRECO) * 100;
                } else {
                    $produto->porcentagem_desconto = 0;
                }
                return $produto;
            });
    }
}
