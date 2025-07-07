<?php 

session_start();

require './connect.php';

if(empty($_SESSION)){
  header('Location: index.php');
  exit;
}

// Rotina para criação de Usuário no BD

if (isset($_POST['create_complemento'])) {
  $complemento = mysqli_real_escape_string($connect_db, trim($_POST['complemento'])); 
  
  $sql = "INSERT INTO complemento (nome_complemento) VALUES ('$complemento')";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Complemento adicionado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: complementos.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Complemento não foi adicionado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: complementos.php');
    exit;
  }
}

// Rotina para atualização de usuário do BD

if (isset($_POST['update_complemento'])) {
  $complemento_id = mysqli_real_escape_string($connect_db, $_POST['complementoID']);
  
  $complemento = mysqli_real_escape_string($connect_db, trim($_POST['complemento']));

  $sql = "UPDATE complemento SET nome_complemento = '$complemento'";

  $sql .= " WHERE id_complemento = '$complemento_id'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Complemento atualizado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: complementos.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Complemento não foi atualizada.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: complementos.php');
    exit;
  }
}

// Rotina para Exclusão de Usuário

if (isset($_POST['delete_complemento'])) {
  $complementoID = mysqli_real_escape_string($connect_db, $_POST['delete_complemento']);
  
  $sql = "DELETE FROM complemento WHERE id_complemento ='$complementoID'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Complemento excluído com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: complementos.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Complemento não foi excluído.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: complementos.php');
    exit;
  }
}

?>