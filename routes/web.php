<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\SobreController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produto', [ProdutoController::class, 'index'])->name('produto.index');
Route::get('/categoria',[CategoriaController::class,'index'])->name('categoria.index');
Route::get('/produto/{produto}',[ProdutoController::class,'show'])->name('produto.show');
Route::get('/Cadastro',[CadastroController::class,'cadastro'])->name('cadastro');
Route::get('/Sobre',[SobreController::class,'Sobre'])->name('Sobre');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
