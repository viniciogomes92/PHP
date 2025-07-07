<?php 

session_start();

if(empty($_SESSION)){
  header('Location: index.php');
}

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Complemento da Ceia - Criar</title>
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
              <h4>Adicionar Complemento
                <a href="./complementos_ceia.php" class="btn btn-danger float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
              <form action="./acoes_complementos_ceia.php" method="post">
                
                <div class="mb-3">
                  <label for="inputComplemento">Complemento:</label>
                  <input type="text" name="complemento" id="inputComplemento" class="form-control">
                </div>
                
                <div class="mb-3">
                  <button type="submit" name="create_complementoCeia" class="btn btn-primary">Salvar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script src="./js/bootstrap/bootstrap.js"></script>
  </body>
</html>