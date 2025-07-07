<?php 

session_start();

require './connect.php';

if(empty($_SESSION)){
  header('Location: index.php');
}

// Rotina para criação de Usuário no BD

if (isset($_POST['create_complementoCeia'])) {
  $complemento = mysqli_real_escape_string($connect_db, trim($_POST['complemento'])); 
  
  $sql = "INSERT INTO complemento_ceia (nome_complemento_ceia) VALUES ('$complemento')";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Complemento adicionado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: complementos_ceia.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Complemento não foi adicionado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: complementos_ceia.php');
    exit;
  }
}

// Rotina para atualização de usuário do BD

if (isset($_POST['update_complementoCeia'])) {
  $complemento_id = mysqli_real_escape_string($connect_db, $_POST['complementoID']);
  
  $complemento = mysqli_real_escape_string($connect_db, trim($_POST['complemento']));

  $sql = "UPDATE complemento_ceia SET nome_complemento_ceia = '$complemento'";

  $sql .= " WHERE id_complemento_ceia = '$complemento_id'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Complemento atualizado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: complementos_ceia.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Complemento não foi atualizada.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: complementos_ceia.php');
    exit;
  }
}

// Rotina para Exclusão de Usuário

if (isset($_POST['delete_complementoCeia'])) {
  $complementoID = mysqli_real_escape_string($connect_db, $_POST['delete_complementoCeia']);
  
  $sql = "DELETE FROM complemento_ceia WHERE id_complemento_ceia ='$complementoID'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "complemento excluída com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: complementos_ceia.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "complemento não foi excluída.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: complementos_ceia.php');
    exit;
  }
}

?>