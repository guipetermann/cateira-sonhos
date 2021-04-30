<?php
	session_cache_expire(60);
	session_start();

	require_once "funcoes/funcoes.inc.php"; 
	testeUsuario();
	$nome = nome();
	$email = email();
	atualizaValorAtual();
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Pagina - Usuario</title>
	<link rel="shortcut icon" href="../../midias/imagem/logo.svg" type="image/x-icon" />
	<link rel="stylesheet" href="../css/style.css">
	<script type="text/javascript" src= "../javascript/functions.js"></script>
</head>
<header class="menu">
			 <div id="menu" class="container">
				<div class="logo">
					<a href="home.php"><img  src="../../midias/imagem/logo.svg" alt="logo"></a>
					</div>
				<div class="links">
					<a class="topico" href="home.php#conheça">Conheça</a>
					<a class="topico" href="#contato">Contato</a> 
					<a class="topico" href="#cadastro-login"><?php echo "$nome";?></a>
				</div> 
			 </div>
		</header>
<body>
<!-- <section id="login" class="container">
		<div>
				<form action="paginaUsuario.php" method="post">
					<label>Email:</label>
					<input type="email" name="email"><br>
					<label>Senha:</label>
					<input type="password" name="senha"><br>
		
					<button type="submit" name="login" >Login</button>
				</form>
				<a href="cadastro.html">Clique aqui caso não tenha cadastro</a><br>
				<a href="esqueciSenha.html">	Esqueci minha senha</a>
			</div> 

	 </section> 	-->
		<section class="id section-usuario">
		<div class="container">
			<div class="usuario"> 		
				<h2>Nome usuario: <?php echo "$nome";?></h2> 
				<h2>E-mail: <?php echo "$email";?> </h2> 
			</div>
			<div class="edicao-usuario">
				<a><img src="../../midias/imagem/caneta.svg" alt="imgCaneta"></a>
			</div>
		</div>
		<div class="container">	
			<div class="nova-meta"> 		
				<h2> Nova meta + </h2> 
			</div>
			<!--<div class="edicao-meta">-->
				<form method="post" action="paginaUsuario.php">
					<label>Nome:</label>
					<input type="text" name="nome-meta" required ><br>

					<label>Objetivo guardado:</label>
					<input type="number" name="valor-meta" min="0"  step="0.01" required ><br>

					<button type="submit" name="cadastrar-meta">Salvar Meta</button>
				</form>
				<?php
						if(isset($_POST["cadastrar-meta"])){
							//$nomeMeta = $_POST["nome-meta"];
							//$valor= $_POST["valor-meta"];
							cadastrarMeta();
							} 
				?>			 
			</div>
		</div>
		</section>	
		<div class="section-metas"> 
		<?php mostraMetas();
			  apagarMeta()?>
		</div>	  
		<script type="text/javascript"></script>
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
</html>

