<?php
	session_start();
	if(isset($_SESSION['nome'])){
		echo"Bem-vindo ".$_SESSION['nome'];
	}else{
		header('Location: index.php');
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="estilo.css">
		<title>Gerencia Livros</title>
	</head>
	<body>
		<header>
			<h1>Gerencia Livros</h1>
			<a href="index.php">Sair</a>
		</header>
		<div id="content">
			<div id="menu">
				<div id="submenu">
					<h2>Cadastros</h2>
					<a href="cadastros/cadAluno.php">Cadastrar Alunos</a>
					<a href="cadastros/cadArea.php">Cadastrar Area</a>
					<a href="cadastros/cadLivro.php">Cadastrar Livro</a>
					<a href="cadastros/cadreserva.php">Fazer Reserva</a>
				</div>
				<div id="submenu">
					<h2>Listas</h2>
					<a href="listas/listAluno.php">Lista Alunos</a>
					<a href="listas/listArea.php">Lista Area</a>
					<a href="listas/listLivro.php">Lista Livro</a>
					<a href="listas/listreserva.php">Lista Reserva</a>
				</div>
			</div>
		</div>
	</body>
</html>