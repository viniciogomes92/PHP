<?php 

session_start();

require './connect.php';

if(empty($_SESSION)){
  header('Location: index.php');
}

// Rotina para criação de Usuário no BD

if (isset($_POST['create_cafe'])) {
  $cafe = mysqli_real_escape_string($connect_db, trim($_POST['cafe'])); 
  
  $sql = "INSERT INTO cafe (nome_cafe) VALUES ('$cafe')";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Café da Manhã adicionado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: cafes.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Café da Manhã não foi adicionado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: cafes.php');
    exit;
  }
}

// Rotina para atualização de usuário do BD

if (isset($_POST['update_cafe'])) {
  $cafe_id = mysqli_real_escape_string($connect_db, $_POST['cafeID']);
  
  $cafe = mysqli_real_escape_string($connect_db, trim($_POST['cafe']));

  $sql = "UPDATE cafe SET nome_cafe = '$cafe'";

  $sql .= " WHERE id_cafe = '$cafe_id'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Café atualizado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: cafes.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Café não foi atualizada.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: cafes.php');
    exit;
  }
}

// Rotina para Exclusão de Usuário

if (isset($_POST['delete_cafe'])) {
  $cafeID = mysqli_real_escape_string($connect_db, $_POST['delete_cafe']);
  
  $sql = "DELETE FROM cafe WHERE id_cafe ='$cafeID'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Café excluído com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: cafes.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Café não foi excluído.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: cafes.php');
    exit;
  }
}

?>