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
        <title>Reserva</title>
	</head>
	<body>
        <header>
            <h1>Fazer Reserva</h1>
            <a href="../main.php">Home</a>
        </header>
        <div id="content">
            <form method="post" action="cadreserva.php">
                <label>
                    Aluno:
                    <select name="matricula" required>
                        <?php
                            $sql = "SELECT * FROM aluno";
                            $resultado=mysqli_query($conexao,$sql);
                            while($data=mysqli_fetch_array($resultado)){
                                $matricula=$data['matricula'];
                                $nome=$data['nome'];
                                echo "<option value='$matricula'>$nome</option>";
                            }
                        ?>
                    </select>
                </label>
                <br> <!--Visual somente :( -->
                <?php
                    $sql = "SELECT * FROM livro WHERE status=1";
                    $resultado=mysqli_query($conexao,$sql);
                    $notempty=false;
                    echo "Livro:";
                    while($data=mysqli_fetch_array($resultado)){
                        $id=$data['id'];
                        $titulo=$data['titulo'];
                        echo "<label><input type='radio' name='id_livro' value='$id'>$titulo</label><br>";
                        $notempty=true;
                    }
                    if(!$notempty){
                        echo "<h1>Sem livros disponiveis</h1>";
                    }
                ?>
                <label>
                    Data Entrega:
                    <input type="date" name="data_entrega" require>
                </label>
                <button type="submit" name="Post" value="1">Retirar</button>
            </form>
        </div>
	</body>
</html>
<?php
    if (isset($_POST['Post'])) {
        $aluno=$_POST['matricula'];
        $livro=$_POST['id_livro'];
        $entrega=$_POST['data_entrega'];

        /* Tentei fazer algo semelhante a isso para fazer a retirada de varios livros mas n rolou :/ por isso deixei radio o input lá em cima
        if(is_array($livro)){
            foreach ($livro as $valor) {
                $sql="INSERT INTO reserva(status, data_retirada, data_entrega, matricula, id_livro) VALUES('1', NOW(),'$entrega','$aluno','$valor')";
                mysqli_query($conexao,$sql);
            }
        }else{*/
            $sql="INSERT INTO reserva(status, data_retirada, data_entrega, matricula, id_livro) VALUES('1', NOW(),'$entrega','$aluno','$livro')";
            mysqli_query($conexao,$sql);
            $sql="UPDATE livro SET status=0 WHERE id=$livro";
            mysqli_query($conexao,$sql);
            header('Location: ../listas/listreserva.php');
        //}
    }
    mysqli_close($conexao)
?>