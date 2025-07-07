<?php 

  session_start();
  unset($_SESSION['nip']);
  unset($_SESSION['nome']);
  unset($_SESSION['tipo']);
  unset($_SESSION['usuarioLogado']);
  session_destroy();
  header("Location: index.php");
  exit;

?>