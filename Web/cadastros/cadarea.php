<?php
    include_once("../conectar.php");
	session_start();
	if(isset($_SESSION['nome'])){
		echo"Usuario: ".$_SESSION['nome'];
	}else{
		header('Location: index.php');
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../estilo.css">
		<title>Cadastrar Area</title>
	</head>
	<body>
		<header>
			<h1>Cadastrar Area</h1>
			<a href="../main.php">Home</a>
		</header>
		<div id="content">
			<form method="post" action="cadarea.php">
				<label>
					Nome:
					<input type="text" name="nome" required>
				</label>
				<button type="submit" name="Post" value="1">Registrar</button>
			</form>
		</div>
	</body>
</html>
<?php
    if(isset($_POST['Post'])){
        $nome=$_POST['nome'];
        $sql = "INSERT INTO area (nome) VALUES ('$nome')";
        mysqli_query($conexao,$sql);
        mysqli_close($conexao);
        header('Location: ../listas/listarea.php');
    }
?>