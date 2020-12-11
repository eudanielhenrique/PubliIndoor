<?php
$servidor = "localhost";
$usuario = "as";
$senha = "XdsumO";
$dbname = "dd";
//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

//Seleção de tabela para upload de videos
//$q = "SELECT * FROM video";

if (!$conn) {
    die("Falha na conexao: " . mysqli_connect_error());
} else {
    echo '<script>';
    echo 'console.log("Conectado ao banco")';
    echo '</script>';
}
