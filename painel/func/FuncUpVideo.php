<?php

include("../../config/conn.php");

if (isset($_POST['upload'])) {
	//$name = $_FILES['file'];
	//echo "<pre>";
	//print_r($name);
	//exit();

	$file_name = $_FILES['file']['name'];
	$file_type = $_FILES['file']['type'];
	$temp_name = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];

	$file_destination = "../../upload/" . $file_name;

	if (move_uploaded_file($temp_name, $file_destination)) {
		$add = "INSERT INTO video (name) VALUES ('$file_name')";
		if (mysqli_query($conn, $add)) {
			$success = "Vídeo enviado com sucesso.";
		} else {
			$failed = "Algo deu errado ??";
		}
	}
	else {
		$msz = "Selecione um vídeo para enviar ..!";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Adicionar novos videos</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
	<!-- <script src="../assets/js/jquery.min.js"></script> -->
</head>

<body>

	<div class="container mt-3">

		<h1 class="text-center mb-5"><b>Adicionar novos videos</b></h1>
		<div class="col-lg-8 m-auto">
			<form action="FuncUpVideo.php" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label><strong>Selecione o video:</strong></label>
					<input type="file" name="file" class="form-control">
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
				<input type="submit" name="upload" value="Adicionar" class="btn btn-success ml-3">
			</form>
		</div>
		<div class="row">
			<?php
			include("../../config/conn.php");

			$q = "SELECT * FROM `video`";

			$query = mysqli_query($conn, $q);

			while ($row = mysqli_fetch_array($query)) {

				$name = $row['name'];
			?>

				<div class="col-md-4">
					<video width="100%" controls>
						<source src="<?php echo '../../upload/' . $name; ?>">
					</video>
				</div>

			<?php }
			?>
		</div>
	</div>
</body>

</html>