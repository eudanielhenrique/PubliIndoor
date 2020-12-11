<?php

include("../config/conn.php");

if (isset($_POST['upload'])) {
	//$name = $_FILES['file'];
	//echo "<pre>";
	//print_r($name);
	//exit();

	$file_name = $_FILES['file']['name'];
	$file_type = $_FILES['file']['type'];
	$temp_name = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];

	$file_destination = "../upload/videos/" . $file_name;

	$desc = $_POST['desc'];

	if (move_uploaded_file($temp_name, $file_destination)) {
		$add = "INSERT INTO `video` ( `id` , `name` , `description`) VALUES (NULL , '$file_name' , '$desc')";
		if (mysqli_query($conn, $add)) {
			$success = "Vídeo enviado com sucesso.";
		} else {
			$failed = "Algo deu errado ??";
		}
	} else {
		$msz = "Selecione um vídeo para enviar ..!";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Adicionar novos videos</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
	<!-- <script src="../assets/js/jquery.min.js"></script> -->
</head>

<body>

	<div class="container mt-3">

		<h1 class="text-center mb-5"><b>Adicionar novos videos</b></h1>
		<div class="col-lg-8 m-auto">
			<form action="UpVideo.php" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label>Nome do video:</label>
					<input type="text" class="form-control" name="desc" placeholder="Video de corte de bloco" /> <br>
					<label>Exemplo: video.mp4</label>
					<input type="file" class="form-control" name="file" class="form-control">
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
				<input type="submit" name="upload" value="Adicionar" class="form-control-file">
			</form>
		</div>
		<div class="row">
			<?php
			include("../config/conn.php");
			$q = "SELECT * FROM `video`";
			$query = mysqli_query($conn, $q);
			while ($row = mysqli_fetch_array($query)) {
				$numero = $row['id'];
				$name = $row['name'];
				$desc = $row['description'];

			?>

				<div class="col-md-4">
					<div class="card shadow-sm" style="width: 23rem;">
						<video width="100%" controls>
							<source src="<?php echo '../upload/videos/' . $name; ?>" class="card-img-top">
						</video>
						<div class="card-body">
							<center>
								<p class="card-text"><?php echo $desc ?><br><br>
									<a href="func/deletarVideo.php" type="submit" class="btn btn-outline-dark">Excluir</a></p>
							</center>
						</div>
					</div>
					<br>
				</div>
			<?php } ?>
		</div>
	</div>
</body>

</html>