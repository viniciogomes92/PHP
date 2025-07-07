<?php 

session_start();

require './connect.php';

if(empty($_SESSION)){
  header('Location: index.php');
}

// Rotina para criação de Usuário no BD

if (isset($_POST['create_gestor_munic'])) {  

    $sql = "SELECT * FROM gestores_munic WHERE nip_gestor_municiamento = '" . $_POST['nipGestorMunic'] . "';";

    $resultQuery = mysqli_query($connect_db, $sql);

    if (mysqli_num_rows($resultQuery) > 0) {
        $gestorMunic = mysqli_fetch_assoc($resultQuery);
        // Torna todos os Agentes Fiscais Inativos
        $sql = "UPDATE gestores_munic
                SET status = 'I'
                WHERE status = 'A';";
        mysqli_query($connect_db, $sql);
        updateGestorMunic($gestorMunic['nip_gestor_municiamento'], $connect_db);
        exit;
    }

    $patternNip = "/[0-9]/";
    $validaNip = preg_match($patternNip, $_POST['nipGestorMunic']); 
    if (!empty(trim($_POST['nipGestorMunic'])) && ($validaNip === 1)) {
    $nip = mysqli_real_escape_string($connect_db, trim($_POST['nipGestorMunic']));
    } else {
    $_SESSION['mensagem'] = "Gestor de Municiamento não foi configurado, favor informar um NIP válido.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
    }

    if (!(trim($_POST['selectPGGestorMunic']) === "Escolha")) {
    $pg = mysqli_real_escape_string($connect_db, trim($_POST['selectPGGestorMunic']));
    } else {
    $_SESSION['mensagem'] = "Gestor de Municiamento não foi configurado, favor informar um Posto/Graduação.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
    }

    if (isset($_POST['selectQC'])) {
      if (!(trim($_POST['selectQC']) === "Escolha")) {
        $corpoQC = mysqli_real_escape_string($connect_db, trim($_POST['selectQC']));
      } else {
        $_SESSION['mensagem'] = "Gestor de Municiamento não foi configurado, favor informar um Corpo/Quadro.";
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
        $_SESSION['mensagem'] = "Gestor de Municiamento não foi configurado, favor informar um Corpo/Quadro.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: config.php');
        exit;
      }
    } else {
      $corpoC = '';
    }

    $corpo = $corpoQC === '' ? $corpoC : $corpoQC;

    if (isset($_POST['espGestorMunic']) && $_POST['espGestorMunic'] !== '') {
      if (!empty($_POST['espGestorMunic'])) {
        $esp = mysqli_real_escape_string($connect_db, trim($_POST['espGestorMunic']));
      } else {
        $_SESSION['mensagem'] = "Gestor de Municiamento não foi configurado, favor informar uma Especialidade.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: config.php');
        exit;
      }
    } else {
      $esp = '';
    }

    if (!empty($_POST['nomeCompletoGestorMunic'])) {
    $nomeCompleto = mysqli_real_escape_string($connect_db, trim($_POST['nomeCompletoGestorMunic']));
    } else {
    $_SESSION['mensagem'] = "Gestor de Municiamento não foi configurado, favor informar nome completo.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
    }

    if (!empty($_POST['nomeGuerraGestorMunic'])) {
    $nomeGuerra = mysqli_real_escape_string($connect_db, trim($_POST['nomeGuerraGestorMunic']));
    } else {
    $_SESSION['mensagem'] = "Gestor de Municiamento não foi configurado, favor informar nome de guerra.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
    }

    if (!empty($_POST['emailGestorMunic'])) {
    $emailGestorMunic = mysqli_real_escape_string($connect_db, trim($_POST['emailGestorMunic']));
    } else {
    $_SESSION['mensagem'] = "Gestor de Municiamento não foi configurado, favor informar email.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
    }

    // Pega a data do dia para inserir a data de Criação do Usuário
    $dataHoje = date("Y-m-d"); // Formato padrão do MySQL (DATETIME)

    $dataCriacao = mysqli_real_escape_string($connect_db, $dataHoje);

    // Torna todos os Agentes Fiscais Inativos
    $sql = "UPDATE gestores_munic
            SET status = 'I'
            WHERE status = 'A';";

    mysqli_query($connect_db, $sql);

    $sql = "INSERT INTO gestores_munic (nip_gestor_municiamento, posto_graduacao, corpo_quadro, esp, nome_guerra, nome_gestor_munic, email_gestor_munic, data_criacao) VALUES ('$nip', '$pg', '$corpo', '$esp', '$nomeGuerra','$nomeCompleto', '$emailGestorMunic', '$dataCriacao')";

    mysqli_query($connect_db, $sql);

    if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Gestor de Municiamento configurado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: config.php');
    exit;
    } else {
    $_SESSION['mensagem'] = "Gestor de Municiamento não foi configurado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
    }
}

// Rotina para atualização de GestorMunic no BD

function updateGestorMunic ($nip, $connect_db) {
  $nip = mysqli_real_escape_string($connect_db, $nip);
  
  if (!(trim($_POST['selectPGGestorMunic']) === "Escolha")) {
    $pg = mysqli_real_escape_string($connect_db, trim($_POST['selectPGGestorMunic']));
  } else {
    $_SESSION['mensagem'] = "GestorMunic existe, mas não foi configurado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
  }

  if (isset($_POST['selectQC'])) {
    if (!(trim($_POST['selectQC']) === "Escolha")) {
      $corpoQC = mysqli_real_escape_string($connect_db, trim($_POST['selectQC']));
    } else {
      $_SESSION['mensagem'] = "Gestor de Municiamento não foi configurado, favor informar um Corpo/Quadro.";
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
      $_SESSION['mensagem'] = "Gestor de Municiamento não foi configurado, favor informar um Corpo/Quadro.";
      $_SESSION['mensagem_type'] = "danger";
      header('Location: config.php');
      exit;
    }
  } else {
    $corpoC = '';
  }

  $corpo = $corpoQC === '' ? $corpoC : $corpoQC;

  if (isset($_POST['espGestorMunic'])) {
    if (!empty($_POST['espGestorMunic'])) {
      $esp = mysqli_real_escape_string($connect_db, trim($_POST['espGestorMunic']));
    } else {
      $_SESSION['mensagem'] = "Gestor de Municiamento não foi configurado, favor informar uma Especialidade.";
      $_SESSION['mensagem_type'] = "danger";
      header('Location: config.php');
      exit;
    }
  } else {
    $esp = '';
  }

  $nomeCompleto = mysqli_real_escape_string($connect_db, trim($_POST['nomeCompletoGestorMunic']));
  $nomeGuerra = mysqli_real_escape_string($connect_db, trim($_POST['nomeGuerraGestorMunic']));
  $email = mysqli_real_escape_string($connect_db, trim($_POST['emailGestorMunic']));

  $sql = "UPDATE gestores_munic SET posto_graduacao = '$pg', corpo_quadro='$corpo', esp='$esp', nome_guerra = '$nomeGuerra', nome_gestor_munic = '$nomeCompleto', email_gestor_munic='$email', status='A' WHERE nip_gestor_municiamento = '$nip'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Gestor de Municiamento atualizado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: config.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Gestor de Municiamento não foi atualizado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
  }
}

?>