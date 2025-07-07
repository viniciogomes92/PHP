<?php 

session_start();

require './connect.php';

if(empty($_SESSION)){
  header('Location: index.php');
}

// Rotina para criação de Usuário no BD

if (isset($_POST['create_pratoPrincipal'])) {
  $pratoPrincipal = mysqli_real_escape_string($connect_db, trim($_POST['pratoPrincipal'])); 
  
  $sql = "INSERT INTO prato_principal (nome_prato_principal) VALUES ('$pratoPrincipal')";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Prato Principal adicionado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: pratosPrincipais.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Prato Principal não foi adicionado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: pratosPrincipais.php');
    exit;
  }
}

// Rotina para atualização de usuário do BD

if (isset($_POST['update_pratoPrincipal'])) {
  $pratoPrincipal_id = mysqli_real_escape_string($connect_db, $_POST['pratoPrincipalID']);
  
  $pratoPrincipal = mysqli_real_escape_string($connect_db, trim($_POST['pratoPrincipal']));

  $sql = "UPDATE prato_principal SET nome_prato_principal = '$pratoPrincipal'";

  $sql .= " WHERE id_prato_principal = '$pratoPrincipal_id'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Prato Principal atualizado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: pratosPrincipais.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Prato Principal não foi atualizado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: pratosPrincipais.php');
    exit;
  }
}

// Rotina para Exclusão de Usuário

if (isset($_POST['delete_pratoPrincipal'])) {
  $pratoPrincipalID = mysqli_real_escape_string($connect_db, $_POST['delete_pratoPrincipal']);
  
  $sql = "DELETE FROM prato_principal WHERE id_prato_principal ='$pratoPrincipalID'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Prato Principal excluído com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: pratosPrincipais.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Prato Principal não foi excluído.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: pratosPrincipais.php');
    exit;
  }
}

?>