<?php

include("../config/conn.php");

if (isset($_POST['upload'])) {
	//Variavel
	$tituloPost = $_POST['name'];
	$setoroPost = $_POST['sector'];
	$inforPost = $_POST['description'];

	$novoNome = $_FILES['file']['name'];
	$file_type = $_FILES['file']['type'];
	$temp_name = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];

	$file_destination = "../upload/img/" . $novoNome;

	//Pegando Data
	date_default_timezone_set('America/Sao_Paulo');
	$datePost = date('Y-m-d H:i');

	if (move_uploaded_file($temp_name, $file_destination)) {
		$add = "INSERT INTO `anuncios` (`id` , `name` , `imagem` , `description`,  `sector`, `datapost`) VALUES (NULL , '$tituloPost', '$novoNome', '$inforPost', '$setoroPost' , '$datePost')";
		if ($conn->query($add) === true) {
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
			echo '<br>';
			echo '<div class="container">';
			echo '<div class="alert alert-warning alert-danger fade show" role="alert">';
			echo ' <strong>Oloco, meu!</strong> deu um errinho na hora de mover o arquivo ai!';
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
	<link rel="icon" type="image/png" href="../assets/images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
	<!--===============================================================================================-->
</head>

<body>
	<div class="container mt-3">
		<h1 class="text-center mb-5"><b>Adicionar novos avisos</b></h1>
		<div class="col-lg-8 m-auto">
			<form action="AddAviso.php" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="formGroupExampleInput">Titulo</label>
					<input type="text" class="form-control" name="name" id="name" placeholder="Exemplo: Novas escalas">
				</div>

				<div class="form-group">
					<label for="formGroupExampleInput">Setor</label>
					<input type="text" class="form-control" name="sector" id="sector" placeholder="Exemplo: Recursos Humanos">
				</div>

				<div>
					<label>Exemplo: imagem-anuncio.jpg</label>
					<input type="file" class="form-control" name="file" class="form-control">
				</div>

				<div class="form-group">
					<label for="exampleFormControlTextarea1">Informativo</label>
					<textarea class="form-control" name="description" id="description" rows="3"></textarea>
				</div>
				<?php if (isset($success)) { ?>
					<div class="alert alert-success">
						<?php echo $success; ?>
					</div>
				<?php } ?>
				<?php if (isset($failed)) { ?>
					<div class="alert alert-danger">
						<?php echo $failed; ?>
					</div>
				<?php } ?>
				<?php if (isset($msz)) { ?>
					<div class="alert alert-danger">
						<?php echo $msz; ?>
					</div>
				<?php } ?>
				<input type="submit" name="upload" value="Adicionar" class="btn btn-primary">
			</form>
		</div>
		<br><br><br>
	</div>
	<div class="container">
		<div class="card-group">
			<?php
			while ($res = mysqli_fetch_array($result)) {
				echo '<div class="card">';
				echo '	<img class="card-img-top" src="' . '../upload/img/' . $res['imagem'] . '" alt="Imagem de capa do card">';
				echo '	<div class="card-body">';
				echo '		<h5 class="card-title">' . $res['name'] . '</h5>';
				echo '		<p class="card-text"> ' . $res['description'] . '</p>';
				echo '	</div>';
				echo '<center>';
				echo '	<a href="func/deletarVideo.php" type="submit" class="btn btn-outline-dark">Excluir</a></p>';
				echo ' </center>';
				echo '	<div class="card-footer">';
				echo '		<small class="text-muted">Data postado: ' . $res['datapost'] . ' | Autor: ' . $res['sector'] . '</small>';
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