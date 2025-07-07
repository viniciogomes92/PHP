<?php
session_start();
require ("./connect_pdo.php");

if(empty($_SESSION)){
    header('Location: index.php');
}

date_default_timezone_set('America/Sao_Paulo');

// Verifica se o ID foi passado
if(!isset($_GET['id']) && !isset($_GET['data_cardapio'])) {
    $_SESSION['mensagem'] = "Cardápio não especificado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: cardapios_jantar.php');
    exit();
}

$id_cardapio = $_GET['id'];
$data_cardapio = new DateTime($_GET['data_cardapio']);
$dataAtual = new DateTime();

if ($dataAtual > $data_cardapio) {
    $_SESSION['mensagem'] = "Cardápio ultrapassado, não pode ser editado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: cardapios_jantar.php');
    exit();
}

// Busca os dados do cardápio a ser editado
function getCardapioJantarById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM cardapio_jantar WHERE id_cardapio = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Busca os itens de cada categoria para o formulário
function getItens($pdo, $tabela) {
    $stmt = $pdo->query("SELECT * FROM $tabela ORDER BY nome_$tabela");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$cardapio = getCardapioJantarById($pdo, $id_cardapio);

if(!$cardapio) {
    $_SESSION['message'] = "Cardápio não encontrado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: cardapios_jantar.php');
    exit();
}

$entradas = getItens($pdo, 'entrada');
$pratos = getItens($pdo, 'prato_principal');
$guarnicoes = getItens($pdo, 'guarnicao');
$acompanhamentos = getItens($pdo, 'acompanhamento');
$sobremesas = getItens($pdo, 'sobremesa');
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Cardápio de Jantar</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/heraldica_bamrj.png">
    <link href="./css/bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./sweetalert2/dist/sweetalert2.css">
</head>
<body>
    <script src="./js/bootstrap/bootstrap.js" defer></script>
    <script src="./sweetalert2/dist/sweetalert2.js" defer></script>
    <script src="./js/sweetAlert2.js" defer></script>
    <?php include ("./navbar.php"); ?>
    
    <div class="container mt-6">
        <?php include ("./mensagem.php"); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Editar Cardápio de Jantar
                            <div class="float-end">
                                <a href="./cardapios_jantar.php" class="btn btn-danger">Voltar</a>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="acoes_cardapios_jantar.php">
                            <input type="hidden" name="id_cardapio" value="<?= $cardapio['id_cardapio'] ?>">
                            
                            <div class="row g-3">
                                <!-- Data do Cardápio -->
                                <div class="col-md-6">
                                    <label for="data_cardapio" class="form-label">Data do Cardápio</label>
                                    <input type="date" class="form-control" id="data_cardapio" name="data_cardapio" 
                                           value="<?= date('Y-m-d', strtotime($cardapio['data_cardapio'])) ?>" required>
                                </div>
                                
                                <!-- Entrada -->
                                <div class="col-md-6">
                                    <label for="id_entrada" class="form-label">Entrada</label>
                                    <select class="form-select" id="id_entrada" name="id_entrada" required>
                                        <option value="">Selecione...</option>
                                        <?php foreach ($entradas as $entrada): ?>
                                            <option value="<?= $entrada['id_entrada'] ?>" 
                                                <?= ($entrada['id_entrada'] == $cardapio['id_entrada']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($entrada['nome_entrada']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <!-- Prato Principal -->
                                <div class="col-md-6">
                                    <label for="id_prato_principal" class="form-label">Prato Principal</label>
                                    <select class="form-select" id="id_prato_principal" name="id_prato_principal" required>
                                        <option value="">Selecione...</option>
                                        <?php foreach ($pratos as $prato): ?>
                                            <option value="<?= $prato['id_prato_principal'] ?>" 
                                                <?= ($prato['id_prato_principal'] == $cardapio['id_prato_principal']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($prato['nome_prato_principal']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <!-- Guarnição -->
                                <div class="col-md-6">
                                    <label for="id_guarnicao" class="form-label">Guarnição</label>
                                    <select class="form-select" id="id_guarnicao" name="id_guarnicao" required>
                                        <option value="">Selecione...</option>
                                        <?php foreach ($guarnicoes as $guarnicao): ?>
                                            <option value="<?= $guarnicao['id_guarnicao'] ?>" 
                                                <?= ($guarnicao['id_guarnicao'] == $cardapio['id_guarnicao']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($guarnicao['nome_guarnicao']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <!-- Acompanhamento -->
                                <div class="col-md-6">
                                    <label for="id_acompanhamento" class="form-label">Acompanhamento</label>
                                    <select class="form-select" id="id_acompanhamento" name="id_acompanhamento" required>
                                        <option value="">Selecione...</option>
                                        <?php foreach ($acompanhamentos as $acompanhamento): ?>
                                            <option value="<?= $acompanhamento['id_acompanhamento'] ?>" 
                                                <?= ($acompanhamento['id_acompanhamento'] == $cardapio['id_acompanhamento']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($acompanhamento['nome_acompanhamento']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <!-- Sobremesa -->
                                <div class="col-md-6">
                                    <label for="id_sobremesa" class="form-label">Sobremesa</label>
                                    <select class="form-select" id="id_sobremesa" name="id_sobremesa" required>
                                        <option value="">Selecione...</option>
                                        <?php foreach ($sobremesas as $sobremesa): ?>
                                            <option value="<?= $sobremesa['id_sobremesa'] ?>" 
                                                <?= ($sobremesa['id_sobremesa'] == $cardapio['id_sobremesa']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($sobremesa['nome_sobremesa']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <!-- Botão de Enviar -->
                                <div class="col-12">
                                    <button type="submit" name="update_cardapioJantar" class="btn btn-primary">Atualizar Cardápio</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>