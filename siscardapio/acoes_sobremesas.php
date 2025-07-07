<?php 

session_start();

require './connect.php';

if(empty($_SESSION)){
  header('Location: index.php');
}

// Rotina para criação de Usuário no BD

if (isset($_POST['create_sobremesa'])) {
  $sobremesa = mysqli_real_escape_string($connect_db, trim($_POST['sobremesa'])); 
  
  $sql = "INSERT INTO sobremesa (nome_sobremesa) VALUES ('$sobremesa')";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Sobremesa adicionada com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: sobremesas.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Sobremesa não foi adicionada.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: sobremesas.php');
    exit;
  }
}

// Rotina para atualização de usuário do BD

if (isset($_POST['update_sobremesa'])) {
  $sobremesa_id = mysqli_real_escape_string($connect_db, $_POST['sobremesaID']);
  
  $sobremesa = mysqli_real_escape_string($connect_db, trim($_POST['sobremesa']));

  $sql = "UPDATE sobremesa SET nome_sobremesa = '$sobremesa'";

  $sql .= " WHERE id_sobremesa = '$sobremesa_id'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Sobremesa atualizada com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: sobremesas.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Sobremesa não foi atualizada.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: sobremesas.php');
    exit;
  }
}

// Rotina para Exclusão de Usuário

if (isset($_POST['delete_sobremesa'])) {
  $sobremesaID = mysqli_real_escape_string($connect_db, $_POST['delete_sobremesa']);
  
  $sql = "DELETE FROM sobremesa WHERE id_sobremesa ='$sobremesaID'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Guarnicão excluída com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: sobremesas.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "sobremesa não foi excluída.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: sobremesas.php');
    exit;
  }
}

?>