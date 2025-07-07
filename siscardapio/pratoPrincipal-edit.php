<?php 

session_start();
include ("./connect.php");


if(empty($_SESSION)){
  header('Location: index.php');
}

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prato Principal - Editar</title>
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
              <h4>Editar Prato Principal
                <a href="./pratosPrincipais.php" class="btn btn-danger float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
              <?php 
              if(isset($_GET['id'])) {   
                $pratoPrincipal_id = mysqli_real_escape_string($connect_db, $_GET['id']);
                $sql = "SELECT * FROM prato_principal WHERE id_prato_principal ='$pratoPrincipal_id'";
                $query = mysqli_query($connect_db, $sql);

                if (mysqli_num_rows($query) > 0) {
                  $pratoPrincipal = mysqli_fetch_array($query);
              ?>
                <form action="./acoes_pratosPrincipais.php" method="post">
                  <div class="mb-3">
                    <label for="inputID">ID:</label>
                    <input type="text" name="pratoPrincipalID" value="<?=$pratoPrincipal['id_prato_principal']?>" readonly id="inputID" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="inputPratoPrincipal">Prato Principal:</label>
                    <input type="text" name="pratoPrincipal" value="<?=$pratoPrincipal['nome_prato_principal']?>" id="inputPratoPrincipal" class="form-control">
                  </div>
                  <div class="mb-3">
                    <button type="submit" name="update_pratoPrincipal" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              <?php 
                } else {
                  echo "<h5>Prato Principal não encontrado.</h5>";
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