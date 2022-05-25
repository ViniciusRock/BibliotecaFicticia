<?php
$servername = "localhost";
$database = "biblioteca";
$username = "root";
$password = "";
// Create connection
$conexao = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conexao) {
      die("Falha na Conexão: " . mysqli_connect_error());
}
 

 
