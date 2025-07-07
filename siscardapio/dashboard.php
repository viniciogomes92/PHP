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
    <title>Dashboard</title>
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
      <div class="container d-flex justify-content-start mb-3">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="welcome">Olá, <?= $_SESSION['pg']?> <?= $_SESSION['nomeGuerra']?>.</h1>
          </div>
        </div>
      </div>

      <div class="row justify-content-center text-center">
        <!-- Verifica se o usuário logado é "Admin", se for exibe a opção para Usuários -->
        <?php if($_SESSION['tipo'] === 'A'): ?>
          <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
              <div class="card-body">
                <h5 class="card-title"><i class="bi bi-people"></i>&nbsp;Usuários</h5>
                <p class="card-text">Gerencie os usuários do sistema.</p>
                <a href="./usuarios.php" class="btn btn-primary">Acessar</a>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-journals"></i>&nbsp;Relatórios</h5>
              <p class="card-text">Visualize relatórios das avaliações do Rancho.</p>
              <a href="http://localhost/siscardapio/exportar_relatorio_mensal.php" class="btn btn-primary">Visualizar</a>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-calendar3"></i>&nbsp;Cardápio</h5>
              <p class="card-text">Insira e visualize os Cardápios.</p>
              <a href="./cardapios_dashboard.php" class="btn btn-primary">Acessar</a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><img src="./assets/img/food_icons/breakfast_2144670.png" alt="Ícone" class="me-1" style="width: 27px; height: 27px; vertical-align: middle;">Guarnições</h5>
              <p class="card-text">Insira e visualize as Guarnições que compõem o Cardápio.</p>
              <a href="guarnicoes_dashboard.php" class="btn btn-primary">Acessar</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-patch-question"></i>&nbsp;Questões</h5>
              <p class="card-text">Insira e visualize as Questões que compõem a avaliação do Cardápio.</p>
              <a href="questoes.php" class="btn btn-primary">Acessar</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-tools"></i>&nbsp;Configurações</h5>
              <p class="card-text">Visualize e altere as configurações do SisCardapio.</p>
              <a href="config.php" class="btn btn-primary mt-4">Acessar</a>
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