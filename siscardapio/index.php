<?php 

require ("./connect.php");

if(!empty($_SESSION)){
  header('Location: dashboard.php');
}               

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SisCardápio - Login</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/heraldica_bamrj.png">
    <link href="./css/bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet" href="./css/index.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
          <div class="login">
            <div class="card">
              <div class="card-body d-flex flex-column align-items-center">
                <h3>Acesso ao SisCardápio</h3>
                <img class="" src="./assets/img/heraldica_bamrj.png" alt="Heráldica BAMRJ">
              </div>
              <div class="card-body">
                <form action="login.php" method="POST">
                  <div>
                    <div class="mb-3">
                      <label for="inputNIP">NIP:</label>
                      <input type="text" name="nip" id="inputNIP" class="form-control">
                    </div>
                  </div>
                  <div>
                    <div class="mb-3">
                      <label for="inputSenha">Senha:</label>
                      <input type="password" name="senha" id="inputSenha" class="form-control">
                    </div>
                  </div>
                  <div>
                    <div class="mb-3">
                      <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                  </div>
                  <?php 
                  
                  include "mensagem.php";
                  
                  ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script src="./js/bootstrap/bootstrap.js" defer></script>
    <script src="./sweetalert2//dist/sweetalert2.js" defer></script>
    <script src="./js/sweetAlert2.js" defer></script>
  </body>
</html>