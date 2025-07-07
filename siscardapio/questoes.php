<?php 

session_start();
require ("./connect.php");

if(empty($_SESSION)){
  header('Location: index.php');
}

$questoesUpdate = [];

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="'nipth=device-'nipth, initial-scale=1">
    <title>Questões</title>
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
              <h4>Lista de Questões
                <a href="questao-create.php" class="btn btn-primary float-end">Adicionar Questão</a>
              </h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Questão</th>
                    <th>Autor</th>
                    <th>Data de Criação</th>
                    <th style="text-align: center;">Ativa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  
                  $sql = 'SELECT 
                            q.id AS id_questao,
                            q.questao,
                            q.data_criacao,
                            q.ativa,
                            u.nip,
                            u.nome_guerra,
                            u.posto_graduacao
                          FROM 
                            questoes q
                          JOIN 
                            usuarios u ON q.nip = u.nip
                          ORDER BY 
                            q.data_criacao DESC;';
                  $questoes = mysqli_query($connect_db, $sql);
                  
                  $todasQuestoes = [];
                  $questoesUpdate = [];

                  if (mysqli_num_rows($questoes) > 0) {
                    while ($questao = mysqli_fetch_assoc($questoes)) {
                      $todasQuestoes[] = $questao;
                      $questoesUpdate[(int)$questao['id_questao']] = $questao['ativa'];
                    }

                    foreach($questoes as $questao) {
                      
                  ?>
                  <tr>
                    <td id="idQuestao"><?= $questao['id_questao'] ?></td>
                    <td><?= $questao['questao'] ?></td>
                    <td><?= $questao['posto_graduacao'] . '-' . $questao['nome_guerra'] ?></td>
                    <td><?= date('d/m/Y', strtotime($questao['data_criacao'])) ?></td>
                    <td style="text-align: center;"><?= $questao['ativa'] === 'A' ? '<input onclick="updateQuestoes(' . $questao['id_questao'] . ')" class="form-check-input idQuestao-' . $questao['id_questao'] . '" type="checkbox" value="A" id="flexCheckDefault idQuestao-' . $questao['id_questao'] . '" checked>' : '<input onclick="updateQuestoes(' . $questao['id_questao'] . ')" class="form-check-input idQuestao-' . $questao['id_questao'] . '" type="checkbox" value="I" id="flexCheckDefault idQuestao-' . $questao['id_questao'] . '">' ?></td>
                    <td>
                      <!-- <a href="questao-view.php?id=<?=$questao['id_questao']?>" class="btn btn-secondary btn-sm"><span class="bi-eye-fill"></span>&nbsp;Visualizar</a> -->
                      <a href="questao-edit.php?id=<?=$questao['id_questao']?>" class="btn btn-success btn-sm"><span class="bi-pencil-fill"></span>&nbsp;Editar</a>
                      <form action="./acoes_questoes.php" method="POST" class="d-inline">
                        <button onclick="return confirmaDeleteQuestao(<?=$questao['id_questao']?>)" type="button" name="delete_questao" value="<?=$questao['id_questao']?>" class="btn btn-danger btn-sm">
                        <span class="bi-trash3-fill"></span>&nbsp;Excluir
                        </button>
                      </form>
                    </td>
                  </tr>
                  <?php 
                  
                    }
                  } else {
                    echo '<h5>Não há questões cadastradas.</h5>';
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
    <script src="./js/updateQuestoes.js" defer></script>
  </body>
</html>