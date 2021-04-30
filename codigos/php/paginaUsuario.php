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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!--carrega o jQuery-->
	<script src="../javascript/jquery-maskmoney-master/src/jquery.maskMoney.js"></script> <!--carrega o plugin da máscara. Estou enviando o pacote em anexo-->
	<script type="text/javascript" src= "../javascript/functions.js"></script>
</head>
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
<body>
					<?php 
						if(isset($_GET['sair'])){ //se existe o sair 
							session_destroy(); //destroi a sessão
							header("Location: home.php"); 
					} 
					?>
		<section class="id section-usuario">
		<div class="container">
			<div class="usuario"> 		
				<h2>Nome usuario: <?php echo "$nome";?></h2> 
				<h2>E-mail: <?php echo "$email";?> </h2> 
			</div>
			<div class="edicao-usuario">
				<!--<a><img src="../../midias/imagem/caneta.svg" alt="imgCaneta"></a>-->
			</div>
		</div>
		<div class="container cadastro-meta">	
			<div class="nova-meta" id="cadastrometa"> 		
				<h2 class="nova-cadastro">Nova meta +</h2> 
			</div>
			<div class="edicao-meta">
				<form method="post" action="paginaUsuario.php">
					<div>
						<label>Nome:</label>
						<input type="text" name="nome-meta" required >
					</div>
					<div>
						<label for="dinheiro" >Objetivo guardado:</label>
						<input name="valor-meta" type="text" id="dinheiro" class="dinheiro form-control"required>
					</div>
					<button type="submit" name="cadastrar-meta">Salvar Meta</button>
				</form>
				 <script src="../javascript/formata-moeda.js"></script>		<!--carrega o arquivo de formatação da máscara-->
				<p>
					<?php
						if(isset($_POST["cadastrar-meta"])){
							//$nomeMeta = $_POST["nome-meta"];
							//$valor= $_POST["valor-meta"];
							cadastrarMeta();
							} 
					?>	
				</p>		 
			</div>
		</div>
		</section>	
		<div class="section-metas"> 
			<?php 
				ob_start(); 
				mostraMetas();
				apagarMeta();
				ob_end_flush();
			?>
			  
		</div>	  
		<script type="text/javascript"></script>
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
</html>

