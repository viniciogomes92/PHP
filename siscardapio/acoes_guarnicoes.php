<?php 

session_start();

require './connect.php';

if(empty($_SESSION)){
  header('Location: index.php');
}

// Rotina para criação de Usuário no BD

if (isset($_POST['create_guarnicao'])) {
  $guarnicao = mysqli_real_escape_string($connect_db, trim($_POST['guarnicao'])); 
  
  $sql = "INSERT INTO guarnicao (nome_guarnicao) VALUES ('$guarnicao')";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Guarnição adicionada com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: guarnicoes.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Guarnição não foi adicionado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: guarnicoes.php');
    exit;
  }
}

// Rotina para atualização de usuário do BD

if (isset($_POST['update_guarnicao'])) {
  $guarnicao_id = mysqli_real_escape_string($connect_db, $_POST['guarnicaoID']);
  
  $guarnicao = mysqli_real_escape_string($connect_db, trim($_POST['guarnicao']));

  $sql = "UPDATE guarnicao SET nome_guarnicao = '$guarnicao'";

  $sql .= " WHERE id_guarnicao = '$guarnicao_id'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Guarnição atualizada com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: guarnicoes.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Guarnição não foi atualizado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: guarnicoes.php');
    exit;
  }
}

// Rotina para Exclusão de Usuário

if (isset($_POST['delete_guarnicao'])) {
  $guarnicaoID = mysqli_real_escape_string($connect_db, $_POST['delete_guarnicao']);
  
  $sql = "DELETE FROM guarnicao WHERE id_guarnicao ='$guarnicaoID'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Guarnicão excluída com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: guarnicoes.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Guarnição não foi excluída.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: guarnicoes.php');
    exit;
  }
}

?>