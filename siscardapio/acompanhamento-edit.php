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
    <title>Acompanhamento - Editar</title>
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
              <h4>Editar Acompanhamento
                <a href="./acompanhamentos.php" class="btn btn-danger float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
              <?php 
              if(isset($_GET['id'])) {   
                $acompanhamento_id = mysqli_real_escape_string($connect_db, $_GET['id']);
                $sql = "SELECT * FROM acompanhamento WHERE id_acompanhamento ='$acompanhamento_id'";
                $query = mysqli_query($connect_db, $sql);

                if (mysqli_num_rows($query) > 0) {
                  $acompanhamento = mysqli_fetch_array($query);
              ?>
                <form action="./acoes_acompanhamentos.php" method="post">
                  <div class="mb-3">
                    <label for="inputID">ID:</label>
                    <input type="text" name="acompanhamentoID" value="<?=$acompanhamento['id_acompanhamento']?>" readonly id="inputID" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="inputAcompanhamento">Acompanhamento:</label>
                    <input type="text" name="acompanhamento" value="<?=$acompanhamento['nome_acompanhamento']?>" id="inputAcompanhamento" class="form-control">
                  </div>
                  <div class="mb-3">
                    <button type="submit" name="update_acompanhamento" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              <?php 
                } else {
                  echo "<h5>Acompanhamento não encontrado.</h5>";
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