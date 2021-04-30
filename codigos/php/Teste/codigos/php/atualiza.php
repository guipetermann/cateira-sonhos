<?php session_cache_expire(60);
session_start();

require_once "funcoes/funcoes.inc.php"; 
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Histórico</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
			<header class="menu">
			 <div id="menu" class="container">
				<div class="logo">
					<img  src="../../midias/imagem/logo.svg" alt="logo">
				</div>
				<div class="links">
					<a class="topico" href="#conheça">Conheça</a>
					<a class="topico" href="#contato">Contato</a> 
					<a class="topico" href="#cadastro-login">Login/Cadastre-se</a>
				</div> 
			 </div>
		</header>

		<section class="historico">
			<div> 

				 <form method="POST">
				 	<label>Adicionar</label>
				 	<input onclick="trocaMin()" type="radio" name="tipoValor" id="adicionar" value="adicionar" checked="">
				 	<br>
				 	<label>Remover</label>
				 	<input onclick="trocaMax()" type="radio" name="tipoValor" id="remover" value="remover">
				 	<br>
				 	<label>Valor</label>
				 	<input type="number" id="valor-depositado" name="valor-depositado">
				 	<button type="submit" name="atualizar-meta">Atualizar</button>
				 </form>
					
				 <script type="text/javascript">
				 	function trocaMin(){
				 		var x = document.getElementById("valor-depositado");
				 		x.setAttribute("min",0);
				 		x.setAttribute("max",999999999999999);
				 	}
				 	function trocaMax(){
				 		var x = document.getElementById("valor-depositado");
				 		x.setAttribute("max",0);
				 		x.setAttribute("min", -999999999999999);
				 	} 
				 </script>
				 <?php
				 	if(isset($_POST["atualizar-meta"])){
				 		cadastrarHistorico();
				 	}
				 ?>
			</div>
		</section>

		<section class="footer">
			<div  class="container">
				<h1>Contato</h1>
				<div class="contato">
					<div>
						<p>Email:  email@email.com</p>
						<p>Telefone:   (00) 0000-0000 </p>
					</div>
					<div>
						<img src="../../midias/imagem/icone-instagram.svg" alt="icone-instagram">
						<img src="../../midias/imagem/icone-facebook.svg" alt="icone-facebook">
					</div>
				</div>
			</div>
		</section>
</body>
</html>