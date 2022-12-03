<?php

use Illuminate\Support\Facades\Route;

// Site
use App\Http\Controllers\Site\PrincipalController;
use App\Http\Controllers\Site\ContatoController;
use App\Http\Controllers\Site\SobreNosController;

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
Route::middleware(LogAcessoMiddleware::class)
    ->get('/', [PrincipalController::class, 'principal'])
    ->name('site.index');

Route::middleware(LogAcessoMiddleware::class)
    ->get('/principal', [PrincipalController::class, 'principal'])
    ->name('site.principal');
Route::middleware(LogAcessoMiddleware::class)
    ->get('/sobre-nos', [SobreNosController::class, 'sobreNos'])
    ->name('site.sobrenos');

Route::middleware(LogAcessoMiddleware::class)
    ->get('/contato', [ContatoController::class, 'contato'])
    ->name('site.contato');
Route::middleware(LogAcessoMiddleware::class)
    ->post('/contato', [ContatoController::class, 'salvar'])
    ->name('site.contato.salvar');

Route::middleware(LogAcessoMiddleware::class)
    ->get('/login', function(){ return 'login'; })
    ->name('site.home');

Route::middleware(LogAcessoMiddleware::class)
    ->prefix('/app')->group(function(){
        Route::get('/produtos', function(){ return 'produtos'; })->name('app.produtos');
        Route::get('/clientes', function(){ return 'clientes'; })->name('app.clientes');
        Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('app.fornecedores');
    });

Route::fallback(function() {
        echo "A rota acessada não existe. <a href='".route('site.index')."'>Clique aqui</a> para voltar a página inicial.";
    })->middleware(LogAcessoMiddleware::class);
