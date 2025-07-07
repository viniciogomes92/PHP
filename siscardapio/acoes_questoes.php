<?php 

session_start();

require './connect.php';

// if(empty($_SESSION)){
//   header('Location: index.php');
// }

// Rotina para criação de Usuário no BD

if (isset($_POST['create_questao'])) {
  $questao = mysqli_real_escape_string($connect_db, trim($_POST['questao'])); 
  $nip = mysqli_real_escape_string($connect_db, trim($_SESSION['nip']));
  
  // Pega a data do dia para inserir a data de Criação do Usuário
  $dataHoje = date("Y-m-d"); // Formato padrão do MySQL (DATETIME)

  $dataCriacao = mysqli_real_escape_string($connect_db, $dataHoje);

  $sql = "INSERT INTO questoes (questao, nip, data_criacao) VALUES ('$questao', '$nip', '$dataCriacao')";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Questão criada com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: questoes.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Questão não foi criada.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: questoes.php');
    exit;
  }
}

// Rotina para atualização de usuário do BD

if (isset($_POST['update_questao'])) {
  $questao_id = mysqli_real_escape_string($connect_db, $_POST['questaoID']);
  
  $questao = mysqli_real_escape_string($connect_db, trim($_POST['questao']));
  $nip = mysqli_real_escape_string($connect_db, trim($_SESSION['nip']));

  $sql = "UPDATE questoes SET questao = '$questao', nip = '$nip'";

  $sql .= " WHERE id = '$questao_id'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Questão atualizada com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: questoes.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Questão não foi atualizada.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: questoes.php');
    exit;
  }
}

// Rotina para Exclusão de Usuário

if (isset($_POST['delete_questao'])) {
  $questaoID = mysqli_real_escape_string($connect_db, $_POST['delete_questao']);
  
  $sql = "DELETE FROM questoes WHERE id ='$questaoID'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Questão excluída com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: questoes.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Questão não foi excluída.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: questoes.php');
    exit;
  }
}

if (isset($_GET['update_questoes'])) {

    $questao_id = mysqli_real_escape_string($connect_db, trim($_GET['update_questoes']));
  
    $ativa = mysqli_real_escape_string($connect_db, trim($_GET['ativa']));

    $sql = "UPDATE questoes SET ativa = '$ativa'";

    $sql .= " WHERE id = '$questao_id'";

    mysqli_query($connect_db, $sql);

    if (mysqli_affected_rows($connect_db) > 0) {
      $_SESSION['mensagem'] = "Questionário atualizado com sucesso.";
      $_SESSION['mensagem_type'] = "success";
      header('Location: questoes.php');
      exit;
    } else {
      $_SESSION['mensagem'] = "Questionário não foi atualizado.";
      $_SESSION['mensagem_type'] = "danger";
      header('Location: questoes.php');
      exit;
    }
} else {
    $_SESSION['mensagem'] = "Erro inesperado.";
    $_SESSION['mensagem_type'] = "warning";
    header('Location: questoes.php');
    exit;
}

?>