<?php
//Conecção ao banco de dados
include("../../config/conn.php");

//Obtendo id dos dados do url
$id = $_GET['id'];

//Selecionando tabela
$q = "SELECT * FROM `video` WHERE id = $id ";
$query = mysqli_query($conn, $q);
$row = mysqli_fetch_array($query);
$name = $row['name'];

//Chamando função para deletar arquivo
$local = '../../upload/' . $name;

echo unlink($local);

if (unlink($local)) {
    echo 'Arquivo '. $name .' não foi deletado, tente novamente!';
} else {
    //Deletando linha da tabela
    echo 'Arquivo '. $name .' foi deletado!';
    $result = mysqli_query($conn, "DELETE FROM video WHERE id=$id");
    header("Location: ../listVideos.php?deletado");
}

//Redirecionar para pagina anterior
echo '<meta http-equiv="refresh" content="5;url=../listVideos.php">';
