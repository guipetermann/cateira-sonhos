<?php
session_cache_expire(60);
session_start();

require_once "funcoes/funcoes.inc.php"; 
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>					
	<meta charset="utf-8"/>
	<title>Home</title>
	<link rel="shortcut icon" href="../../midias/imagem/logo.svg" type="image/x-icon" />
	<link rel="stylesheet" href="../css/style.css">
	<script type="text/javascript" src= "../javascript/functions.js"></script> 
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
		<section  class="container">
			<div class="banner">
				<div class="banner-esquerda"></div>
				<div class="banner-direita"></div>
			</div>
		</section>
		<section class="texto-chamada">
			<div class="container">
				<div>
					<img src="../../midias/imagem/165.png" alt="IMG">
				</div>
				<div>
					<h2>Pensando na solução para organizar suas economias.
					<br> A carteira de sonhos, sua plataforma web,<br> permite administrar seus projetos de forma fácil, prática e eficiente. </h2>
				</div>	
			</div>		
		</section>
		<section  class="container" id="conheca">
			<div class="conheca">
				<h1>Conheça</h1>
				<div>
					<img src="../../midias/imagem/106.png" alt="IMG ">
					<h2 class="tamanho-texto">Imagine aquela viagem internacinal , aquele carro maravilhoso ou faculdade dos sonhos ...<br> Pense em  planejar suas metas, com total autonomia.</h2> <br><br>
				</div>
				<div>
					<h2 class="tamanho-texto">Ao se cadastrar, definirá valores a suas metas, com autonomia para editar conforme sua necessidade. Acompanhar o quanto está faltando para atingir seus sonhos, despertando  assim, a  motivação em  ver o seu progresso.</h2>
					<img src="../../midias/imagem/106.png" alt="IMG ">
				</div>
				<div>

					<!--<img src="../../midias/imagem/grafico.png" alt="Img Grafico ">			--->
					<canvas id="graficoAnimacao" width="600" height="400" class="grafico"></canvas>
					<script type="text/javascript"> animacaoGrafico(300, 200, 100, 'blue',80);</script>

					<h2 class="texto-grafico"> Suas metas será visível por meio de  porcentagem de conclusão, sendo acompanhada  por histórico de datas.<br> Agora você  pode planejar todas as suas metas e deslumbrar com as suas conquistas .</h2><br><br>
				</div>
			</div>
			<span class="btn-cadastre">
				<a href="cadastro.php">Cadastre-se</a>
			</span>
		</section>	
		<section class="footer" id="contato">
		<script type="text/javascript" src="../javascript/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="../javascript/functions.js"></script> 
			<div  class="container">
				<h1>Contato</h1>
				<div class="contato">
					<div>
						<p><span>Email:</span>  email@email.com</p>
						<p><span>Telefone:</span>   (00) 0000-0000 </p>
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

