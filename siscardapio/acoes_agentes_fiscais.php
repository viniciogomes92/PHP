<?php 

session_start();

require './connect.php';

if(empty($_SESSION)){
  header('Location: index.php');
}

// Rotina para criação de Usuário no BD

if (isset($_POST['create_agente_fiscal'])) {  

  $sql = "SELECT * FROM agentes_fiscais WHERE nip_agente_fiscal = '" . $_POST['nipAgenteFiscal'] . "';";

  $resultQuery = mysqli_query($connect_db, $sql);

  if (mysqli_num_rows($resultQuery) > 0) {
    $agenteFiscal = mysqli_fetch_assoc($resultQuery);
    // Torna todos os Agentes Fiscais Inativos
    $sql = "UPDATE agentes_fiscais
            SET status = 'I'
            WHERE status = 'A';";
    mysqli_query($connect_db, $sql);
    updateAgenteFiscal($agenteFiscal['nip_agente_fiscal'], $connect_db);
    exit;
  }

  $patternNip = "/[0-9]/";
  $validaNip = preg_match($patternNip, $_POST['nipAgenteFiscal']); 
  if (!empty(trim($_POST['nipAgenteFiscal'])) && ($validaNip === 1)) {
    $nip = mysqli_real_escape_string($connect_db, trim($_POST['nipAgenteFiscal']));
  } else {
    $_SESSION['mensagem'] = "Agente Fiscal não foi configurado, favor informar um NIP válido.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
  }
    
  if (!(trim($_POST['selectPGAgenteFiscal']) === "Escolha")) {
    $pg = mysqli_real_escape_string($connect_db, trim($_POST['selectPGAgenteFiscal']));
  } else {
    $_SESSION['mensagem'] = "Agente Fiscal não foi configurado, favor informar um Posto/Graduação.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
  }

  if (isset($_POST['selectQC'])) {
    if (!(trim($_POST['selectQC']) === "Escolha")) {
      $corpoQC = mysqli_real_escape_string($connect_db, trim($_POST['selectQC']));
    } else {
      $_SESSION['mensagem'] = "Agente Fiscal não foi configurado, favor informar um Corpo/Quadro.";
      $_SESSION['mensagem_type'] = "danger";
      header('Location: config.php');
      exit;
    }
  } else {
    $corpoQC = '';
  }

  if (isset($_POST['selectC'])) {
    if (!(trim($_POST['selectC']) === "Escolha")) {
      $corpoC = mysqli_real_escape_string($connect_db, trim($_POST['selectC']));
    } else {
      $_SESSION['mensagem'] = "Agente Fiscal não foi configurado, favor informar um Corpo/Quadro.";
      $_SESSION['mensagem_type'] = "danger";
      header('Location: config.php');
      exit;
    }
  } else {
    $corpoC = '';
  }

  $corpo = $corpoQC === '' ? $corpoC : $corpoQC;

  if (isset($_POST['espAgenteFiscal']) && $_POST['espAgenteFiscal'] !== '') {
    if (!empty($_POST['espAgenteFiscal'])) {
      $esp = mysqli_real_escape_string($connect_db, trim($_POST['espAgenteFiscal']));
    } else {
      $_SESSION['mensagem'] = "Agente Fiscal não foi configurado, favor informar uma Especialidade.";
      $_SESSION['mensagem_type'] = "danger";
      header('Location: config.php');
      exit;
    }
  } else {
    $esp = '';
  }

  if (!empty($_POST['nomeCompletoAgenteFiscal'])) {
    $nomeCompleto = mysqli_real_escape_string($connect_db, trim($_POST['nomeCompletoAgenteFiscal']));
  } else {
    $_SESSION['mensagem'] = "Agente Fiscal não foi configurado, favor informar nome completo.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
  }

  if (!empty($_POST['nomeGuerraAgenteFiscal'])) {
    $nomeGuerra = mysqli_real_escape_string($connect_db, trim($_POST['nomeGuerraAgenteFiscal']));
  } else {
    $_SESSION['mensagem'] = "Agente Fiscal não foi configurado, favor informar nome de guerra.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
  }

  if (!empty($_POST['emailAgenteFiscal'])) {
    $emailAgenteFiscal = mysqli_real_escape_string($connect_db, trim($_POST['emailAgenteFiscal']));
  } else {
    $_SESSION['mensagem'] = "Agente Fiscal não foi configurado, favor informar email.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
  }
  
  // Pega a data do dia para inserir a data de Criação do Agente Fiscal
  $dataHoje = date("Y-m-d"); // Formato padrão do MySQL (DATETIME)

  $dataCriacao = mysqli_real_escape_string($connect_db, $dataHoje);

  // Torna todos os Agentes Fiscais Inativos
  $sql = "UPDATE agentes_fiscais
          SET status = 'I'
          WHERE status = 'A';";
  mysqli_query($connect_db, $sql);

  $sql = "INSERT INTO agentes_fiscais (nip_agente_fiscal, posto_graduacao, corpo_quadro, esp, nome_guerra, nome_agente_fiscal, email_agente_fiscal, data_criacao) VALUES ('$nip', '$pg', '$corpo', '$esp', '$nomeGuerra','$nomeCompleto', '$emailAgenteFiscal', '$dataCriacao')";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Agente Fiscal configurado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: config.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Agente Fiscal não foi configurado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
  }
}

// Rotina para atualização de Agente Fiscal no BD

function updateAgenteFiscal ($nip, $connect_db) {
  $nip = mysqli_real_escape_string($connect_db, $nip);
  
  if (!(trim($_POST['selectPGAgenteFiscal']) === "Escolha")) {
    $pg = mysqli_real_escape_string($connect_db, trim($_POST['selectPGAgenteFiscal']));
  } else {
    $_SESSION['mensagem'] = "Agente Fiscal existe, mas não foi configurado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
  }

  if (isset($_POST['selectQC'])) {
    if (!(trim($_POST['selectQC']) === "Escolha")) {
      $corpoQC = mysqli_real_escape_string($connect_db, trim($_POST['selectQC']));
    } else {
      $_SESSION['mensagem'] = "Agente Fiscal não foi configurado, favor informar um Corpo/Quadro.";
      $_SESSION['mensagem_type'] = "danger";
      header('Location: config.php');
      exit;
    }
  } else {
    $corpoQC = '';
  }

  if (isset($_POST['selectC'])) {
    if (!(trim($_POST['selectC']) === "Escolha")) {
      $corpoC = mysqli_real_escape_string($connect_db, trim($_POST['selectC']));
    } else {
      $_SESSION['mensagem'] = "Agente Fiscal não foi configurado, favor informar um Corpo/Quadro.";
      $_SESSION['mensagem_type'] = "danger";
      header('Location: config.php');
      exit;
    }
  } else {
    $corpoC = '';
  }

  $corpo = $corpoQC === '' ? $corpoC : $corpoQC;

  if (isset($_POST['espAgenteFiscal'])) {
    if (!empty($_POST['espAgenteFiscal'])) {
      $esp = mysqli_real_escape_string($connect_db, trim($_POST['espAgenteFiscal']));
    } else {
      $_SESSION['mensagem'] = "Agente Fiscal não foi configurado, favor informar uma Especialidade.";
      $_SESSION['mensagem_type'] = "danger";
      header('Location: config.php');
      exit;
    }
  } else {
    $esp = '';
  }

  $nomeCompleto = mysqli_real_escape_string($connect_db, trim($_POST['nomeCompletoAgenteFiscal']));
  $nomeGuerra = mysqli_real_escape_string($connect_db, trim($_POST['nomeGuerraAgenteFiscal']));
  $email = mysqli_real_escape_string($connect_db, trim($_POST['emailAgenteFiscal']));

  $sql = "UPDATE agentes_fiscais SET posto_graduacao = '$pg', corpo_quadro = '$corpo', esp = '$esp',nome_guerra = '$nomeGuerra', nome_agente_fiscal = '$nomeCompleto', email_agente_fiscal='$email', status='A' WHERE nip_agente_fiscal = '$nip'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Agente Fiscal atualizado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: config.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Agente Fiscal não foi atualizado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
  }
}