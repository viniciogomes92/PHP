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
    <title>Guarnições</title>
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
    
    <!-- Painel Café da Manhã -->
    <div class="col-8 mb-5 mt-5 mx-auto">
      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Café da Manhã</h4>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                  <div class="card-body text-center">
                    <h5 class="card-title">
                      <img src="./assets/img/food_icons/bread_10784328.png" alt="Ícone" class="me-2" style="width: 50px; height: 50px; vertical-align: middle;">
                      Café da Manhã
                    </h5>
                    <p class="card-text">Gerencie as opções de Café da Manhã do Cardápio.</p>
                    <a href="./cafes.php" class="btn btn-primary">Acessar</a>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="card shadow-sm h-100">
                  <div class="card-body text-center">
                    <h5 class="card-title">
                      <img src="./assets/img/food_icons/yogurt_11471928.png" alt="Ícone" class="me-2" style="width: 50px; height: 50px; vertical-align: middle;">
                      Complementos
                    </h5>
                    <p class="card-text">Gerencie as opções de Complemento do café da manhã do Cardápio.</p>
                    <a href="./complementos.php" class="btn btn-primary">Acessar</a>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Painel Almoço -->
    <div class="col-8 mb-5 mt-5 mx-auto">
      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Almoço</h4>
        </div>
        <div class="card-body">
          <div class="row g-3">

            <div class="col-md-4">
              <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    <img src="./assets/img/food_icons/salad_701974.png" alt="Ícone" class="me-2" style="width: 50px; height: 50px; vertical-align: middle;">
                    Entradas
                  </h5>
                  <p class="card-text">Gerencie as opções de Entrada do Cardápio.</p>
                  <a href="./entradas.php" class="btn btn-primary">Acessar</a>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    <img src="./assets/img/food_icons/dish_857681.png" alt="Ícone" class="me-2" style="width: 50px; height: 50px; vertical-align: middle;">
                    Pratos Principais
                  </h5>
                  <p class="card-text">Gerencie as opções de Prato Principal do Cardápio.</p>
                  <a href="./pratosPrincipais.php" class="btn btn-primary">Acessar</a>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    <img src="./assets/img/food_icons/spaghetti_985530.png" alt="Ícone" class="me-2" style="width: 50px; height: 50px; vertical-align: middle;">
                    Guarnições
                  </h5>
                  <p class="card-text">Gerencie as opções de Guarnições do Cardápio.</p>
                  <a href="guarnicoes.php" class="btn btn-primary">Acessar</a>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    <img src="./assets/img/food_icons/dish_4776325.png" alt="Ícone" class="me-2" style="width: 50px; height: 50px; vertical-align: middle;">
                    Acompanhamentos
                  </h5>
                  <p class="card-text">Gerencie as opções de Acompanhamentos do Cardápio.</p>
                  <a href="acompanhamentos.php" class="btn btn-primary">Acessar</a>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    <img src="./assets/img/food_icons/piece-cake_1546214.png" alt="Ícone" class="me-2" style="width: 50px; height: 50px; vertical-align: middle;">
                    Sobremesas
                  </h5>
                  <p class="card-text">Gerencie as opções de Sobremesas do Cardápio.</p>
                  <a href="sobremesas.php" class="btn btn-primary">Acessar</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Painel Jantar -->
    <div class="col-8 mb-5 mt-5 mx-auto">
      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Jantar</h4>
        </div>
        <div class="card-body">
          <div class="row g-3">

            <div class="col-md-4">
              <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    <img src="./assets/img/food_icons/salad_701974.png" alt="Ícone" class="me-2" style="width: 50px; height: 50px; vertical-align: middle;">
                    Entradas
                  </h5>
                  <p class="card-text">Gerencie as opções de Entrada do Cardápio.</p>
                  <a href="./entradas.php" class="btn btn-primary">Acessar</a>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    <img src="./assets/img/food_icons/dish_857681.png" alt="Ícone" class="me-2" style="width: 50px; height: 50px; vertical-align: middle;">
                    Pratos Principais
                  </h5>
                  <p class="card-text">Gerencie as opções de Prato Principal do Cardápio.</p>
                  <a href="./pratosPrincipais.php" class="btn btn-primary">Acessar</a>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    <img src="./assets/img/food_icons/dish_4776325.png" alt="Ícone" class="me-2" style="width: 50px; height: 50px; vertical-align: middle;">
                    Acompanhamentos
                  </h5>
                  <p class="card-text">Gerencie as opções de Acompanhamentos do Cardápio.</p>
                  <a href="acompanhamentos.php" class="btn btn-primary">Acessar</a>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    <img src="./assets/img/food_icons/piece-cake_1546214.png" alt="Ícone" class="me-2" style="width: 50px; height: 50px; vertical-align: middle;">
                    Sobremesas
                  </h5>
                  <p class="card-text">Gerencie as opções de Sobremesas do Cardápio.</p>
                  <a href="sobremesas.php" class="btn btn-primary">Acessar</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    
    <!-- Painel Ceia -->
    <div class="col-8 mb-5 mt-5 mx-auto">
      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Ceia</h4>
        </div>
        <div class="card-body">
          <div class="row g-3">

            <div class="col-md-4">
              <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    <img src="./assets/img/food_icons/fast-food_1290528.png" alt="Ícone" class="me-2" style="width: 50px; height: 50px; vertical-align: middle;">
                    Ceia
                  </h5>
                  <p class="card-text">Gerencie as opções de Ceia do Cardápio.</p>
                  <a href="./ceias.php" class="btn btn-primary">Acessar</a>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                  <h5 class="card-title">
                    <img src="./assets/img/food_icons/juice_3142696.png" alt="Ícone" class="me-2" style="width: 50px; height: 50px; vertical-align: middle;">
                    Complementos
                  </h5>
                  <p class="card-text">Gerencie as opções de Complementos da Ceia do Cardápio.</p>
                  <a href="./complementos_ceia.php" class="btn btn-primary">Acessar</a>
                </div>
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