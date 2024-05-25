<?php

use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\SobreController;
use App\Models\Endereco;



Route::get('/', [ProdutoController::class, 'index'])->name('produto.index');
Route::get('/produto/{produto}',[ProdutoController::class,'show'])->name('produto.show');
Route::get('/produtos/{categoria}', [ProdutoController::class, 'FiltroCategoria'])->name('produto.filtro.categoria');
Route::post('/produtos/pesquisa', [ProdutoController::class, 'FiltroPesquisa'])->name('produto.filtro-pesquisa');
Route::get('/ofertas', [ProdutoController::class, 'FiltroOfertas'])->name('produto.filtro-ofertas');
Route::get('/sobre',[SobreController::class,'Sobre'])->name('sobre');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/carrinho',[CarrinhoController::class, 'show'])->name('carrinho.show');
    Route::get('/carrinho/{produto}/delete',[CarrinhoController::class,'delete'])->name('carrinho.delete');
    Route::get('/carrinho/{produto}/remover',[CarrinhoController::class,'remover'])->name('carrinho.remover');
    Route::get('/carrinho/{produto}/adicionar',[CarrinhoController::class,'adicionar'])->name('carrinho.adicionar');
    Route::get('/carrinho/{produto}',[CarrinhoController::class, 'store'])->name('carrinho.store');
    Route::get('/endereco',[EnderecoController::class,'create'])->name('endereco.create');
    Route::post('/endereco',[EnderecoController::class,'store'])->name('endereco.store');
    Route::put('/endereco/{endereco}',[EnderecoController::class,'update'])->name('endereco.update');
    Route::get('/endereco/{endereco}/delete',[EnderecoController::class,'delete'])->name('endereco.delete');
    Route::post('/pedido',[PedidoController::class,'store'])->name('pedido.store');
    
    
    
});

require __DIR__.'/auth.php';
