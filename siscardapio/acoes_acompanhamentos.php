<?php 

session_start();

require './connect.php';

if(empty($_SESSION)){
  header('Location: index.php');
}

// Rotina para criação de Usuário no BD

if (isset($_POST['create_acompanhamento'])) {
  $acompanhamento = mysqli_real_escape_string($connect_db, trim($_POST['acompanhamento'])); 
  
  $sql = "INSERT INTO acompanhamento (nome_acompanhamento) VALUES ('$acompanhamento')";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Acompanhamento adicionado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: acompanhamentos.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Acompanhamento não foi adicionado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: acompanhamentos.php');
    exit;
  }
}

// Rotina para atualização de usuário do BD

if (isset($_POST['update_acompanhamento'])) {
  $acompanhamento_id = mysqli_real_escape_string($connect_db, $_POST['acompanhamentoID']);
  
  $acompanhamento = mysqli_real_escape_string($connect_db, trim($_POST['acompanhamento']));

  $sql = "UPDATE acompanhamento SET nome_acompanhamento = '$acompanhamento'";

  $sql .= " WHERE id_acompanhamento = '$acompanhamento_id'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Acompanhamento atualizado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: acompanhamentos.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Acompanhamento não foi atualizado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: acompanhamentos.php');
    exit;
  }
}

// Rotina para Exclusão de Usuário

if (isset($_POST['delete_acompanhamento'])) {
  $acompanhamentoID = mysqli_real_escape_string($connect_db, $_POST['delete_acompanhamento']);
  
  $sql = "DELETE FROM acompanhamento WHERE id_acompanhamento ='$acompanhamentoID'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Guarnicão excluída com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: acompanhamentos.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Acompanhamento não foi excluída.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: acompanhamentos.php');
    exit;
  }
}

?>