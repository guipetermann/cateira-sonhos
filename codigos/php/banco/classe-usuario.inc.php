<?php

class Usuario
{
	public $email;
	public $nome;
	public $senha;

	function receberDadosFormulario($conexao)
	{
		$email 	= trim($conexao->escape_string($_POST["email-usuario"]));
		$nome 	= trim($conexao->escape_string($_POST["nome-usuario"]));
		$senha 	= trim($conexao->escape_string($_POST["senha-usuario"]));

		$this->nome 	 = $nome;
		$this->email 	 = $email;
		$this->senha	 = $senha;
	}

	function cadastrar($conexao, $nomeDaTabela1)
	{
		$sql = "INSERT $nomeDaTabela1 VALUES(
		
		'$this->email',
		'$this->nome',
		'$this->senha')";

		$resultado = $conexao->query($sql) or exit($conexao->error);
	}
	function login($conexao, $nomeDaTabela1)
	{
		$email 	= trim($conexao->escape_string($_POST["email"]));
		$senha 	= trim($conexao->escape_string($_POST["senha"]));
		$sql ="SELECT email from $nomeDaTabela1 WHERE email = '$email' AND senha='$senha'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		if($conexao->affected_rows == 0)
			{
				return false;
				session_destroy();
			}else
			{
				return true;
			}
	}
	function retornaNome($conexao, $nomeDaTabela1){
		$email = trim($conexao ->escape_string($_SESSION["email"]));
		$sql = "SELECT nome from $nomeDaTabela1 WHERE email = '$email'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		if($conexao->affected_rows == 0)
		{

				return false;
		}else
		{
				//usuario foi encontrado
				$registro = $resultado->fetch_array();
				$nome = $registro[0];
				$nome = htmlentities($nome, ENT_QUOTES,"UTF-8");
				return $nome;
		}
	}
	function retornaEmail($conexao, $nomeDaTabela1){
		$email = trim($conexao ->escape_string($_SESSION["email"]));
		$sql = "SELECT email from $nomeDaTabela1 WHERE email = '$email'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		if($conexao->affected_rows == 0)
		{

				return false;
		}else
		{
				//usuario foi encontrado
				$registro = $resultado->fetch_array();
				$nome = $registro[0];
				$nome = htmlentities($nome, ENT_QUOTES,"UTF-8");
				return $nome;
		}
	}
	function retornaSenha($conexao, $nomeDaTabela1){
		$email = trim($conexao ->escape_string($_SESSION["email"]));
		$sql ="SELECT senha from $nomeDaTabela1 WHERE email = '$email'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		if($conexao->affected_rows == 0)
		{

				return false;
		}else
		{
				//usuario foi encontrado
				$registro = $resultado->fetch_array();
				$nome = $registro[0];
				$nome = htmlentities($nome, ENT_QUOTES,"UTF-8");
				return $nome;
		}

	}

	function atualizaNome($conexao, $nomeDaTabela1){
		$email = trim($conexao ->escape_string($_SESSION["email"]));
		$novoNome = trim($conexao->escape_string($_POST["novoNome"]));
		$sql="UPDATE $nomeDaTabela1 SET nome = '$novoNome' WHERE email ='$email'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		if ($conexao->query($sql)) {
    		exit("Atualizado com sucesso!");
		}

	}
	function atualizaEmail($conexao, $nomeDaTabela1){
		$email = trim($conexao ->escape_string($_SESSION["email"]));
		$novoEmail = trim($conexao->escape_string($_POST["novoEmail"]));
		$sql="UPDATE $nomeDaTabela1 SET email = '$email' WHERE email ='$email'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		if ($conexao->query($sql)) {
    		exit("Atualizado com sucesso!");
		}

	}
	function atualizaSenha($conexao, $nomeDaTabela1){
		$email = trim($conexao ->escape_string($_SESSION["email"]));
		$novaSenha = trim($conexao->escape_string($_POST["novaSenha"]));
		$sql="UPDATE $nomeDaTabela1 SET senha = '$novaSenha' WHERE email ='$email'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		if ($conexao->query($sql)) {
    		exit("Atualizado com sucesso!");
		}
	}

}


?>
