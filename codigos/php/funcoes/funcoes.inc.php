<?php

require_once (__DIR__.'/../banco/criar-classe-banco-de-dados.inc.php');
require_once (__DIR__.'/../banco/classe-usuario.inc.php');
require_once(__DIR__.'/../banco/classe-metas.inc.php');
require_once(__DIR__.'/../banco/classe-historico.inc.php');
function login(){

$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas","historico");

$conexao = $banco->criarConexao();

$banco->criarBanco($conexao);

$banco->abrirBanco($conexao);

$banco->definirCharset($conexao);

$banco->criarTabelas($conexao);

$usuario  = new Usuario();

		$teste = $usuario->login($conexao, $banco->nomeDaTabela1); //verifica se login é permitido
		if($teste){
			session_start();
			$email = $_POST["email"];
			$_SESSION["email"] = $email; 
			header("Location: paginaUsuario.php");
		}else
		{
			echo("Algo deu errado, tente novamente");
		}
	$banco->desconectar($conexao); //desconecta do banco
}
function cadastrar(){

$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas","historico");

$conexao = $banco->criarConexao();

$banco->criarBanco($conexao);

$banco->abrirBanco($conexao);

$banco->definirCharset($conexao);

$banco->criarTabelas($conexao);

$usuario  = new Usuario();
		$usuario->receberDadosFormulario($conexao);
		$usuario->cadastrar($conexao, $banco->nomeDaTabela1);
		echo"<p> Dados do usuario cadastrado com sucesso.</p>";
	$banco->desconectar($conexao);
}

function nome(){
	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas","historico");
	$conexao = $banco->criarConexao();
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);
	$usuario  = new Usuario();

	$nome = $usuario->retornaNome($conexao, $banco->nomeDaTabela1);
	return $nome;
}
function email(){
	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas","historico");
	$conexao = $banco->criarConexao();
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);
	$usuario  = new Usuario();

	$email = $usuario->retornaEmail($conexao, $banco->nomeDaTabela1);
	return $email;
}
function senha(){
	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas","historico");
	$conexao = $banco->criarConexao();
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);
	$usuario  = new Usuario();

	$senha = $usuario->retornaSenha($conexao, $banco->nomeDaTabela1);
	return $senha;
}
function testeUsuario(){

	
	if(!$_SESSION['email']){
		
		header("Location: home.php");
	}else
	{
		$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas","historico");
		$conexao = $banco->criarConexao();
		$banco->abrirBanco($conexao);
		$banco->definirCharset($conexao);
		$usuario  = new Usuario();
		$email = email();
		if($email){//se sessão (preenchida no cadastroLogin) não estiver vazia faça:
		//$email =  $email;//pegando o email guardado em cadastroLogin
    		$nome = $usuario->retornaNome($conexao, $banco->nomeDaTabela1);//pegando o nome do usuario pelo email
    		
    		if($nome == false){
			//header("Location: home.php"); //se o nome não existir ele volta pra pagina de login
    			return false;
    		}else
    		{
    			return true;
   			}

			}else
			{
			}
	
    }

	
}
function cadastrarMeta(){
	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas","historico");
    $conexao = $banco->criarConexao();
    $banco->criarBanco($conexao);
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);
	$banco->criarTabelas($conexao);
	$meta  = new Metas();
	$meta->receberDadosFormulario($conexao);
	$teste =$meta->cadastrar($conexao, $banco->nomeDaTabela2);
		if($teste){
			echo("<script> alert('Meta cadastrada com sucesso')</script>");	
		}else{
			echo("<script> alert('Desculpe aconteceu um erro, lembre-se não é possivel cadastrar duas metas com o mesmo nome')</script>");
		}
		
	$banco->desconectar($conexao);
}
function mostraMetas(){
		$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas","historico");
    $conexao = $banco->criarConexao();
    $banco->criarBanco($conexao);
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);

	$meta  = new Metas();
	$historico = new Historico();
	$meta->mostrarMetas($conexao, $banco->nomeDaTabela2);
}
function atualizaValorAtual(){
	//essa função é para calcular o que tem no historico 
	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas","historico");
    $conexao = $banco->criarConexao();
    $banco->criarBanco($conexao);
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);

	$meta = new Metas();

	$meta->atualizaValorAtual($conexao, $banco->nomeDaTabela2);

}
function cadastrarHistorico(){
	//adicionar valor na meta
	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas","historico");
    $conexao = $banco->criarConexao();
    $banco->criarBanco($conexao);
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);

	$historico = new Historico();
	$historico->receberDadosFormulario($conexao);
	$historico->cadastrar($conexao, $banco->nomeDaTabela3);
	header("Location: paginaUsuario.php");


	
}
function mostrarHistorico(){
	
	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas","historico");
    $conexao = $banco->criarConexao();
    $banco->criarBanco($conexao);
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);
	$historico = new Historico();

	$historico->mostrar($conexao);
}
function apagarMeta(){
	//está faltando pedido de confirmação!

	$banco = new BancoDeDados("localhost", "root","", "CTDS", "usuario","metas","historico");
    $conexao = $banco->criarConexao();
    $banco->criarBanco($conexao);
	$banco->abrirBanco($conexao);
	$banco->definirCharset($conexao);
	$meta = new Metas();
	if(isset($_GET['apagar'])){
		ob_start();
		$meta->apagarMeta($conexao, $banco->nomeDaTabela2);
		ob_end_flush();
		header("Location: paginaUsuario.php");
	}
		
}









?>