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
		$data 	= new DateTime();
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

		$sql = "SELECT * FROM historico WHERE historico.id = '$idMeta'";
		$resultado = $conexao->query($sql) or exit($conexao->error);

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
			echo "<tr>
			       <td> $data  </td>
			       <td> $valor  </td>
			      </tr>";
		}
		echo "</table>";
	}


}
?>