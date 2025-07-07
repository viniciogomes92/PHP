<?php 

session_start();

require './connect.php';

if(empty($_SESSION)){
  header('Location: index.php');
}

// Rotina para criação de Usuário no BD

if (isset($_POST['create_nutri'])) {  

    $sql = "SELECT * FROM nutricionistas WHERE nip_nutricionista = '" . $_POST['nipNutri'] . "';";

    $resultQuery = mysqli_query($connect_db, $sql);

    if (mysqli_num_rows($resultQuery) > 0) {
        $nutricionista = mysqli_fetch_assoc($resultQuery);
        // Torna todos os Nutricionistas Inativos
        $sql = "UPDATE nutricionistas
                SET status = 'I'
                WHERE status = 'A';";
        mysqli_query($connect_db, $sql);
        updateNutri($nutricionista['nip_nutricionista'], $connect_db);
        exit;
    }

    $patternNip = "/[0-9]/";
    $validaNip = preg_match($patternNip, $_POST['nipNutri']); 
    if (!empty(trim($_POST['nipNutri'])) && ($validaNip === 1)) {
    $nip = mysqli_real_escape_string($connect_db, trim($_POST['nipNutri']));
    } else {
    $_SESSION['mensagem'] = "Nutricionista não foi configurado, favor informar um NIP válido.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
    }

    if (!(trim($_POST['selectPGNutri']) === "Escolha")) {
      $pg = mysqli_real_escape_string($connect_db, trim($_POST['selectPGNutri']));
      } else {
      $_SESSION['mensagem'] = "Nutricionista não foi configurado, favor informar um Posto/Graduação.";
      $_SESSION['mensagem_type'] = "danger";
      header('Location: config.php');
      exit;
      }

    if (isset($_POST['selectQC'])) {
      if (!(trim($_POST['selectQC']) === "Escolha")) {
        $corpoQC = mysqli_real_escape_string($connect_db, trim($_POST['selectQC']));
      } else {
        $_SESSION['mensagem'] = "Nutricionista não foi configurado, favor informar um Corpo/Quadro.";
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
        $_SESSION['mensagem'] = "Nutricionista não foi configurado, favor informar um Corpo/Quadro.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: config.php');
        exit;
      }
    } else {
      $corpoC = '';
    }

    $corpo = $corpoQC === '' ? $corpoC : $corpoQC;

    if (isset($_POST['espNutri']) && $_POST['espNutri'] !== '') {
      if (!empty($_POST['espNutri'])) {
        $esp = mysqli_real_escape_string($connect_db, trim($_POST['espNutri']));
      } else {
        $_SESSION['mensagem'] = "Nutricionista não foi configurado, favor informar uma Especialidade.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: config.php');
        exit;
      }
    } else {
      $esp = '';
    }

    if (!empty($_POST['nomeCompletoNutri'])) {
    $nomeCompleto = mysqli_real_escape_string($connect_db, trim($_POST['nomeCompletoNutri']));
    } else {
    $_SESSION['mensagem'] = "Nutricionista não foi configurado, favor informar nome completo.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
    }

    if (!empty($_POST['nomeGuerraNutri'])) {
    $nomeGuerra = mysqli_real_escape_string($connect_db, trim($_POST['nomeGuerraNutri']));
    } else {
    $_SESSION['mensagem'] = "Nutricionista não foi configurado, favor informar nome de guerra.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
    }

    if (!empty($_POST['emailNutri'])) {
    $emailNutri = mysqli_real_escape_string($connect_db, trim($_POST['emailNutri']));
    } else {
    $_SESSION['mensagem'] = "Nutricionista não foi configurado, favor informar email.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
    }

    // Pega a data do dia para inserir a data de Criação do Usuário
    $dataHoje = date("Y-m-d"); // Formato padrão do MySQL (DATETIME)

    $dataCriacao = mysqli_real_escape_string($connect_db, $dataHoje);

    // Torna todos os Agentes Fiscais Inativos
    $sql = "UPDATE nutricionistas
            SET status = 'I'
            WHERE status = 'A';";

    mysqli_query($connect_db, $sql);

    $sql = "INSERT INTO nutricionistas (nip_nutricionista, posto_graduacao, corpo_quadro, esp, nome_guerra, nome_nutricionista, email_nutricionista, data_criacao) VALUES ('$nip', '$pg', '$corpo', '$esp', '$nomeGuerra','$nomeCompleto', '$emailNutri', '$dataCriacao')";

    mysqli_query($connect_db, $sql);

    if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Nutricionista configurado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: config.php');
    exit;
    } else {
    $_SESSION['mensagem'] = "Nutricionista não foi configurado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
    }
}

// Rotina para atualização de Nutricionista no BD

function updateNutri ($nip, $connect_db) {
  $nip = mysqli_real_escape_string($connect_db, $nip);
  
  if (!(trim($_POST['selectPGNutri']) === "Escolha")) {
    $pg = mysqli_real_escape_string($connect_db, trim($_POST['selectPGNutri']));
  } else {
    $_SESSION['mensagem'] = "Nutricionista existe, mas não foi configurado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
  }

  if (isset($_POST['selectQC'])) {
    if (!(trim($_POST['selectQC']) === "Escolha")) {
      $corpoQC = mysqli_real_escape_string($connect_db, trim($_POST['selectQC']));
    } else {
      $_SESSION['mensagem'] = "Nutricionista não foi configurado, favor informar um Corpo/Quadro.";
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
      $_SESSION['mensagem'] = "Nutricionista não foi configurado, favor informar um Corpo/Quadro.";
      $_SESSION['mensagem_type'] = "danger";
      header('Location: config.php');
      exit;
    }
  } else {
    $corpoC = '';
  }

  $corpo = $corpoQC === '' ? $corpoC : $corpoQC;

  if (isset($_POST['espNutri'])) {
    if (!empty($_POST['espNutri'])) {
      $esp = mysqli_real_escape_string($connect_db, trim($_POST['espNutri']));
    } else {
      $_SESSION['mensagem'] = "Nutricionista não foi configurado, favor informar uma Especialidade.";
      $_SESSION['mensagem_type'] = "danger";
      header('Location: config.php');
      exit;
    }
  } else {
    $esp = '';
  }

  $nomeCompleto = mysqli_real_escape_string($connect_db, trim($_POST['nomeCompletoNutri']));
  $nomeGuerra = mysqli_real_escape_string($connect_db, trim($_POST['nomeGuerraNutri']));
  $email = mysqli_real_escape_string($connect_db, trim($_POST['emailNutri']));

  $sql = "UPDATE nutricionistas SET posto_graduacao = '$pg', corpo_quadro= '$corpo', esp= '$esp', nome_guerra = '$nomeGuerra', nome_nutricionista = '$nomeCompleto', email_nutricionista='$email', status='A' WHERE nip_nutricionista = '$nip'";

  mysqli_query($connect_db, $sql);

  if (mysqli_affected_rows($connect_db) > 0) {
    $_SESSION['mensagem'] = "Nutricionista atualizado com sucesso.";
    $_SESSION['mensagem_type'] = "success";
    header('Location: config.php');
    exit;
  } else {
    $_SESSION['mensagem'] = "Nutricionista não foi atualizado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: config.php');
    exit;
  }
}

?>