<?php
    include_once("../conectar.php");
    session_start();
	if(isset($_SESSION['nome'])){
		echo"Usuario: ".$_SESSION['nome'];
	}else{
		header('Location: index.php');
	}
    if(isset($_POST['Devolve'])){
        $iddevolveR=$_POST['Devolve'];
        $iddevolveL=$_POST['idLivro'];
        $reserva="UPDATE reserva SET reserva.status = '0' WHERE reserva.id = $iddevolveR";
        $resultado=mysqli_query($conexao,$reserva);
        if($resultado){
            echo "Reserva atualizada ";
        }else{
            echo "Reserva Erro :( ";
        }
        $livro="UPDATE livro SET livro.status = '1' WHERE livro.id = $iddevolveL ";
        $resultado2=mysqli_query($conexao,$livro);
        if($resultado2){
            echo "Livro Status Atualizado";
        }else{
            echo "Livro Status Erro :(";
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../estilo.css">
        <title>Reservas</title>
    </head>
    <body>
        <header>
            <h1>Reservas</h1>
            <a href="../main.php">Home</a>
        </header>
        <div id='content'>
                <h2>Em aberto<h2>
                <table border="1">
                    <tr>
                        <th>Reserva</th>
                        <th>Retirada</th>
                        <th>Entrega</th>
                        <th>Aluno</th>
                        <th>Livro</th>
                        <th></th>
                    </tr>
                <?php 
                    $sql = "SELECT reserva.id 'idreserva',reserva.data_retirada, reserva.data_entrega, reserva.status, aluno.nome,livro.titulo,livro.id 'idlivro' FROM reserva INNER JOIN aluno ON reserva.matricula=aluno.matricula INNER JOIN livro ON reserva.id_livro=livro.id WHERE reserva.status > 0;";
                    $resultado=mysqli_query($conexao,$sql);
                    while($data=mysqli_fetch_array($resultado)){
                        $idreserva=$data['idreserva'];
                        $retirada=$data['data_retirada'];
                        $entrega=$data['data_entrega'];
                        $nome=$data['nome'];
                        $titulo=$data['titulo'];
                        $status=$data['status'];
                        $idlivro=$data['idlivro'];
                        //Fui preguiçoso e gerei varios forms :P
                        echo "<form action='listreserva.php' method='post'><tr><td>".$idreserva."</td>";
                        echo "<td>".$retirada."</td>";
                        echo "<td>".$entrega."</td>";
                        echo "<td>".$nome."</td>";
                        echo "<td>".$titulo."</td>";
                        echo "<input type='hidden' name='idLivro' value='$idlivro'>";
                        echo "<td><button action='submit' name='Devolve' value='$idreserva'>DEVOLVER</button></td></tr></form>";
                    }
                ?>
                </table>
            <div>
                <h2>Todos</h2>
                <table border="1">
                    <tr>
                        <th>Reserva</th>
                        <th>Retirada</th>
                        <th>Entrega</th>
                        <th>Aluno</th>
                        <th>Livro</th>
                        <th>Status</th>
                    </tr>
                <?php 
                    $sql = "SELECT reserva.id 'idreserva',reserva.data_retirada, reserva.data_entrega, reserva.status, aluno.nome,livro.titulo,livro.id 'idlivro' FROM reserva INNER JOIN aluno ON reserva.matricula=aluno.matricula INNER JOIN livro ON reserva.id_livro=livro.id ORDER BY idreserva DESC";
                    $resultado=mysqli_query($conexao,$sql);
                    while($data=mysqli_fetch_array($resultado)){
                        $idreserva=$data['idreserva'];
                        $retirada=$data['data_retirada'];
                        $entrega=$data['data_entrega'];
                        $nome=$data['nome'];
                        $titulo=$data['titulo'];
                        $status=$data['status'];
                        $idlivro=$data['idlivro'];
                        echo "<tr><td>".$idreserva."</td>";
                        echo "<td>".$retirada."</td>";
                        echo "<td>".$entrega."</td>";
                        echo "<td>".$nome."</td>";
                        echo "<td>".$titulo."</td>";
                        if($status>0){
                            echo "<td>Em aberto</td></tr>";
                        }else{
                            echo "<td>Encerrada</td></tr>";
                        }
                    }
                ?>
                </table>
            </div>
        </div>
    </body>
</html>

<?php
    mysqli_close($conexao)
?>