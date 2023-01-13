<?php

use Illuminate\Support\Facades\Route;

// Site
use App\Http\Controllers\Site\PrincipalController;
use App\Http\Controllers\Site\ContatoController;
use App\Http\Controllers\Site\SobreNosController;
use App\Http\Controllers\Site\LoginController;

// App
use App\Http\Controllers\App\HomeController;
use App\Http\Controllers\App\FornecedorController;
use App\Http\Controllers\App\ProdutoController;
use App\Http\Controllers\App\ProdutoDetalheController;
use App\Http\Controllers\App\ClienteController;
use App\Http\Controllers\App\PedidoController;
use App\Http\Controllers\App\PedidoProdutoController;
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

//parâmetro 'erro' se torna opcional com o uso de '?' à direita
Route::get('/login/{erro?}', [LoginController::class, 'index'])
        ->name('site.login');
Route::post('/login', [LoginController::class, 'autenticar'])
        ->name('site.login');

// encadeando os middlewares na ordem esquerda -> direita
Route::middleware('autenticacao:padrao,visitante,p3,p4')
    ->prefix('/app')->group(function(){
        Route::get('/home', [HomeController::class, 'index'])->name('app.home');
        Route::get('/sair', [LoginController::class, 'sair'])->name('app.sair');
        
        Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('app.fornecedor');
        Route::get('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
        Route::post('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
        Route::get('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
        Route::post('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
        Route::get('/fornecedor/editar/{id}', [FornecedorController::class, 'editar'])->name('app.fornecedor.editar');
        Route::post('/fornecedor/atualizar', [FornecedorController::class, 'atualizar'])->name('app.fornecedor.atualizar');
        Route::get('/fornecedor/excluir/{id}', [FornecedorController::class, 'excluir'])->name('app.fornecedor.excluir');

        // Devido o ProdutoController ter sido criado especificando a --model=Produto, o Laravel definiu o parametro para 'produto'
        // que ao decorrer do desenvolvimento do projeto do curso foi modificado para 'item'
        Route::resource('/produto', ProdutoController::class)->parameters(['produto' => 'item']);
        
        //rota desativada: Route::resource('/produto-detalhe', ProdutoDetalheController::class)->parameters(['produto_detalhe' => 'item_detalhe']);
        
        // Foi necessário desativar a rota /produto-detalhe para usar o parâmetro item_detalhe recebendo o objeto ItemDetalhe $itemDetalhe na ProdutoDetalheController
        Route::resource('/item-detalhe', ProdutoDetalheController::class);

        // Os Controllers dessas models abaixo foram criados especificando as respectivas models ex: 'php artisan make:controller PedidoController --model=Pedido'
        Route::resource('/cliente', ClienteController::class);
        Route::resource('/pedido', PedidoController::class);
        
        //Route::resource('/pedido-produto', PedidoProdutoController::class);
        Route::get('/pedido-produto/create/{pedido}', [PedidoProdutoController::class, 'create'])->name('pedido-produto.create');
        Route::post('/pedido-produto/store/{pedido}', [PedidoProdutoController::class, 'store'])->name('pedido-produto.store');
        Route::delete('pedido-produto.destroy/{pedido}/{produto}', [PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
    });

Route::fallback(function() {
        echo "A rota acessada não existe. <a href='".route('site.index')."'>Clique aqui</a> para voltar a página inicial.";
    });
