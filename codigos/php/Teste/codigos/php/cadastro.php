<?php
session_cache_expire(60);
session_start();

require_once "funcoes/funcoes.inc.php"; 
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Cadastro</title>
	<link rel="shortcut icon" href="../../midias/imagem/logo.svg" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	
</head>
<body>
<div class="menu">
			<nav style="width: 100%;">
			 <div id="menu" class="container">
				<div class="logo">
					<a href="home.php"><img  src="../../midias/imagem/logo.svg" alt="logo"></a>
				</div>
				<div class="links">
					<a class="topico" href="#conheca">Conheça</a>
					<a class="topico" href="#contato">Contato</a> 
					<a class="topico login" href="#login">Login/Cadastre-se</a>
					</div> 
			 </div>	
		</nav>
</div>
		<section id="login" class="container modal-container">
			<div class="modal">
				<form action="home.php" method="post">
					<label>Email:<input type="email" name="email" required="" class="fundo-input"></label>
					<label>Senha:<input type="password" name="senha" required=""  class="fundo-input"></label>
		
					<button type="submit" name="login">Login</button>

				</form>
				<?php
					if(isset($_POST["login"])){
				 		login();
				}?>
				
				<div class="cadastro-esqueci">
					<a href="cadastro.php">Clique aqui caso não tenha cadastro</a><br>
					<a href="esqueciSenha.php">	Esqueci minha senha</a>
				</div>
			</div>
		</section>
<section class="cadastro">
	<div class="formulario">
		<div>
		<img src="../../midias/imagem/16.png" alt="menina subindo a escada">
		</div>
		<div class="form">
			<h1>Cadastro</h1>
			<form method="post" action="cadastro.php">
				<label> <span> Nome:</span>
				<input type="text" name="nome-usuario" required> </label>
				<label><span> Email: </span>
				<input type="email" name="email-usuario"required></label>
				<label><span> Senha: </span>
				<input type="password" name="senha-usuario" required></label>
				<label><span> Confirmação de Senha: </span>
				<input type="password" name="senhaConfirmação" required></label>

			<span><button type="submit" name="cadastrar-usuario">Cadastrar</button></span>
			</form>
			<?php 
				if(isset($_POST["cadastrar-usuario"])){
					$senha = $_POST["senha-usuario"];
					$confirma = $_POST["senhaConfirmação"];
					if($senha == $confirma){
						cadastrar();
					}else
					{
						echo("senha não é igual a confirmação");
					}

				} 
			?>
		</div>	
	</div>
</section>
<script type="text/javascript" src="../javascript/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../javascript/functions.js"></script> 
</body>
</html>

