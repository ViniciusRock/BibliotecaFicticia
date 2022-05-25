<?php
    include_once("conectar.php");
    session_start();
    if(isset($_SESSION['nome'])){
        session_destroy();
        echo"Deslogado com sucesso";
        session_start();
    }
    if(isset($_POST['Login'])){
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $sql = "SELECT * FROM aluno WHERE nome = '$nome' AND cpf = '$cpf'";
        $resultado = mysqli_query($conexao, $sql);
        if(mysqli_num_rows($resultado) == 1){
            $registro = mysqli_fetch_array($resultado);
            $_SESSION['nome'] = $registro['nome'];
            $_SESSION['matricula'] = $registro['matricula'];
            header('Location: main.php');

        } else{
            echo"<script> window.onload = function LoginErro(){window.alert('Dados incorretos');}</script>";
        }
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
			<h1>Login</h1>
		</header>
		<div id="content">
            <form action="index.php" method="POST">
                <label>
                    CPF: 
                    <input type="textbox" name="cpf" required>
                </label>
                <label>
                    Nome:
                    <input type="textbox" name="nome" required>
                </label>
                <button type="submit" name="Login">Entrar!</button>
            </form>
		</div>
	</body>
</html>