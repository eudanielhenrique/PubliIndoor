<?php
//Conecção ao banco de dados
include("../../config/conn.php");

//Obtendo id dos dados do url
$usuario = ($_POST['usuario']);
$senha = ($_POST['senha']);
$_SESSION['UsuarioNivel'] = $resultado['nivel'];

// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) and (empty($_POST['usuario']) or empty($_POST['senha']))) {
    header("Location: ../index.php");
    exit;
}

// Validação do usuário/senha digitados
$sql = "SELECT `id`, `nome`, `nivel` FROM `usuarios` WHERE (`usuario` = '" . $usuario . "') AND (`senha` = '" . sha1($senha) . "') AND (`ativo` = 1) LIMIT 1";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) != 1) {
    // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
    echo "Login inválido!";
    exit;
} else {
    // Salva os dados encontrados na variável $resultado
    $resultado = mysqli_fetch_assoc($query);

    // Se a sessão não existir, inicia uma
    if (!isset($_SESSION)) session_start();

    echo '<script>';
    echo 'console.log("Logado com sucesso")';
    echo '</script>';

    //Salva os dados encontrados na sessão
    $_SESSION['UsuarioID'] = $resultado['id'];
    $_SESSION['UsuarioNome'] = $resultado['nome'];
    $_SESSION['UsuarioNivel'] = $resultado['nivel'];

    //Redireciona o visitante
    echo '<meta http-equiv="refresh" content="5;url=../painel.php">';

    exit;
}
