<?php 
    include_once("../conectar.php");
	session_start();
	if(isset($_SESSION['nome'])){
		echo"usuario: ".$_SESSION['nome'];
	}else{
		header('Location: index.php');
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../estilo.css">
		<title>Cadastrar Livro</title>
	</head>
	<body>
		<header>
			<h1>Cadastrar Livro</h1>
			<a href="../main.php">Home</a>
		</header>
		<div id="content">
			<form method="post" action="cadLivro.php">
				<label>
					Titulo:
					<input type="text" name="titulo" required>
				</label>
				<label>
					Autor:
					<input type="text" name="autor" required>
				</label>
				<label>
					Area:
					<select name="id_area" required>
						<?php
						$sql = "SELECT * FROM area";
						$resultado=mysqli_query($conexao,$sql);
						while($data=mysqli_fetch_array($resultado)){
							$id=$data['id'];
							$nome=$data['nome'];
							echo "<option value='$id'>$nome</option>";
						}
						?>
					</select>
				</label>
				<button type="submit" name="Post" value="1">Registrar</button>
			</form>
		</div>
	</body>
</html>
<?php
    if(isset($_POST['Post'])){
        $titulo=$_POST['titulo'];
        $autor=$_POST['autor'];
        $idarea=$_POST['id_area'];
        $sql = "INSERT INTO livro (titulo, autor, status, id_area) VALUES ('$titulo','$autor','1','$idarea')";
        mysqli_query($conexao,$sql);
        mysqli_close($conexao);
        header('Location: ../listas/listlivro.php');
    }
?>