<?php 

session_start();
require ("./connect.php");

if(empty($_SESSION)){
  header('Location: index.php');
}

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="'nipth=device-'nipth, initial-scale=1">
    <title>Cardápio</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/heraldica_bamrj.png">
    <link href="./css/bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./sweetalert2/dist/sweetalert2.css">
  </head>
  <body>
    <?php 
    
    include ("./navbar.php");
    
    ?>
    
    <!-- Conteúdo central com cards -->
    <div class="container py-5">
      <div class="row justify-content-center text-center">

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                <h5 class="card-title"><img src="./assets/img/food_icons/breakfast_10784672.png" alt="Ícone" class="me-3" style="width: 50px; height: 50px; vertical-align: middle;">Café da Manhã</h5>
                <p class="card-text">Gerencie o cardápio de Café da Manhã.</p>
                <a href="./cardapios_cafe.php" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><img src="./assets/img/food_icons/dish_857681.png" alt="Ícone" class="me-3" style="width: 50px; height: 50px; vertical-align: middle;">Almoço</h5>
              <p class="card-text">Gerencie o cardápio de almoço.</p>
              <a href="./cardapios_almoco.php" class="btn btn-primary">Acessar</a>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><img src="./assets/img/food_icons/dish_857681.png" alt="Ícone" class="me-3" style="width: 50px; height: 50px; vertical-align: middle;">Jantar</h5>
              <p class="card-text">Gerencie o cardápio de Jantar.</p>
              <a href="cardapios_jantar.php" class="btn btn-primary">Acessar</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><img src="./assets/img/food_icons/fast-food_7183741.png" alt="Ícone" class="me-3" style="width: 50px; height: 50px; vertical-align: middle;">Ceia</h5>
              <p class="card-text">Gerencie o cardápio da Ceia.</p>
              <a href="cardapios_ceia.php" class="btn btn-primary">Acessar</a>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body d-flex flex-column align-items-center gap-3">
              <img src="./assets/img/menu_1046849.png" alt="Ícone" class="me-3" style="width: 50px; height: 50px; vertical-align: middle;">
              <p class="card-text">Exporte o PDF do cardápio semanal.</p>
              <a href="exportar_cardapio_semanal.php" class="btn btn-primary mt-0">
                  <i class="bi bi-file-earmark-pdf"></i> Exportar Cardápios
              </a>
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