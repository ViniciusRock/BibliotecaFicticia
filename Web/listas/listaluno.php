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
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../estilo.css">
        <title>Alunos Lista</title>
    </head>
    <body>
        <header>
            <h1>Lista de Alunos</h1>
            <a href="../main.php">Home</a>
        </header>
        <div id='content'>
            <form action="../edicao/EDaluno.php" method="post">
                <table border="1">
                    <tr>
                        <th>Matricula</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>CPF</th>
                        <th>Data de Nascimento</th>
                        <th></th>
                        <th></th>
                    </tr>
                <?php 
                    $sql = "SELECT * FROM aluno";
                    $resultado=mysqli_query($conexao,$sql);
                    while($data=mysqli_fetch_array($resultado)){
                        $matricula=$data['matricula'];
                        $nome=$data['nome'];
                        $email=$data['email'];
                        $cpf=$data['cpf'];
                        $nasc=$data['data_nasc'];
                        echo "<tr><td>".$matricula."</td>";
                        echo "<td>".$nome."</td>";
                        echo "<td>".$email."</td>";
                        echo "<td>".$cpf."</td>";
                        echo "<td>".$nasc."</td>";
                        echo "<td><button name='Edit' value='$matricula'>EDITAR</button></td>";
                        echo "<td><button name='Delete' value='$matricula'>EXCLUIR</button></td></tr>";
                    }
                    mysqli_close($conexao)
                ?>
                </table>
            </form>
        </div>
    </body>
</html>