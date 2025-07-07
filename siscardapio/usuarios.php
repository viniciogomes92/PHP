<?php 

session_start();
require ("./connect.php");

if(empty($_SESSION)){
  header('Location: index.php');
} elseif ($_SESSION['tipo'] !== 'A') {
  header('Location: dashboard.php');
}

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/heraldica_bamrj.png">
    <link href="./css/bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./sweetalert2/dist/sweetalert2.css">
  </head>
  <body>
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
              <h4>Lista de Usuários
                <a href="usuario-create.php" class="btn btn-primary float-end">Adicionar Usuário</a>
              </h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>NIP</th>
                    <th>P/G</th>
                    <th>Nome de Guerra</th>
                    <th>Nome Completo</th>
                    <th>Email</th>
                    <th>Data de Nascimento</th>
                    <th>Data de Criação</th>
                    <th>Tipo de Conta</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  
                  $sql = 'SELECT * FROM usuarios';
                  $usuarios = mysqli_query($connect_db, $sql);
                  if (mysqli_num_rows($usuarios) > 0) {
                    foreach($usuarios as $usuario) {                                 
                  ?>
                  <tr>
                    <td><?= $usuario['nip'] ?></td>
                    <td><?= $usuario['posto_graduacao'] ?></td>
                    <td><?= $usuario['nome_guerra'] ?></td>
                    <td><?= $usuario['nome_completo'] ?></td>
                    <td><?= $usuario['email'] ?></td>
                    <td><?= date('d/m/Y', strtotime($usuario['data_nascimento'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($usuario['data_criacao'])) ?></td>
                    <td><?= ($usuario['tipo'] === 'A') ? 'Admin' : 'Rancho' ?></td>
                    <td>
                      <a href="usuario-view.php?nip=<?=$usuario['nip']?>" class="btn btn-secondary btn-sm mb-1"><span class="bi-eye-fill"></span>&nbsp;Dados</a>
                      <a href="usuario-edit.php?nip=<?=$usuario['nip']?>" class="btn btn-success btn-sm mb-1"><span class="bi-pencil-fill"></span>&nbsp;Editar</a>
                      <form action="./acoes_usuarios.php" method="POST" class="d-inline">
                        <button onclick="return confirmaDeleteUsuario(<?=$usuario['nip']?>)" type="button" name="delete_usuario" value="<?=$usuario['nip']?>" class="btn btn-danger btn-sm">
                        <span class="bi-trash3-fill"></span>&nbsp;Excluir
                        </button>
                      </form>
                    </td>
                  </tr>
                  <?php 
                  
                    }
                  } else {
                    echo '<h5>Não há usuários cadastrados.</h5>';
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
    <script src="./sweetalert2//dist/sweetalert2.js" defer></script>
    <script src="./js/sweetAlert2.js" defer></script>
  </body>
</html>