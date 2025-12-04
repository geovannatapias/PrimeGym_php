<?php 

$host = "localhost"; 
$user ="root";
$pass = ""; //por a senha
$db ="academia_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}
?>