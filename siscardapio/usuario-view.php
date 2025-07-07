<?php 

session_start();
require ("./connect.php");


if(empty($_SESSION)){
  header('Location: index.php');
} elseif ($_SESSION['tipo'] !== 'A') {
  header('Location: dashboard.php');
}

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuário - Visualizar</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/heraldica_bamrj.png">
    <link href="./css/bootstrap/bootstrap.css" rel="stylesheet">
  </head>
  <body>
    <?php 
    
    include "./navbar.php";
    
    ?>
    
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Dados do Usuário
                <a href="./usuarios.php" class="btn btn-danger float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
              <?php 
              if(isset($_GET['nip'])) {
                $usuario_id = mysqli_real_escape_string($connect_db, $_GET['nip']);
                $sql = "SELECT * FROM usuarios WHERE nip='$usuario_id'";
                $query = mysqli_query($connect_db, $sql);

                if (mysqli_num_rows($query) > 0) {
                  $usuario = mysqli_fetch_array($query);
                
              ?>
                  <div class="mb-3">
                    <div class="mb-3">
                      <label class="fw-bold">NIP</label>
                      <p class="form-control">
                        <?= $usuario['nip'] ?>
                      </p>
                    </div>
                    <div class="mb-3">
                      <label class="fw-bold">Posto/Graduação</label>
                      <p class="form-control">
                        <?= $usuario['posto_graduacao'] ?>
                      </p>
                    </div>
                    <div class="mb-3">
                      <label class="fw-bold">Nome de Guerra</label>
                      <p class="form-control">
                        <?= $usuario['nome_guerra'] ?>
                      </p>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="mb-3 justify-content-center">
                      <label class="fw-bold">Nome Completo</label>
                      <p class="form-control">
                        <?= $usuario['nome_completo'] ?>
                      </p>
                    </div>
                    <div class="mb-3">
                      <label class="fw-bold">Email</label>
                      <p class="form-control">
                      <?= $usuario['email'] ?>
                      </p>
                    </div>
                    <div class="mb-3">
                      <label class="fw-bold">Data de Nascimento</label>
                      <p class="form-control">
                      <?= date('d/m/Y', strtotime($usuario['data_nascimento'])) ?>
                      </p>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="mb-3">
                      <label class="fw-bold">Tipo</label>
                      <p class="form-control">
                      <?= $usuario['tipo'] === 'A' ? 'Administrador' : 'Rancho' ?>
                      </p>
                    </div>
                    <div class="mb-3">
                      <label class="fw-bold">Data de Criação</label>
                      <p class="form-control">
                      <?= date('d/m/Y', strtotime($usuario['data_criacao'])) ?>
                      </p>
                    </div>
                  </div>
              <?php 
                } else {
                  echo "<h5>Usuário não encontrado.</h5>";
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script src="./js/bootstrap/bootstrap.js"></script>
  </body>
</html>