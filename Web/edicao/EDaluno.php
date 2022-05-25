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
        $matriculaUP=$_POST['Edited'];
        $nomeUP=$_POST['nome'];
        $emailUP=$_POST['email'];
        $cpfUP=$_POST['cpf'];
        $nascUP=$_POST['nasc'];
        $sql="UPDATE aluno SET nome = '$nomeUP', email = '$emailUP', cpf = '$cpfUP', data_nasc = '$nascUP'  WHERE matricula = '$matriculaUP' ";
        mysqli_query($conexao,$sql);
    }elseif(isset($_POST['Deleted'])){
        //caso botão de deleção
        $matriculaDEL=$_POST['Deleted'];
        $sql="DELETE FROM aluno WHERE matricula = '$matriculaDEL'";
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
            echo "<header><h1>$title</h1><a href='../main.php'>Home</a></header><div id='content'><script src='../JS/ValidaCPF.js'></script>";
            //formularios apartir das listas
            if (isset($_POST['Edit'])) {
                //caso botão editar
                $editid=$_POST['Edit'];
                $sql = "SELECT * FROM aluno WHERE matricula = $editid";
                $resultado=mysqli_fetch_array(mysqli_query($conexao,$sql));

                $nome=$resultado['nome'];
                $email=$resultado['email'];
                $cpf=$resultado['cpf'];
                $datanasc=$resultado['data_nasc'];
                echo "<form action'EDaluno.php' method='post' id='forme'>";
                echo "<label>Nome:<input type='text' name='nome' value='$nome' required>$nome</label>";
                echo "<label>Email:<input type='email' name='email' value='$email' required>$email</label>";
                echo "<label>CPF:<input type='text' name='cpf' id='cpf' value='$cpf' required>$cpf</label>";
                echo "<label>Nascimento: <input type='date' name='nasc' value='$datanasc' required>". date_format(date_create($datanasc),"d/m/Y")."</label>";
                echo "<button type='submit' name='Edited' value='$editid'>Mudar</button>";
                echo "</form></div>";
            }elseif(isset($_POST['Delete'])){
                //caso botão de deletar
                $deleteid=$_POST['Delete'];
                $sql = "SELECT * FROM aluno WHERE matricula = $deleteid";
                $resultado=mysqli_fetch_array(mysqli_query($conexao,$sql));

                $nome=$resultado['nome'];
                echo "<h2>Quer mesmo exluir o aluno: $nome?</h2>";
                echo "<form action='EDaluno.php' method='post'>";
                echo "<button type='submit' name='Deleted' value='$deleteid'>Sim</button>";
                echo "<button onClick='history.go(-1)'>Não</button></form></div>";
            }else{
                //outro, manda de volta pra lista
                header('Location: ../listas/listaluno.php');
            }
        ?>
    </body>
</html>
<?php
    mysqli_close($conexao);
?>