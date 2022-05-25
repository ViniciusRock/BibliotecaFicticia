<?php
    include_once("../conectar.php");
    session_start();
	if(isset($_SESSION['nome'])){
		echo"Usuario: ".$_SESSION['nome'];
	}else{
		header('Location: index.php');
	}
    //Checagem de como se chegou a pagina
    if (isset($_POST['Edit'])) {
        //caso botão edit
        $title='Editar';
    }elseif(isset($_POST['Delete'])){
        //caso botao deletar
        $title='Deletar';
    }elseif(isset($_POST['Edited'])){
        //caso formulario proprio de edição
        $idUP=$_POST['Edited'];
        $nomeUP=$_POST['nome'];
        $sql="UPDATE area SET nome = '$nomeUP' WHERE id = '$idUP' ";
        mysqli_query($conexao,$sql);
    }elseif(isset($_POST['Deleted'])){
        //caso botão de deleção
        $idDEL=$_POST['Deleted'];
        $sql="DELETE FROM area WHERE id = '$idDEL'";
        mysqli_query($conexao,$sql);
    }else{
        //outros
        $title='Erro';
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../estilo.css">
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <?php
            echo "<header><h1>$title</h1><a href='../main.php'>Home</a></header><div id='content'>";
            //formularios apartir das listas
            if (isset($_POST['Edit'])) {
                //caso botão editar
                $editid=$_POST['Edit'];
                $sql = "SELECT * FROM area WHERE id = $editid";
                $resultado=mysqli_fetch_array(mysqli_query($conexao,$sql));

                $id=$resultado['id'];
                $nome=$resultado['nome'];
                echo "<form action'EDarea.php' method='post'>";
                echo "<label>Titulo:<input type='text' name='nome' value='$nome' required>$nome</label>";
                echo "<button type='submit' name='Edited' value='$id'>Mudar</button>";
                echo "</form></div>";
            }elseif(isset($_POST['Delete'])){
                //caso botão de deletar
                $deleteid=$_POST['Delete'];
                $sql = "SELECT * FROM area WHERE id = $deleteid";
                $resultado=mysqli_fetch_array(mysqli_query($conexao,$sql));

                $id=$resultado['id'];
                $nome=$resultado['nome'];
                echo "<h2>Quer mesmo exluir a area: $nome?</h2>";
                echo "<form action='EDarea.php' method='post'>";
                echo "<button type='submit' name='Deleted' value='$deleteid'>Sim</button>";
                echo "<button onClick='history.go(-1)'>Não</button></form></div>";
            }else{
                //outro, manda de volta pra lista
                header('Location: ../listas/listarea.php');
            }
        ?>
    </body>
</html>
<?php
    mysqli_close($conexao);
?>