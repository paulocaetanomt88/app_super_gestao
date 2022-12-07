<?php

use Illuminate\Support\Facades\Route;

// Site
use App\Http\Controllers\Site\PrincipalController;
use App\Http\Controllers\Site\ContatoController;
use App\Http\Controllers\Site\SobreNosController;
use App\Http\Controllers\Site\LoginController;

// App
use App\Http\Controllers\App\FornecedorController;
use App\Http\Controllers\App\ProdutoController;
use App\Http\Controllers\App\ClienteController;
use App\Http\Middleware\LogAcessoMiddleware;

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

// Quando a rota '/' for acessada, o middleware LogAcessoMiddleware interceptará o comando antes de acessar a PrincipalController
Route::get('/', [PrincipalController::class, 'principal'])
    ->name('site.index');

Route::get('/principal', [PrincipalController::class, 'principal'])
    ->name('site.principal');
    
Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])
    ->name('site.sobrenos');

Route::get('/contato', [ContatoController::class, 'contato'])
    ->name('site.contato');
Route::post('/contato', [ContatoController::class, 'salvar'])
    ->name('site.contato.salvar');

Route::get('/login', [LoginController::class, 'index'])
        ->name('site.login');
Route::post('/login', [LoginController::class, 'autenticar'])
        ->name('site.login');

// encadeando os middlewares na ordem esquerda -> direita
Route::middleware('autenticacao:padrao,visitante,p3,p4')
    ->prefix('/app')->group(function(){
        Route::get('/produtos', function(){ return 'produtos'; })->name('app.produtos');
        Route::get('/clientes', function(){ return 'clientes'; })->name('app.clientes');
        Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('app.fornecedores');
    });

Route::fallback(function() {
        echo "A rota acessada não existe. <a href='".route('site.index')."'>Clique aqui</a> para voltar a página inicial.";
    });
