<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></p>



## App Super Gestão
#### Projeto é parte do estudo do curso de Desenvolvimento Web Avançado 2022 com PHP, Laravel e Vue.JS

O objetivo deste estudo é compreender e praticar conceitos do Desenvolvimento web com Laravel utilizando boas práticas


### Conceitos abordados neste projeto:

#### Configurar o ambiente de desenvolvimento nos sistemas operacionais Windows, Linux Ubuntu e OSX.
Ferramentas e tecnologias utilizadas:
Servidor: Laragon
Banco de dados: MySQL
IDE de desenvolvimento: Microsoft VS Code
SGBD: HeidiSQL Portable

#### Trabalhar com rotas, grupos e com os verbos HTTP Get, Post, Delete, Put e Patch.
<p>O método Route::resource é um controlador RESTful que gera todas as rotas básicas necessárias para um aplicativo e pode ser facilmente manipulado usando a classe do controlador.</p>
```
   // controlador RESTful
   Route::resource('/pedido-produto', PedidoProdutoController::class);
        
   // rotas personalizadas
   Route::get('/pedido-produto/create/{pedido}', [PedidoProdutoController::class, 'create'])->name('pedido-produto.create');
   Route::post('/pedido-produto/store/{pedido}', [PedidoProdutoController::class, 'store'])->name('pedido-produto.store');
   Route::delete('pedido-produto.destroy/{pedido}/{produto}', [PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
```

#### Trabalhar com o motor de renderização de views Blade
```
basico.blade.php
<body>
        @include('app.layouts._partials.topo')
        @yield('conteudo')
</body>
```

create.blade.php de Produto
```
    @extends('app.layouts.basico')

    @section('titulo', 'Adicionar Produto')

    @section('conteudo')
    
    @component('app.produto._components.form_create_edit', ['unidades' => $unidades, 'fornecedores' => $fornecedores])
    @endcomponent
```

#### Trabalhar com o desenvolvimento incremental de bancos de dados relacionais utilizando Migrations
Trecho da migration que cria a tabela Clientes e Pedidos no banco de dados com suas respectivas relações.
```
Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->string('telefone', 16);
            $table->string('email', 200);
            $table->string('endereco',255);
            $table->timestamps();
        });

        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
```

#### Criar Seeders e Factories para popular tabelas
SiteContatoFactory.php
```
protected $model = SiteContato::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'telefone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->email(),
            'motivo_contatos_id' => $this->faker->numberBetween(1,3),
            'mensagem' => $this->faker->text(200)
        ];
    }
```

SiteContatoSeeder.php
```
public function run()
    {

        /*
        $contato = new SiteContato();
        $contato->nome = 'Sistema SG';
        $contato->telefone = '(11) 99999-8888';
        $contato->email = 'contato@sg.com.br';
        $contato->motivo_contato = 1;
        $contato->mensagem = 'Seja bem-vindo ao sistema Super Gestão';
        $contato->save();
        */

        SiteContato::factory(5)->create();
    }
```

#### Trabalhar com o console Tinker
```
    >>> use App\Models\Cliente;
    >>> Cliente::create(['nome'=>'Paulo', 'telefone'=>'(65) 99248-1775', 'email'=>'paulocaetanomt88@gmail.com', 'endereco'=>'Rua A, Casa B, Quadra C']);
    
    => App\Models\Cliente {#4572
     nome: "Paulo",
     telefone: "(65) 99248-1775",
     email: "paulocaetanomt88@gmail.com",
     endereco: "Rua A, Casa B, Quadra C",
     updated_at: "2023-01-13 22:59:02",
     created_at: "2023-01-13 22:59:02",
     id: 6,
   }
```

#### Como manipular e validar formulários
O Laravel usa a tag @csrf em todos os formulários (views) para gerar um token que é exigido nos controllers (backend) para validação de segurança
Mesmo usando o método POST na tag <form>, é possível definir o método que será enviado para a rota, como: PUT, PATCH e DELETE, através da tag @method[]
A validação dos formulários pode ser feita pelo método validate() do objeto $request enviado via POST

#### Como interceptar requisições e respostas utilizando Middlewares
```
	$ip = $_SERVER['REMOTE_ADDR'];
        $rota = $request->server->get('REQUEST_URI');

        // Registrando o logo de acesso no banco de dados
        LogAcesso::create(['log' => 'IP: '.$ip.' requisitou a rota '.$rota]);
```

#### Como lidar com o padrão de arquitetura MVC (Model, View e Controller)
Exemplo de MVC para Cliente
#### Model:
Classe que mapeia a tabela de clientes no banco de dados:
App/Models/Cliente.php

#### View:
Formulário para listar clientes:
resource/views/app/cliente/index.blade.php

Formulário para cadastrar clientes:
resource/views/app/cliente/create.blade.php

Formulário para editar um cliente específico:
resource/views/app/cliente/edit.blade.php

Formulário para exibir um cliente específico:
resource/views/app/cliente/show.blade.php

#### Controller:
camada com funções que conectam as views com a camada da model:
App/Http/Controllers/ClienteController.php

#### Como implementar as operações CRUD utilizando o Eloquent ORM
exemplos de operações de CRUD com ORM:
```
	SELECT de todos os Clientes com paginação
	$clientes = Cliente::paginate();

	Cria uma nova instância de Cliente
	$cliente = new Cliente();

	Cria um registro no banco de dados recebendo os dados vindos do $request
	$cliente->create($request->all());

	Atualiza um registro no banco de dados recebendo os dados vindos do $request
	$cliente->update($request->all());

	Deleta no banco de dados o registro vinculado a instância de cliente atual
	$cliente->delete();
```
### Conclusão
<p>O Laravel é um excelente framework que contém estruturas, configurações e funções completas e flexíveis para o desenvolvimento web. Desta forma, facilita e agiliza muito o trabalho de um desenvolvedor, web seja Frontend ou Backend.</p>
<p>Iniciando pelas camadas visíveis ao usuário final (as Views), neste projeto, pude implementar facilmente o Tailwind CSS para estilizar as telas e aplicar paginação nos conjuntos de dados que podem ser extensos dependendo do banco de dados.</p>
<p>Quando desenvolvi o backend na camada de dados, com as migrations pude controlar o que fazer e desfazer de alterações nas tabelas do banco sem necessidade de preocupar com a sintaxe do SGBD escolhido (MySQL). Nas models defini quais campos podem ser preenchidos em massa, métodos de relacionamento entre as tabelas e mapear tabela diferente da convenção de nomes.</p>
<p>Com os Controllers pude desenvolver de forma organizada e prática, com orientação a objetos, os métodos de processamento, validação, inserção e recuperação de dados.</p>

 ### Considerações finais
<p>O conteúdo do curso é apresentado usando a versão 7, mas para aprender já com as funções modernas do framework optei por fazer com a versão 9 do Laravel, pesquisando e adaptando sempre que necessário.</p>
<p>Algumas funcionalidades de views complementares ficaram por fazer, mas o objetivo deste estudo era conhecer e desenvolver as principais funcionalidades do Laravel.</p>
