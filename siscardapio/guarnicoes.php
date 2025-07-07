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
    <script src="./js/bootstrap/bootstrap.js" defer></script>
    <script src="./sweetalert2/dist/sweetalert2.js" defer></script>
    <script src="./js/sweetAlert2.js" defer></script>
    <?php 
    
    include ("./navbar.php");
    
    ?>
    
    <div class="container mt-6">
      <?php 
      
      include ("./mensagem.php");
      
      ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card mt-5">
            <div class="card-header">
              <h4>Guarnições Cadastradas
                <div class="float-end">
                  <a href="./guarnicao-create.php" class="btn btn-primary">Adicionar Guarnição</a>
                  <a href="./guarnicoes_dashboard.php" class="btn btn-danger">Voltar</a>  
                </div>
              </h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Guarnição</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  
                  $sql = 'SELECT * FROM guarnicao';
                  $guarnicoes = mysqli_query($connect_db, $sql);
                  
                  if (mysqli_num_rows($guarnicoes) > 0) {
                    foreach($guarnicoes as $guarnicao) {                                 
                  ?>
                  <tr>
                    <td><?= $guarnicao['id_guarnicao'] ?></td>
                    <td><?= $guarnicao['nome_guarnicao'] ?></td>
                    <td class="d-flex flex-row align-items-center justify-content-center">
                      <a href="guarnicao-edit.php?id=<?=$guarnicao['id_guarnicao']?>" class="btn btn-success btn-sm me-2"><span class="bi-pencil-fill"></span>&nbsp;Editar</a>
                      <form action="./acoes_pratosPrincipais.php" method="POST" class="d-inline">
                        <button onclick="return confirmaDeleteGuarnicao(<?=$guarnicao['id_guarnicao']?>)" type="button" name="delete_guarnicao" value="<?=$guarnicao['id_guarnicao']?>" class="btn btn-danger btn-sm">
                        <span class="bi-trash3-fill"></span>&nbsp;Excluir
                        </button>
                      </form>
                    </td>
                  </tr>
                  <?php 
                  
                    }
                  } else {
                    echo '<h5>Não há guarnições cadastrados.</h5>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="./js/bootstrap/bootstrap.js" defer></script>
    <script src="./sweetalert2/dist/sweetalert2.js" defer></script>
    <script src="./js/sweetAlert2.js" defer></script>
  </body>
</html>