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
    <title>Café - Editar</title>
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
              <h4>Editar Café
                <a href="./cafes.php" class="btn btn-danger float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
              <?php 
              if(isset($_GET['id'])) {   
                $cafe_id = mysqli_real_escape_string($connect_db, $_GET['id']);
                $sql = "SELECT * FROM cafe WHERE id_cafe ='$cafe_id'";
                $query = mysqli_query($connect_db, $sql);

                if (mysqli_num_rows($query) > 0) {
                  $cafe = mysqli_fetch_array($query);
              ?>
                <form action="./acoes_cafes.php" method="post">
                  <div class="mb-3">
                    <label for="inputID">ID:</label>
                    <input type="text" name="cafeID" value="<?=$cafe['id_cafe']?>" readonly id="inputID" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="inputCafe">Café:</label>
                    <input type="text" name="cafe" value="<?=$cafe['nome_cafe']?>" id="inputCafe" class="form-control">
                  </div>
                  <div class="mb-3">
                    <button type="submit" name="update_cafe" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              <?php 
                } else {
                  echo "<h5>cafe não encontrada.</h5>";
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