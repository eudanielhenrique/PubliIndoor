<?php

include("config/conn.php");

if (isset($_POST['enviarDados'])) {
    $tituloPost = $_POST['name'];
    $setoroPost = $_POST['sector'];
    $inforPost = $_POST['description'];
    $erro = 0;

    $file_name = $_FILES['file']['imagem'];
    $file_type = $_FILES['file']['type'];
    $temp_name = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];

    $file_destination = "../upload/img/" . $file_name;
    date_default_timezone_set('America/Sao_Paulo');
    $datePost = date('Y-m-d H:i');

    $add = "INSERT INTO anuncios (`imagem` ,`name` , `description`, `sector`, `datapost`) VALUES ('$file_name', '$tituloPost',  '$inforPost', '$setoroPost' , '$datePost')";

    //Verifica se o campo nome não está em branco
    if (empty($tituloPost) or strstr($tituloPost, ' ') == false) {
        $erro = 1;
    }

    //Verifica se o campo nome não está em branco
    if (empty($inforPost) or strstr($inforPost, ' ') == false) {
        $erro = 1;
    }

    //Verifica se o campo nome não está em branco
    if (empty($setoroPost) or strstr($setoroPost, ' ') == false) {
        $erro = 1;
    }
    //Verifica se não houve erro - neste caso chama a include para inserir os dados
    if ($erro == 0) {

        if ($conn->query($add) === TRUE) {
            echo '<br>';
            echo '<div class="container">';
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
            echo ' <strong>Oloco, meu!</strong> Todos os campos foram preenchidos e cadastrados com sucesso!';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo ' </button>';
            echo '</div>';
            echo '<script>';
            echo '$(".alert").alert("close")';
            echo '</script>';
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo '<br>';
        echo '<div class="container">';
        echo '<div class="alert alert-warning alert-danger fade show" role="alert">';
        echo ' <strong>Oloco, meu!</strong> Preencha os campos corretamente!';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span>';
        echo ' </button>';
        echo '</div>';
        echo '</div>';
        echo '<script>';
        echo '$(".alert").alert("close")';
        echo '</script>';
    }
}

$result = mysqli_query($conn, "SELECT * FROM anuncios ORDER BY id ASC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Adicionar Aviso</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!--===============================================================================================-->
</head>

<style type="text/css">
    header {
        position: relative;
        background-color: black;
        height: 15vh;
        min-height: 25rem;
        width: 100%;
        overflow: hidden;
    }

    header video {
        position: absolute;
        top: 50%;
        left: 50%;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        z-index: 0;
        -ms-transform: translateX(-50%) translateY(-50%);
        -moz-transform: translateX(-50%) translateY(-50%);
        -webkit-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
    }

    header .container {
        position: relative;
        z-index: 2;
    }

    header .overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: black;
        opacity: 0.5;
        z-index: 1;
    }

    @media (pointer: coarse) and (hover: none) {
        header {
            background: url('https://source.unsplash.com/XT5OInaElMw/1600x900') black no-repeat center center scroll;
        }

        header video {
            display: none;
        }
    }
</style>
<header>
    <div class="overlay"></div>
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source src="https://xerifexnetwork.com/IndoorGramazini/upload/ampliacao.mp4" type="video/mp4">
    </video>
    <div class="container h-100">
        <div class="d-flex h-100 text-center align-items-center">
            <div class="w-100 text-white">
                <h1 class="display-3">Mural de anuncios</h1>
                <p class="lead mb-0 text-white">Aqui tera todos os informativos para os colaboradores da Gramazini!</p>
            </div>
        </div>
    </div>
</header>

<section class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                
            </div>
        </div>
    </div>
</section>

<body>
    <div class="container">
        <div class="card-group">
            <?php
            while ($res = mysqli_fetch_array($result)) {
                echo '<div class="card">';
                echo '	<img class="card-img-top" src="' . 'upload/img/' . $res['imagem'] . '" alt="Imagem de capa do card">';
                echo '	<div class="card-body">';
                echo '		<h5 class="card-title">' . $res['name'] . '</h5>';
                echo '		<p class="card-text"> ' . $res['description'] . '</p>';
                echo '	</div>';
                echo '	<div class="card-footer">';
                echo '		<small class="text-muted">Data postado: ' . $res['datapost'] . ' | Autor: ' . $res['sector'] .'</small>';
                echo '	</div>';
                echo '</div>';
            } ?>
        </div>
    </div>

</body>


<!-- Footer -->
<footer class="page-footer font-small special-color-dark pt-4">
	
	<!-- Copyright -->
	<div class="footer-copyright text-center py-3">© 2020 Copyright:
		<a href="https://gramazini.com.br/"> Gramazini.com.br</a>
	</div>
	<!-- Copyright -->

</footer>
<!-- Footer -->

</html>