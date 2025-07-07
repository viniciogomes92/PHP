<?php 

session_start();

require './connect.php';

if ((empty($_POST)) || (empty(trim($_POST['nip']))) || (empty(trim($_POST['senha'])))) {
    $_SESSION['mensagem'] = "Favor preencher os campos \"NIP\" e \"Senha\".";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: index.php');
    exit;
}

$nip = $_POST['nip'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE nip='" . mysqli_real_escape_string($connect_db, $nip) . "'";

$usuarioQuery = mysqli_query($connect_db, $sql);

if (!$usuarioQuery) {
    die("Erro na query: " . mysqli_error($connect_db));
}

$dadosUsuario = mysqli_fetch_assoc($usuarioQuery);

if ($dadosUsuario && password_verify($senha, $dadosUsuario['senha'])) {
    $_SESSION['nip'] = $nip;
    $_SESSION['pg'] = $dadosUsuario['posto_graduacao'];
    $_SESSION['nomeGuerra'] = $dadosUsuario['nome_guerra'];
    $_SESSION['nomeCompleto'] = $dadosUsuario['nome_completo'];
    $_SESSION['tipo'] = $dadosUsuario['tipo'];
    $_SESSION['usuarioLogado'] = true;
    header('Location: dashboard.php');
    exit;
} else {
    $_SESSION['mensagem'] = "Login inválido, favor verificar NIP e senha.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: index.php');
    exit;
}
?>
