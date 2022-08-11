<?php

use Illuminate\Support\Facades\Route;

// Site
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\SobreNosController;

// App
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PrincipalController::class, 'principal'])->name('site.index');

Route::get('/principal', [PrincipalController::class, 'principal'])->name('site.principal');
Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos');

Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');

Route::get('/login', function(){ return 'login'; })->name('site.home');

Route::prefix('/app')->group(function(){
    Route::get('/produtos', function(){ return 'produtos'; })->name('app.produtos');
    Route::get('/clientes', function(){ return 'clientes'; })->name('app.clientes');
    Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('app.fornecedores');
});

Route::fallback(function() {
    echo "A rota acessada não existe. <a href='".route('site.index')."'>Clique aqui</a> para voltar a página inicial.";
});
