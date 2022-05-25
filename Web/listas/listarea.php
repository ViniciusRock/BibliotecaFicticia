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
        <title>Area Lista</title>
    </head>
    <body>
        <header>
            <h1>Lista de Areas</h1>
            <a href="../main.php">Home</a>
        </header>
        <div id='content'>
            <form action="../edicao/EDarea.php" method="post">
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th></th>
                        <th></th>
                    </tr>
                <?php 
                    $sql = "SELECT * FROM area";
                    $resultado=mysqli_query($conexao,$sql);
                    while($data=mysqli_fetch_array($resultado)){
                        $id=$data['id'];
                        $nome=$data['nome'];

                        echo "<tr><td>".$id."</td>";
                        echo "<td>".$nome."</td>";
                        echo "<td><button name='Edit' value='$id'>EDITAR</button></td>";
                        echo "<td><button name='Delete' value='$id'>EXCLUIR</button></td></tr>";
                    }
                    mysqli_close($conexao)
                ?>
                </table>
            </form>
        </div>
    </body>
</html>