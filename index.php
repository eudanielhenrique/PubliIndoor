<link rel="stylesheet" href="assets/css/main.css" />


<div class="box-video">

    <?php

    include("config/conn.php");

    $q = "SELECT * FROM `video`";
    $query = mysqli_query($conn, $q);
    
    while ($row = mysqli_fetch_array($query)) {
        $numero = $row['id'];
    }

    $dir = "upload/videos"; //Troque pela sua pasta relativa

    if (is_dir($dir) && $dh = opendir($dir)) {
    ?>
        <video id="player-video"></video>


        <script type="text/javascript">
            (function() {
                var playerVideo = document.getElementById("player-video");
                var current = 0;
                var videos = [];
                var red = 10;
                
                <?php while (($file = readdir($dh)) !== false) : ?>
                    <?php if (is_file($dir . '/' . $file)) : ?>

                        videos.push("<?php echo rtrim($dir, '/'), '/', $file; ?>");

                    <?php endif; ?>
                <?php endwhile; ?>

                function nextVideo() {
                    playerVideo.src = videos[current];
                    current++;
                    console.log('O current é: ' + current);
                    
                    playerVideo.play();
                    if (current >= videos.length) {
                        console.log('O numero é: ' + numero);
                    }
                    if (current == red) {
                        window.location.href = "novosFun/index.php";
                    }
                }
                playerVideo.addEventListener("ended", nextVideo);
                nextVideo();

            })();
        </script>

    <?php
        closedir($dh);
    }
    ?>
</div>