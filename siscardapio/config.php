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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Configuração - SisCardápio</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/heraldica_bamrj.png">
    <link href="./css/bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./sweetalert2/dist/sweetalert2.css">
  </head>
  <body>
    <?php 
    
    include ("./navbar.php");
    
    ?>
    
    <div class="container mt-1 mb-5">
        <?php 
        
        include "./mensagem.php";

        ?>
      <div class="row">
        <div class="col-md-12 d-flex justify-content-center gap-5">
          <div class="card w-25 mt-5">
            <div class="card-header">
              <h4>Agente Fiscal</h4>
            </div>
            <div class="card-body">
                <?php 
                
                $sql = "SELECT * FROM agentes_fiscais
                        WHERE status='A'";
                $resultAgentesFiscais = mysqli_query($connect_db, $sql);
                if (!(mysqli_num_rows($resultAgentesFiscais) > 0)) {
                    echo '<h5>Não há Agente Fiscal configurado.</h5>';  
                } else {
                    $agenteFiscal = mysqli_fetch_row($resultAgentesFiscais);
                }
                ?>
                <div class="">
                    <div class="">
                        <form action="acoes_agentes_fiscais.php" id="formAgenteFiscal" method="post" class="d-flex flex-column gap-4">
                            <div>
                                <div>
                                    <label for="inputNipAgenteFiscal" class="" >NIP:</label>
                                    <input type="text" id="inputNipAgenteFiscal" name="nipAgenteFiscal" class="form-control w-50" maxlength="8">
                                    <label for="selectPG" class="" >Posto/Graduação:</label>
                                    <select name="selectPGAgenteFiscal" id="selectPGAgenteFiscal" class="form-control w-50">
                                        <option value="Escolha">Escolha...</option>
                                        <option value="AE">AE</option>
                                        <option value="VA">VA</option>
                                        <option value="CA">CA</option>
                                        <option value="CMG">CMG</option>
                                        <option value="CF">CF</option>
                                        <option value="CC">CC</option>
                                        <option value="CT">CT</option>
                                        <option value="1T">1ºT</option>
                                        <option value="2T">2ºT</option>
                                        <option value="GM">GM</option>
                                        <option value="SO">SO</option>
                                        <option value="1SG">1ºSG</option>
                                        <option value="2SG">2ºSG</option>
                                        <option value="3SG">3ºSG</option>
                                        <option value="CB">CB</option>
                                        <option value="MN">MN</option>
                                    </select>
                                    <label for="selectQC" class="" >Corpo/Quadro:</label>
                                    <select name="selectQC" id="selectQCAgenteFiscal" class="form-control w-50 selectQC" disabled>
                                        <option value="Escolha">Escolha...</option>
                                        <option value="CA">CA</option>
                                        <option value="QC-CA">QC-CA</option>
                                        <option value="FN">FN</option>
                                        <option value="QC-FN">QC-FN</option>
                                        <option value="IM">IM</option>
                                        <option value="QC-IM">QC-IM</option>
                                        <option value="EN">EN</option>
                                        <option value="Md">Md</option>
                                        <option value="CD">CD</option>
                                        <option value="S">S</option>
                                        <option value="RM2-T">T</option>
                                        <option value="RM2-EN">RM2-EN</option>
                                        <option value="RM2-Md">RM2-Md</option>
                                        <option value="RM2-CD">RM2-CD</option>
                                        <option value="RM2-S">RM2-S</option>
                                        <option value="RM2-T">RM2-T</option>
                                        <option value="CN">CN</option>
                                        <option value="AA">AA</option>
                                        <option value="AFN">AFN</option>
                                    </select>
                                    <select name="selectC" id="selectCAgenteFiscal" class="form-control w-50 selectC" hidden>
                                        <option value="Escolha">Escolha...</option>
                                        <option value="CPA/QPA">CPA/QPA</option>
                                        <option value="CPA/QEPA">CPA/QEPA</option>
                                        <option value="CPA/QPAS">CPA/QPAS</option>
                                        <option value="CAP/QAP">CAP/QAP</option>
                                        <option value="CAP/QATP">CAP/QATP</option>
                                        <option value="CAP/QTP">CAP/QTP</option>
                                        <option value="CAP/QEAP">CAP/QEAP</option>
                                        <option value="CAP/QTIP">CAP/QTIP</option>
                                    </select>

                                    <label for="inputEspAgenteFiscal" id="labelEspAgenteFiscal" class="" hidden>Especialidade:</label>
                                    <input type="text" id="inputEspAgenteFiscal" name="espAgenteFiscal" class="form-control w-25" maxlength="2" hidden>

                                    <label for="inputNomeGuerraAgenteFiscal" class="" >Nome de Guerra:</label>
                                    <input type="text" id="inputNomeGuerraAgenteFiscal" name="nomeGuerraAgenteFiscal" class="form-control">
                                </div>
                                <div>
                                    <label for="inputNomeCompletoAgenteFiscal" class="" >Nome Completo:</label>
                                    <input type="text" id="inputNomeCompletoAgenteFiscal" name="nomeCompletoAgenteFiscal" class="form-control">
                                </div>
                                <div>
                                    <label for="inputEmailAgenteFiscal" class="" >E-mail:</label>
                                    <input type="email" id="inputEmailAgenteFiscal" name="emailAgenteFiscal" class="form-control">
                                </div>
                            </div>
                            <div>
                                <button type="submit" name="create_agente_fiscal" for="formAgenteFiscal" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-5">
                    <h5>Agente Fiscal Configurado:</h5>
                    <label for="inputPGAgenteFiscal">Posto/Graduação</label>
                    <input type="text" class="form-control" id="inputPGAgenteFiscal" value="<?= $agenteFiscal[2] . ' (' . $agenteFiscal[3] . ($agenteFiscal[4] ? " $agenteFiscal[4])" : ')')  ?>" disabled>
                    <label for="inputNomeGuerraAgenteFiscal">Nome de Guerra:</label>
                    <input type="text" class="form-control" id="inputNomeGuerraAgenteFiscal" value="<?= $agenteFiscal[5] ?>" disabled>
                    <label for="inputNomeCompletoAgenteFiscal">Nome Completo:</label>
                    <input type="text" class="form-control" id="inputNomeCompletoAgenteFiscal" value="<?= $agenteFiscal[6] ?>" disabled>
                </div>
            </div>
          </div>
          <div class="card w-25 mt-5">
            <div class="card-header">
              <h4>Nutricionista</h4>
            </div>
            <div class="card-body">
                <?php 

                $sql = "SELECT * FROM nutricionistas
                        WHERE status='A'";
                $resultNutricionistas = mysqli_query($connect_db, $sql);
                if (!(mysqli_num_rows($resultNutricionistas) > 0)) {
                    echo '<h5>Não há Nutricionista configurado.</h5>';  
                } else {
                    $nutricionista = mysqli_fetch_row($resultNutricionistas);
                }
                ?>
                <div class="">
                    <div class="">
                        <form action="acoes_nutricionistas.php" method="post" class="d-flex flex-column gap-4">
                            <div class="d-flex flex-column">
                                <div>
                                    <label for="inputNipNutri" class="" >NIP:</label>
                                    <input type="text" id="inputNipNutri" name="nipNutri" class="form-control w-50" maxlength="8">
                                    
                                    <label for="selectPGNutri" class="" >Posto/Graduação:</label>
                                    <select name="selectPGNutri" id="selectPGNutri" class="form-control">
                                        <option value="Escolha">Escolha...</option>
                                        <option value="AE">AE</option>
                                        <option value="VA">VA</option>
                                        <option value="CA">CA</option>
                                        <option value="CMG">CMG</option>
                                        <option value="CF">CF</option>
                                        <option value="CC">CC</option>
                                        <option value="CT">CT</option>
                                        <option value="1T">1ºT</option>
                                        <option value="2T">2ºT</option>
                                        <option value="GM">GM</option>
                                        <option value="SO">SO</option>
                                        <option value="1SG">1ºSG</option>
                                        <option value="2SG">2ºSG</option>
                                        <option value="3SG">3ºSG</option>
                                        <option value="CB">CB</option>
                                        <option value="MN">MN</option>
                                    </select>

                                    <label for="selectQCNutri" class="" >Corpo/Quadro:</label>
                                    <select name="selectQC" id="selectQCNutri" class="form-control w-50 selectQC" disabled>
                                        <option value="Escolha">Escolha...</option>
                                        <option value="CA">CA</option>
                                        <option value="QC-CA">QC-CA</option>
                                        <option value="FN">FN</option>
                                        <option value="QC-FN">QC-FN</option>
                                        <option value="IM">IM</option>
                                        <option value="QC-IM">QC-IM</option>
                                        <option value="EN">EN</option>
                                        <option value="Md">Md</option>
                                        <option value="CD">CD</option>
                                        <option value="S">S</option>
                                        <option value="RM2-T">T</option>
                                        <option value="RM2-EN">RM2-EN</option>
                                        <option value="RM2-Md">RM2-Md</option>
                                        <option value="RM2-CD">RM2-CD</option>
                                        <option value="RM2-S">RM2-S</option>
                                        <option value="RM2-T">RM2-T</option>
                                        <option value="CN">CN</option>
                                        <option value="AA">AA</option>
                                        <option value="AFN">AFN</option>
                                    </select>
                                    <select name="selectC" id="selectCNutri" class="form-control w-50 selectC" hidden>
                                        <option value="Escolha">Escolha...</option>
                                        <option value="CPA/QPA">CPA/QPA</option>
                                        <option value="CPA/QEPA">CPA/QEPA</option>
                                        <option value="CPA/QPAS">CPA/QPAS</option>
                                        <option value="CAP/QAP">CAP/QAP</option>
                                        <option value="CAP/QATP">CAP/QATP</option>
                                        <option value="CAP/QTP">CAP/QTP</option>
                                        <option value="CAP/QEAP">CAP/QEAP</option>
                                        <option value="CAP/QTIP">CAP/QTIP</option>
                                    </select>

                                    <label for="inputEspNutri" id="labelEspNutri" class="" hidden>Especialidade:</label>
                                    <input type="text" id="inputEspNutri" name="espNutri" class="form-control w-25" maxlength="2" hidden>

                                    <label for="inputNomeGuerraNutri" class="" >Nome de Guerra:</label>
                                    <input type="text" id="inputNomeGuerraNutri" name="nomeGuerraNutri" class="form-control">
                                </div>
                                <div>
                                    <label for="inputNomeCompletoNutri" class="" >Nome Completo:</label>
                                    <input type="text" id="inputNomeCompletoNutri" name="nomeCompletoNutri" class="form-control">
                                </div>
                                <div>
                                    <label for="inputEmailNutri" class="" >E-mail:</label>
                                    <input type="email" id="inputEmailNutri" name="emailNutri" class="form-control">
                                </div>
                            </div>
                            <div>
                                <button type="submit" name="create_nutri" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php 
                    
                if (isset($nutricionista)) :
                
                ?>
                <div class="mt-5">
                        <h5>Nutricionista Configurado:</h5>
                        <label for="inputPGNutri">Posto/Graduação</label>
                        <input type="text" class="form-control" id="inputPGNutri" value="<?= $nutricionista[2] . ' (' . $nutricionista[3] . ($nutricionista[4] ? " $nutricionista[4])" : ')') ?>" disabled>
                        <label for="inputNomeGuerraNutri">Nome de Guerra:</label>
                        <input type="text" class="form-control" id="inputNomeGuerraNutri" value="<?= $nutricionista[5] ?>" disabled>
                        <label for="inputNomeCompletoNutri">Nome Completo:</label>
                        <input type="text" class="form-control" id="inputNomeCompletoNutri" value="<?= $nutricionista[6] ?>" disabled>
                </div>
                <?php 
                    
                endif;
                
                ?>
            </div>
          </div>
          <div class="card w-25 mt-5">
            <div class="card-header">
              <h4>Gestor de Municiamento</h4>
            </div>
            <div class="card-body">
                <?php 

                $sql = "SELECT * FROM gestores_munic
                        WHERE status='A'";
                $resultGestoresMunic = mysqli_query($connect_db, $sql);
                if (!(mysqli_num_rows($resultGestoresMunic) > 0)) {
                    echo '<h5>Não há Gestor de Municiamento configurado.</h5>';  
                } else {
                    $gestorMunic = mysqli_fetch_row($resultGestoresMunic);
                }
                ?>
                <div class="">
                    <div class="">
                        <form action="acoes_gestores_munic.php" method="post" class="d-flex flex-column gap-4">
                            <div class="d-flex flex-column">
                                <div>
                                    <label for="inputNipGestorMunic" class="" >NIP:</label>
                                    <input type="text" id="inputNipGestorMunic" name="nipGestorMunic" class="form-control w-50" maxlength="8">
                                    
                                    <label for="selectPGGestorMunic" class="" >Posto/Graduação:</label>
                                    <select name="selectPGGestorMunic" id="selectPGGestorMunic" class="form-control">
                                        <option value="Escolha">Escolha...</option>
                                        <option value="AE">AE</option>
                                        <option value="VA">VA</option>
                                        <option value="CA">CA</option>
                                        <option value="CMG">CMG</option>
                                        <option value="CF">CF</option>
                                        <option value="CC">CC</option>
                                        <option value="CT">CT</option>
                                        <option value="1T">1ºT</option>
                                        <option value="2T">2ºT</option>
                                        <option value="GM">GM</option>
                                        <option value="SO">SO</option>
                                        <option value="1SG">1ºSG</option>
                                        <option value="2SG">2ºSG</option>
                                        <option value="3SG">3ºSG</option>
                                        <option value="CB">CB</option>
                                        <option value="MN">MN</option>
                                    </select>

                                    <label for="selectQCGestorMunic" class="" >Corpo/Quadro:</label>
                                    <select name="selectQC" id="selectQCGestorMunic" class="form-control w-50 selectQC" disabled>
                                        <option value="Escolha">Escolha...</option>
                                        <option value="CA">CA</option>
                                        <option value="QC-CA">QC-CA</option>
                                        <option value="FN">FN</option>
                                        <option value="QC-FN">QC-FN</option>
                                        <option value="IM">IM</option>
                                        <option value="QC-IM">QC-IM</option>
                                        <option value="EN">EN</option>
                                        <option value="Md">Md</option>
                                        <option value="CD">CD</option>
                                        <option value="S">S</option>
                                        <option value="RM2-T">T</option>
                                        <option value="RM2-EN">RM2-EN</option>
                                        <option value="RM2-Md">RM2-Md</option>
                                        <option value="RM2-CD">RM2-CD</option>
                                        <option value="RM2-S">RM2-S</option>
                                        <option value="RM2-T">RM2-T</option>
                                        <option value="CN">CN</option>
                                        <option value="AA">AA</option>
                                        <option value="AFN">AFN</option>
                                    </select>
                                    <select name="selectC" id="selectCGestorMunic" class="form-control w-50 selectC" hidden>
                                        <option value="Escolha">Escolha...</option>
                                        <option value="CPA/QPA">CPA/QPA</option>
                                        <option value="CPA/QEPA">CPA/QEPA</option>
                                        <option value="CPA/QPAS">CPA/QPAS</option>
                                        <option value="CAP/QAP">CAP/QAP</option>
                                        <option value="CAP/QATP">CAP/QATP</option>
                                        <option value="CAP/QTP">CAP/QTP</option>
                                        <option value="CAP/QEAP">CAP/QEAP</option>
                                        <option value="CAP/QTIP">CAP/QTIP</option>
                                    </select>

                                    <label for="inputEspGestorMunic" id="labelEspGestorMunic" class="" hidden>Especialidade:</label>
                                    <input type="text" id="inputEspGestorMunic" name="espGestorMunic" class="form-control w-25" maxlength="2" hidden>

                                    <label for="inputNomeGuerraGestorMunic" class="" >Nome de Guerra:</label>
                                    <input type="text" id="inputNomeGuerraGestorMunic" name="nomeGuerraGestorMunic" class="form-control">
                                </div>
                                <div>
                                    <label for="inputNomeCompletoGestorMunic" class="" >Nome Completo:</label>
                                    <input type="text" id="inputNomeCompletoGestorMunic" name="nomeCompletoGestorMunic" class="form-control">
                                </div>
                                <div>
                                    <label for="inputEmailGestorMunic" class="" >E-mail:</label>
                                    <input type="email" id="inputEmailGestorMunic" name="emailGestorMunic" class="form-control">
                                </div>
                            </div>
                            <div>
                                <button type="submit" name="create_gestor_munic" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php 
                    
                if (isset($gestorMunic)) :
                
                ?>
                <div class="mt-5">
                        <h5>Gestor de Munic. Configurado:</h5>
                        <label for="inputPGGestorMunic">Posto/Graduação</label>
                        <input type="text" class="form-control" id="inputPGGestorMunic" value="<?= $gestorMunic[2] . ' (' . $gestorMunic[3] . ($gestorMunic[4] ? " $gestorMunic[4])" : ')') ?>" disabled>
                        <label for="inputNomeGuerraGestorMunic">Nome de Guerra:</label>
                        <input type="text" class="form-control" id="inputNomeGuerraGestorMunic" value="<?= $gestorMunic[5] ?>" disabled>
                        <label for="inputNomeCompletoGestorMunic">Nome Completo:</label>
                        <input type="text" class="form-control" id="inputNomeCompletoGestorMunic" value="<?= $gestorMunic[6] ?>" disabled>
                </div>
                <?php 
                    
                endif;
                
                ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="./js/bootstrap/bootstrap.js" defer></script>
    <script src="./js/selectPGA.js" defer></script>
    <script src="./js/selectPGN.js" defer></script>
    <script src="./js/selectPGG.js" defer></script>
    <script src="./sweetalert2//dist/sweetalert2.js" defer></script>
    <script src="./js/sweetAlert2.js" defer></script>
  </body>
</html>