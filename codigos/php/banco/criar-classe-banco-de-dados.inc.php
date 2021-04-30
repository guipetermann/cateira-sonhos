<?php
class BancoDeDados
{   
	public $servidor;
	public $usuario;
	public $senha;
	public $nomeDoBanco;
	public $nomeDaTabela1;
	public $nomeDaTabela2;
	public $nomeDaTabela3;


# 2° CONSTRUTOR DA CLASSE. 
#OBS: CONFIRMAR SEMPRE A QTD DOS PARAMETROS.
	function __construct( $servidorBanco, $usuarioBanco, $senhaAcesso, $nomeBanco, $nomeDaTabela1, $nomeDaTabela2, $nomeDaTabela3)
	{
		$this->servidor 	= $servidorBanco;
		$this->usuario		= $usuarioBanco;
		$this->senha 		= $senhaAcesso;
		$this->nomeDoBanco	= $nomeBanco;
		$this->nomeDaTabela1 = $nomeDaTabela1;
		$this->nomeDaTabela2 = $nomeDaTabela2;
		$this->nomeDaTabela3 = $nomeDaTabela3;
		
	}
# 3° CRIAR O MÉTODO QUE ESTABELECE  A LIGAÇÃO ENTRE O NOSSO CÓDIGO PHP E O MYSQL.
	function criarConexao()
	{
		$conexao = new mysqli($this->servidor, $this->usuario, $this->senha) or exit($conexao->error);
		return $conexao;
	}
# 4° MÉTODO PARA CRIAÇÃO FÍSICA DO BANCO DE DADOS NO SERVIDOR.
	function criarBanco($conexao)
	{								     #USE PARA ABRIR O BANCO DE DADOS.
		$sql = "CREATE DATABASE IF NOT EXISTS $this->nomeDoBanco";                 
							 #CONSULTA.
		$resultado = $conexao->query($sql) or exit($conexao->error);
	}
# 5° MÉTODO P/ SELECIONAR O BANCO DE DADOS.
	function abrirBanco($conexao)
	{
		$conexao->select_db($this->nomeDoBanco);
	}
# 6° MÉTODO P/ DEFINIR NO BANCO DE DADOS, O UTF-8 COMO O CONJUNTO DE CARACTERES-PADRÃO.
	function definirCharset($conexao)
	{
		$conexao->set_charset("utf8");
	}	
# 7° MÉTODO P/ CRIAR AS TABELAS NO BANCO DE DADOS.
	function criarTabelas($conexao)
	{	#OBS: EVITAR CARACTERES ACENTUADO P/  MONTAR AS TABELAS .
		//CRIANDO A 1ª TABELA USUARIO.
		$sql = "CREATE TABLE IF NOT EXISTS $this->nomeDaTabela1(
				email VARCHAR(70) PRIMARY KEY,
				nome VARCHAR(300),
			    senha VARCHAR(8)) ENGINE=innoDB";

		$resultado = $conexao->query($sql) or exit($conexao->error);
		
		$sql = "CREATE TABLE IF NOT EXISTS $this->nomeDaTabela2(
				id    INT PRIMARY KEY AUTO_INCREMENT,
				nomeMeta VARCHAR(300),
				usuario VARCHAR(70),
				valorTotal DECIMAL(15,2),
				valorAtual DECIMAL(15,2),
				UNIQUE (usuario,nomeMeta),

				FOREIGN KEY (usuario) REFERENCES 
				$this->nomeDaTabela1 (email) ON DELETE CASCADE) 
				ENGINE=innoDB";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		//colocar um id como primary key 
		$sql = "CREATE TABLE IF NOT EXISTS $this->nomeDaTabela3(
				id    INT ,
				data  DATE,
				valor DECIMAL(15,2),

				FOREIGN KEY (id) REFERENCES 
				$this->nomeDaTabela2 (id) ON DELETE CASCADE)  
				ENGINE=innoDB";
		$resultado = $conexao->query($sql) or exit($conexao->error);
	}
# MÉTODO P/ FINALIZAR A CONEXÃO.
	function desconectar($conexao)
	{
		$conexao->close();
	}

}

?>