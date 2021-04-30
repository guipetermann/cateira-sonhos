<?php 
class Historico
{
	public $id;
	public $data;
	public $valor;

	function receberDadosFormulario($conexao)
	{
		$id 	= trim($conexao->escape_string($_GET["atualizaValor"]));
		$valor 	= trim($conexao->escape_string($_POST["valor-depositado"]));
		$valor = str_replace(",",".", str_replace(".","", $valor));
		//tive que usar o replace porque o numero formatado estava dando problema de reconhecer 
		$operacao = trim($conexao->escape_string($_POST["tipoValor"]));
		if($operacao == "remover"){
			$valor = $valor / -1;
		}
		$valor  = (double)$valor;
		$fuso = new DateTimeZone('America/Sao_Paulo');
		$data 	= new DateTime();
		$data->setTimezone($fuso);
		$data 	= $data->format('y/m/d');
		$this->id 		 = $id;
		$this->data 	 = $data;
		$this->valor 	 = $valor;
	}

	function cadastrar($conexao, $nomeDaTabela3)
	{
		$sql = "INSERT $nomeDaTabela3 VALUES(
		'$this->id',
		'$this->data',
		'$this->valor')";

		$resultado = $conexao->query($sql) or exit($conexao->error);
	}

	function mostrar($conexao){

		$email = trim($conexao->escape_string($_SESSION["email"]));
		$idMeta = trim($conexao->escape_string($_GET['meta']));

		$sql = "SELECT * FROM historico, metas WHERE historico.id = '$idMeta' and metas.usuario = '$email' and historico.id = metas.id" ;
		$resultado = $conexao->query($sql) or exit($conexao->error);
		if($conexao->affected_rows == 0){
			echo "<h2>Não existe nenhum registro para mostrar dessa meta</h2>";
		}else
		{
			echo "<table>
		     <caption> Dados das metas cadastradas</caption>
		     <tr>
				<th>Data </th>
				<th>Valor</th>
		     </tr>";
			while($registro = $resultado->fetch_array())
			{

				$data = htmlentities($registro[1],ENT_QUOTES,"UTF-8") ;
		 		$valor = htmlentities($registro[2],ENT_QUOTES,"UTF-8") ;
				echo "<tr class='data-valor'>
			       <td> $data  </td>
			       <td> $valor  </td>
			      </tr>";
			}
			echo "</table>";

		}
		
	}


}
?>