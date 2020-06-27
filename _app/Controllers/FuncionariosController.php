<?php

use _app\Models\Funcionarios;
use Firebase\JWT\JWT;
use Slim\Psr7\Response;
include_once('_app/DAO/FuncionariosDAO.php');

class FuncionariosController
{   
    private $secretKey = "rafaelcosta";

    public function listar( $request,  $response, $args)
    {
        $dao= new FuncionariosDAO;
        $funcionario = $dao->listar();
        $funcionario = json_encode($funcionario);
        $response->getBody()->write($funcionario);
        return $response;
    }
        
    
    public function inserir($request, $response, $args)
    {
        //Adicione nome e preço no request (formato JSON)
        $dao = new FuncionariosDAO;
        $data = $request->getParsedBody();
        $funcionario = new Funcionarios(null,$data['nome'],$data['usuario'],$data['senha']);
        $funcionario = $dao->inserir($funcionario);
    
        $response->getBody()->write("Cadastro de {$data['nome']} realizado!");
        return $response;
    }
    
    
    public function atualizar($request, $response, $args)
    {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $funcionario = new Funcionarios($id, $data['nome'], $data['usuario'], $data['senha']);
    
        $dao = new FuncionariosDAO;
        $funcionario = $dao->atualizar($funcionario);
    
        $response->getBody()->write("Atualização de {$data['nome']} realizada!");
        return $response->withStatus(201);
    }
    
    public function deletar($request, $response, $args)
    {
        $id = $args['id'];
    
        $dao = new FuncionariosDAO;
        $funcionario = $dao->deletar($id);
    
        $response->getBody()->write('Funcionario Deletado!');
        return $response;
    }

    public function autenticar($request, $response, $args){
        $user = $request->getParsedBody();
        
        $dao= new FuncionariosDAO;    
        $usuario = $dao->buscarPorLogin($user['usuario']);

        $senhaEnc = $usuario->senha;
        $senhaUsu = $user['senha'];

        if(password_verify($senhaUsu, $senhaEnc))
        {
            $token = array(
                'user' => strval($usuario->id),
                'nome' => $usuario->nome
            );
            $jwt = JWT::encode($token, $this->secretKey);
            $response->getBody()->write("Token: {$jwt}");
            $response->withStatus(302);
            return $response;
        }
        else
            return $response->withStatus(401);
    }

    public function validarToken($request, $handler)
    {
        $response = new Response();
        $token = $request->getHeader('Authorization');
        
        if($token && $token[0])
        {
            try {
                $decoded = JWT::decode($token[0], $this->secretKey, array('HS256'));

                if($decoded){
                    $response = $handler->handle($request);
                    return($response);
                }
            } catch(Exception $error) {
                $response->withStatus(401);
                return $response;
            }
        }
        $response->withStatus(401);
        return $response;
    }        
}