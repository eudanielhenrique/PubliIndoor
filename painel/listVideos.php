<?php
//including the database connection file
include("../config/conn.php");

//buscando dados em ordem crescente
$result = mysqli_query($conn, "SELECT * FROM video ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Videos sendo reproduzidos | </title>

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

</head>


<body>
    <header>
        <div class="overlay"></div>
        <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
            <source src="https://xerifexnetwork.com/IndoorGramazini/upload/ampliacao.mp4" type="video/mp4">
        </video>
        <div class="container h-100">
            <div class="d-flex h-100 text-center align-items-center">
                <div class="w-100 text-white">
                    <h1 class="display-3">Adicionar novos videos</h1>
                    <p class="lead mb-0 text-white">Aqui tera todos os informativos para os colaboradores da Gramazini!</p>
                </div>
            </div>
        </div>
    </header>
    <div class="container mt-3">
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

    <!--===============================================================================================-->
    <script src="../assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/vendor/bootstrap/js/popper.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="../assets/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/js/main.js"></script>

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