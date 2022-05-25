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
        <title>Livros Lista</title>
    </head>
    <body>
        <header>
            <h1>Lista de Livros</h1>
            <a href="../main.php">Home</a>
        </header>
        <div id='content'>
            <form action="../edicao/EDlivro.php" method="post">
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Area</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                <?php 
                    $sql = "SELECT livro.id AS id, livro.titulo AS titulo, livro.autor AS autor, livro.status AS 'status', area.nome AS area FROM livro INNER JOIN area ON livro.id_area=area.id;";
                    $resultado=mysqli_query($conexao,$sql);
                    while($data=mysqli_fetch_array($resultado)){
                        $id=$data['id'];
                        $titulo=$data['titulo'];
                        $autor=$data['autor'];
                        $area=$data['area'];
                        $status=$data['status'];
                        echo "<tr><td>".$id."</td>";
                        echo "<td>".$titulo."</td>";
                        echo "<td>".$autor."</td>";
                        echo "<td>".$area."</td>";
                        if ($status) {
                            echo "<td>Livre</td>";
                        }else{
                            echo "<td>Emprestado</td>";
                        }
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