<?php 

session_start();

require './connect.php';

if(empty($_SESSION)){
  header('Location: index.php');
}

// Rotina para criação de Usuário no BD

if (isset($_POST['create_entrada'])) {
  $entrada = mysqli_real_escape_string($connect_db, trim($_POST['entrada'])); 
  
  $sql = "INSERT INTO entrada (nome_entrada) VALUES ('$entrada')";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Entrada adicionada com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: entradas.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Entrada não foi adicionada.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: entradas.php');
    exit;
  }
}

// Rotina para atualização de usuário do BD

if (isset($_POST['update_entrada'])) {
  $entrada_id = mysqli_real_escape_string($connect_db, $_POST['entradaID']);
  
  $entrada = mysqli_real_escape_string($connect_db, trim($_POST['entrada']));

  $sql = "UPDATE entrada SET nome_entrada = '$entrada'";

  $sql .= " WHERE id_entrada = '$entrada_id'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Entrada atualizada com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: entradas.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Entrada não foi atualizada.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: entradas.php');
    exit;
  }
}

// Rotina para Exclusão de Usuário

if (isset($_POST['delete_entrada'])) {
  $entradaID = mysqli_real_escape_string($connect_db, $_POST['delete_entrada']);
  
  $sql = "DELETE FROM entrada WHERE id_entrada ='$entradaID'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Entrada excluída com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: entradas.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Entrada não foi excluída.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: entradas.php');
    exit;
  }
}

?>