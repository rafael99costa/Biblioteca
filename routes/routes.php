<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/../_app/Controllers/AutorController.php';
require __DIR__ . '/../_app/Controllers/ClienteController.php';
require __DIR__ . '/../_app/Controllers/FuncionariosController.php';
require __DIR__ . '/../_app/Controllers/LivrosController.php';
require __DIR__ . '/../_app/Controllers/EmprestimoController.php';
require __DIR__ . '/../_app/Controllers/DevolucaoController.php';
require __DIR__ . '/../lib_ext/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();


$app->post('/funcionarios', FuncionariosController::class . ':inserir');
$app->post('/api/auth', FuncionariosController::class . ':autenticar');

$app->group('', function() use ($app) {

    $app->get('/autores', AutorController::class . ':listar');
    $app->post('/autores', AutorController::class . ':inserirA');
    $app->put('/autores/{id}', AutorController::class . ':atualizar');
    $app->delete('/autores/{id}', AutorController::class . ':deletar');

    $app->get('/clientes', ClienteController::class . ':listar');
    $app->post('/clientes', ClienteController::class . ':inserir');
    $app->put('/clientes/{id}', ClienteController::class . ':atualizar');
    $app->delete('/clientes/{id}', ClienteController::class . ':deletar');

    $app->get('/funcionarios', FuncionariosController::class . ':listar');
    $app->put('/funcionarios/{id}', FuncionariosController::class . ':atualizar');
    $app->delete('/funcionarios/{id}', FuncionariosController::class . ':deletar');

    $app->get('/livros', LivrosController::class . ':listar');
    $app->get('/livros/id/{id}', LivrosController::class . ':listarPorId');
    $app->get('/livros/autor/{id}', LivrosController::class . ':listarPorAutor');
    $app->get('/livros/disponiveis', LivrosController::class . ':listarPorDisponiveis');
    $app->get('/livros/nome/{id}', LivrosController::class . ':listarPorNome');
    $app->post('/livros', LivrosController::class . ':inserir');
    $app->put('/livros/{id}', LivrosController::class . ':atualizar');
    $app->delete('/livros/{id}', LivrosController::class . ':deletar');
    
    $app->get('/emprestimo', EmprestimoController::class . ':listar');
    $app->post('/emprestimo', EmprestimoController::class . ':inserir');

    $app->get('/devolucao', DevolucaoController::class . ':listar');
    $app->post('/devolucao', DevolucaoController::class . ':inserir');

})->add('FuncionariosController:validarToken');;

$app->run();