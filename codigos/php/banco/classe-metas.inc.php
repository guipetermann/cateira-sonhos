<?php

class Metas
{
	public $id;
	public $nomeMeta;
	public $usuario;
	public $valorTotal;
	public $valorAtual;

	

	function receberDadosFormulario($conexao)
	{
		$nome 	= trim($conexao->escape_string($_POST["nome-meta"]));
		$valorTotal 	= trim($conexao->escape_string($_POST["valor-meta"]));
		$valorTotal = str_replace(",",".", str_replace(".","", $valorTotal));
		//tive que usar o replace porque o numero formatado estava dando problema de reconhecer 

		$valorTotal = (double)$valorTotal;
		$usuario = trim($conexao ->escape_string($_SESSION["email"]));

		$this->nomeMeta	= $nome;
		$this->usuario  = $usuario;
		$this->valorTotal = $valorTotal;
		$this->valorAtual = 0;

	}

	function cadastrar($conexao, $nomeDaTabela2)
	{
		$sql = "SELECT nomeMeta 
				FROM  metas 
				WHERE nomeMeta = '$this->nomeMeta' 
				AND usuario = '$this->usuario'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		if($conexao->affected_rows != 0){
			
			return false;

		}else
		{
			$sql = "INSERT $nomeDaTabela2 VALUES(
			null,
			'$this->nomeMeta',
			'$this->usuario',
			'$this->valorTotal',
			'$this->valorAtual')";
			$resultado = $conexao->query($sql) or exit($conexao->error);			
			return true;
		}
	}
	function apagarMeta($conexao, $nomeDaTabela2){
		$idMeta = trim($conexao->escape_string($_GET['apagar']));
		$usuario = trim($conexao ->escape_string($_SESSION["email"]));
		$sql = "DELETE FROM $nomeDaTabela2 WHERE usuario = '$usuario' and id = '$idMeta'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		
	}
	function mostrarMetas($conexao, $nomeDaTabela2){

		$email 	= trim($conexao->escape_string($_SESSION["email"]));

		$sql = "SELECT * FROM $nomeDaTabela2 WHERE usuario = '$email'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		if($conexao->affected_rows == 0){
			echo "<h2>Não existe nenhuma meta, quando alguma for cadastrada vai aparecer aqui</h2>";
		}else
		{
			while($registro = $resultado->fetch_array())
		{
	// LEMBRE-SE: SEGUNRANÇA DA NOSSA APLICAÇÃO É IMPORTANTE: SEMPRE QUE VOCÊ FIZER O PHP RECEBER DADOS DO BANCO DE DADOS, CERTIFIQUE-SE DE UTILIZAR FILTRAGEM ADQUADA, IMPEDINDO QUE SUA APLICAÇÃO FUNCIONE COMO UMA FERRAMENTA DE INVASÃO DA MAQUINA CLIENTE(XSS)
		 $id = htmlentities($registro[0], ENT_QUOTES,"UTF-8");
		 $nome = htmlentities($registro[1], ENT_QUOTES,"UTF-8");//registro["nome"]
		 $valorTotal = htmlentities($registro[3],ENT_QUOTES,"UTF-8") ;
		 $valorAtual = htmlentities($registro[4],ENT_QUOTES,"UTF-8") ;

		 $porcentagem = (100*$valorAtual)/$valorTotal; 
		 $valorAtual = number_format($valorAtual, 2,",", ".");
		 $valorTotal = number_format($valorTotal, 2,",", ".");

			echo "	
			<section class='metas'>
			<div class='titulo-meta'>
			<canvas id='graficoAnimacao' width='600' height='400 class='grafico'></canvas>
				<!--<script type='text/javascript'> desenhaCirculo(300, 200, 100, 'blue',$porcentagem);</script>-->
				
			<h2> $nome </h2>
			</div>
			<div class='conteuo-meta'> 
				<div class='texto-meta'>
					<p>Guardado: R$ $valorAtual</p>
					<p>Meta Final: R$ $valorTotal</p>
				</div>
				<div>
					<!--<img src='../../midias/imagem/caneta.svg' alt='imgCaneta'>-->	
				</div>	
			</div>
			<span class='btn-cadastre'>
				<button name='historico'><a href='historico.php?meta=$id'>Histórico</a></button>
				<button class='apagar' name='apagar'><a href='paginaUsuario.php?apagar=$id'>Apagar</a></button>
				<button class='atualizar' name='atualizar'><a href='atualiza.php?atualizaValor=$id'>Atualizar</a></button>
			</span>
			</section>";

		}
		
		}
	
	}
	function atualizaValorTotal($conexao, $nomeDaTabela2){
		$usuario  =  trim($conexao->escape_string($_SESSION["email"]));
		$valor 	  =  trim($conexao->escape_string($_POST['valor']));
		$idMeta =  trim($conexao->escape_string($_GET['atualizaValor']));

		$sql = "UPDATE metas SET valorTotal = $valor WHERE nomeMeta IN (
				SELECT m.nomeMeta 
				FROM (SELECT nomeMeta FROM metas) m
				WHERE id = '$idMeta' 
				AND email = '$usuario' )";
		$resultado = $conexao->query($sql) or exit($conexao->error);

	}
	function atualizaValorNome($conexao, $nomeDaTabela2){
		$usuario  =  trim($conexao->escape_string($_SESSION["email"]));
		$novoNome =  trim($conexao->escape_string($_POST['nomeMeta']));
		$idMeta =  trim($conexao->escape_string($_GET['atualizaValor']));

		$sql = "UPDATE metas SET nomeMeta = $novoNome WHERE nomeMeta IN (
				SELECT m.nomeMeta 
				FROM (SELECT nomeMeta FROM metas) m
				WHERE nomeMeta = '$idMeta' 
				AND email = '$usuario' )";

		$resultado = $conexao->query($sql) or exit($conexao->error);

	}

	function atualizaValorAtual($conexao, $nomeDaTabela2){
		$usuario = trim($conexao->escape_string($_SESSION["email"]));

		$sql = "SELECT id FROM metas WHERE usuario ='$usuario'";
		$resultado = $conexao->query($sql) or exit($conexao->error);
		while ($registro = $resultado->fetch_array()) {
			$idMeta = htmlentities($registro[0], ENT_QUOTES,"UTF-8");
			$sql = "UPDATE metas SET valorAtual = (select sum(historico.valor) from historico where historico.id = $idMeta) where metas.id IN (select id  from  historico where historico.id = $idMeta)";
			$sql = $conexao->query($sql) or exit($conexao->error);
		}

	}

}


?>
