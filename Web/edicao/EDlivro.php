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
        $tituloUP=$_POST['titulo'];
        $autorUP=$_POST['autor'];
        $areaUP=$_POST['id_area'];
        $sql="UPDATE livro SET titulo = '$tituloUP', autor = '$autorUP', id_area = '$areaUP'  WHERE id = '$idUP' ";
        mysqli_query($conexao,$sql);
    }elseif(isset($_POST['Deleted'])){
        //caso botão de deleção
        $idDEL=$_POST['Deleted'];
        $sql="DELETE FROM livro WHERE id = '$idDEL'";
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
                $sql = "SELECT livro.id AS id, livro.titulo AS titulo, livro.autor AS autor, livro.id_area AS area FROM livro WHERE livro.id = $editid";
                $resultado=mysqli_fetch_array(mysqli_query($conexao,$sql));

                $titulo=$resultado['titulo'];
                $autor=$resultado['autor'];
                $area=$resultado['area'];
                echo "<form action'EDlivro.php' method='post'>";
                echo "<label>Titulo:<input type='text' name='titulo' value='$titulo' required>$titulo</label>";
                echo "<label>Autor: <input type='text' name='autor' value='$autor' required>$autor</label>";
                echo "<label>Area:<select name='id_area' required>";
					$sql = "SELECT * FROM area";
					$resultado=mysqli_query($conexao,$sql);
					while($data=mysqli_fetch_array($resultado)){
						$idarea=$data['id'];
						$nomearea=$data['nome'];
						echo "<option value='$idarea'";
                        if ($idarea==$area){
                            echo" selected";
                        }
                        echo ">$nomearea</option>";
					}
                echo "</select></label>";
                echo "<button type='submit' name='Edited' value='$editid'>Mudar</button>";
                echo "</form></div>";
            }elseif(isset($_POST['Delete'])){
                //caso botão de deletar
                $deleteid=$_POST['Delete'];
                $sql = "SELECT livro.id AS id, livro.titulo AS titulo, livro.autor AS autor FROM livro WHERE livro.id = $deleteid";
                $resultado=mysqli_fetch_array(mysqli_query($conexao,$sql));

                $titulo=$resultado['titulo'];
                $autor=$resultado['autor'];
                echo "<h2>Quer mesmo exluir o livro: $titulo, do autor: $autor?</h2>";
                echo "<form action='EDlivro.php' method='post'>";
                echo "<button type='submit' name='Deleted' value='$deleteid'>Sim</button>";
                echo "<button onClick='history.go(-1)'>Não</button></form></div>";
            }else{
                //outro, manda de volta pra lista
                header('Location: ../listas/listlivro.php');
            }
        ?>
    </body>
</html>
<?php
    mysqli_close($conexao);
?>