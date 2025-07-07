<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="./dashboard.php"><img class="me-4" src="./assets/img/heraldica_bamrj.png" alt="Heráldica BAMRJ">SisCardápio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <?php 
          if(!empty($_SESSION)){ 
            print "<li class='nav-item'><a class='nav-link text-white' href='dashboard.php'>Início</a></li>";
            if($_SESSION['tipo'] === 'A') {
              print "<li class='nav-item active'><a class='nav-link text-white' href='usuarios.php'>Usuários</a></li>";
            }
            print "
            <li class='nav-item'><a class='nav-link text-white' href='exportar_relatorio_mensal.php'>Relatórios</a></li>
            <li class='nav-item'><a class='nav-link text-white' href='cardapios_dashboard.php'>Cardápio</a></li>
            <li class='nav-item'><a class='nav-link text-white' href='guarnicoes_dashboard.php'>Guarnições</a></li>
            <li class='nav-item'><a class='nav-link text-white' href='questoes.php'>Questões</a></li>
            <li class='nav-item'><a class='nav-link text-white' href='config.php'>Configurações</a></li>
            <li class='ms-4 nav-item'><a href='logout.php' class='btn btn-danger '>Sair</a></li>
            ";
          }
        ?>
      </ul>
    </div>
  </div>
</nav>