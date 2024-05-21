<?php

use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\SobreController;
use App\Models\Endereco;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [ProdutoController::class, 'index'])->name('produto.index');
Route::get('/categoria',[CategoriaController::class,'index'])->name('categoria.index');
Route::get('/produto/{produto}',[ProdutoController::class,'show'])->name('produto.show');
Route::get('/Sobre',[SobreController::class,'Sobre'])->name('Sobre');





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
    
    
});

require __DIR__.'/auth.php';
