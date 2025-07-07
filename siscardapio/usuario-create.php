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
    <title>Usuário - Criar</title>
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
              <h4>Adicionar Usuário
                <a href="./usuarios.php" class="btn btn-danger float-end">Voltar</a>
              </h4>
            </div>
            <div class="card-body">
              <form action="./acoes_usuarios.php" method="post">
                <div class="mb-3">
                  <label for="inputNIP">NIP</label>
                  <input type="text" name="nip" id="inputNIP" class="form-control" size="8" maxlength="8">
                </div>
                <div class="mb-3">
                  <label for="inputGroupSelectPG">Posto/Graduação</label>
                  <select class="custom-select form-control" name="pg" id="inputGroupSelectPG">
                    <option selected>Escolha...</option>
                    <option value="AE">AE</option>
                    <option value="VA">VA</option>
                    <option value="CA">CA</option>
                    <option value="CMG">CMG</option>
                    <option value="CF">CF</option>
                    <option value="CC">CC</option>
                    <option value="CT">CT</option>
                    <option value="1T">1T</option>
                    <option value="2T">2T</option>
                    <option value="GM">GM</option>
                    <option value="SO">SO</option>
                    <option value="1SG">1SG</option>
                    <option value="2SG">2SG</option>
                    <option value="3SG">3SG</option>
                    <option value="CB">CB</option>
                    <option value="MN">MN</option>
                    <option value="MN-RC">MN-RC</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="inputNomeCompleto">Nome Completo</label>
                  <input type="text" name="nomeCompleto" id="inputNomeCompleto" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="inputNomeGuerra">Nome de Guerra</label>
                  <input type="text" name="nomeGuerra" id="inputNomeGuerra" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="inputEmail">Email</label>
                  <input type="email" name="email" id="inputEmail" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="inputNascimento">Data de Nascimento</label>
                  <input type="date" name="dataNascimento" id="inputNascimento" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="inputGroupSelectTipo">Tipo de Conta</label>
                  <select class="custom-select form-control" name="tipo" id="inputGroupSelectTipo">
                    <option selected>Escolha...</option>
                    <?= $_SESSION['tipo'] === 'A' ? 
                      '<option value="A">Administrador</option>
                      <option value="R">Rancho</option>
                      <option value="S">Sargenteante</option>'
                    : '' ?>
                    <?= !$_SESSION['tipo'] === 'A' ? 
                      '<option value="R">Rancho</option>
                      <option value="S">Sargenteante</option>'
                    : '' ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="inputSenha">Senha</label>
                  <input type="password" name="senha" id="inputSenha" class="form-control">
                </div>
                <div class="mb-3">
                  <button type="submit" name="create_usuario" class="btn btn-primary">Salvar</button>
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