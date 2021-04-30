<?php
session_cache_expire(60);
session_start();

require_once "funcoes/funcoes.inc.php"; 
testeUsuario();
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Histórico</title>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="shortcut icon" href="../../midias/imagem/logo.svg" type="image/x-icon" />
</head>
<body>
			<header class="menu">
			 <div id="menu" class="container">
				<div class="logo">
					<a href="home.php"><img  src="../../midias/imagem/logo.svg" alt="logo"></a>
				</div>
				<div class="links">
					<a class="topico" href="paginaUsuario.php">Pagina Usuario</a>
					<a class="topico" href="?sair=true">Sair</a>
				</div> 
			 </div>
		</header>

		<section class="historico">
			<div> 

				 <?php
				 if(isset($_GET["meta"])){
				 	mostrarHistorico();
				 }else{
				 	header("Location: paginaUsuario.php");
				 }
				 ?>
					

			</div>
			<?php
				if(isset($_GET['sair'])){ //se existe o sair 
					session_destroy(); //destroi a sessão
					header("Location: home.php"); 
				}
?>
		</section>

		<section class="footer">
			<div  class="container">
				<h1>Contato</h1>
				<div class="contato">
					<div>
						<p>Email:  contato@carteiradossonhos.com</p>
						<p>Telefone:   (48) 3300-0000 </p>
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