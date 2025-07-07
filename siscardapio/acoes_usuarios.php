<?php 

session_start();

require './connect.php';

// Rotina para criação de Usuário no BD



if (isset($_POST['create_usuario'])) {
  $nip = mysqli_real_escape_string($connect_db, trim($_POST['nip']));
  if (!(trim($_POST['pg']) === "Escolha...")) {
    $pg = mysqli_real_escape_string($connect_db, trim($_POST['pg']));
  } else {
    $_SESSION['mensagem'] = "Usuário não foi criado, favor informar um Posto/Graduação.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: usuarios.php');
    exit;
  }
  $nomeCompleto = mysqli_real_escape_string($connect_db, trim($_POST['nomeCompleto']));
  $nomeGuerra = mysqli_real_escape_string($connect_db, trim($_POST['nomeGuerra']));
  $email = mysqli_real_escape_string($connect_db, trim($_POST['email']));
  $dataNascimento = mysqli_real_escape_string($connect_db, trim($_POST['dataNascimento']));
  
  // Pega a data do dia para inserir a data de Criação do Usuário
  $dataHoje = date("Y-m-d"); // Formato padrão do MySQL (DATETIME)

  $dataCriacao = mysqli_real_escape_string($connect_db, $dataHoje);
  $senha = isset($_POST['senha']) ? mysqli_real_escape_string($connect_db, password_hash(trim($_POST['senha']), PASSWORD_DEFAULT)) : '';
  $tipo = mysqli_real_escape_string($connect_db, trim($_POST['tipo']));

  $sql = "INSERT INTO usuarios (nip, posto_graduacao, nome_guerra, nome_completo, email, data_nascimento, senha, data_criacao, tipo) VALUES ('$nip', '$pg', '$nomeGuerra','$nomeCompleto', '$email', '$dataNascimento', '$senha', '$dataCriacao', '$tipo')";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Usuário criado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    if (!$_POST['semLogin'] === 'Sim') {
      header('Location: usuarios.php');
      exit;
    } else {
      header('Location: index.php');
      exit;
    }
  } else {
    $_SESSION['mensagem'] = "Usuário não foi criado.";
    $_SESSION['mensagem_type'] = "danger";
    if (!$_POST['semLogin'] === 'Sim') {
      header('Location: usuarios.php');
      exit;
    } else {
      header('Location: index.php');
      exit;
    }
  }
}

// Rotina para atualização de usuário do BD

if (isset($_POST['update_usuario'])) {
  $usuarioNIP = mysqli_real_escape_string($connect_db, $_POST['usuarioNIP']);
  
  // var_dump($_POST['pg']);
  // exit;
  if (!(trim($_POST['pg']) === "Escolha...")) {
    $pg = mysqli_real_escape_string($connect_db, trim($_POST['pg']));
  } else {
    $_SESSION['mensagem'] = "Usuário não foi atualizado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: usuarios.php');
    exit;
  }
  $nomeCompleto = mysqli_real_escape_string($connect_db, trim($_POST['nomeCompleto']));
  $nomeGuerra = mysqli_real_escape_string($connect_db, trim($_POST['nomeGuerra']));
  $email = mysqli_real_escape_string($connect_db, trim($_POST['email']));
  $dataNascimento = mysqli_real_escape_string($connect_db, trim($_POST['dataNascimento']));
  $senha = mysqli_real_escape_string($connect_db, trim($_POST['senha']));

  $sql = "UPDATE usuarios SET posto_graduacao = '$pg', nome_guerra = '$nomeGuerra', nome_completo = '$nomeCompleto', email='$email', data_nascimento='$dataNascimento'";

  if (!empty($senha)) {
    $sql .= ", senha='" . password_hash($senha, PASSWORD_DEFAULT) . "'";
  }

  $sql .= " WHERE nip = '$usuarioNIP'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Usuário atualizado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: usuarios.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Usuário não foi atualizado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: usuarios.php');
    exit;
  }
}

// Rotina para Exclusão de Usuário

if (isset($_POST['delete_usuario'])) {
  $usuarioNIP = mysqli_real_escape_string($connect_db, $_POST['delete_usuario']);
  
  $sql = "DELETE FROM usuarios WHERE nip ='$usuarioNIP'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Usuário excluído com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: usuarios.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Usuário não foi excluído.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: usuarios.php');
    exit;
  }
}

?>