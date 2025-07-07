<?php 

session_start();

require './connect.php';

if(empty($_SESSION)){
  header('Location: index.php');
}

// Rotina para criação de Usuário no BD

if (isset($_POST['create_ceia'])) {
  $ceia = mysqli_real_escape_string($connect_db, trim($_POST['ceia'])); 
  
  $sql = "INSERT INTO ceia (nome_ceia) VALUES ('$ceia')";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Ceia adicionada com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: ceias.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Ceia não foi adicionada.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: ceias.php');
    exit;
  }
}

// Rotina para atualização de usuário do BD

if (isset($_POST['update_ceia'])) {
  $ceia_id = mysqli_real_escape_string($connect_db, $_POST['ceiaID']);
  
  $ceia = mysqli_real_escape_string($connect_db, trim($_POST['ceia']));

  $sql = "UPDATE ceia SET nome_ceia = '$ceia'";

  $sql .= " WHERE id_ceia = '$ceia_id'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Ceia atualizada com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: ceias.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Ceia não foi atualizada.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: ceias.php');
    exit;
  }
}

// Rotina para Exclusão de Usuário

if (isset($_POST['delete_ceia'])) {
  $ceiaID = mysqli_real_escape_string($connect_db, $_POST['delete_ceia']);

  $sql = "DELETE FROM ceia WHERE id_ceia ='$ceiaID'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Ceia excluída com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: ceias.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Ceia não foi excluída.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: ceias.php');
    exit;
  }
}

?>