<?php
session_start();
require ("./connect_pdo.php");

if(empty($_SESSION)){
    header('Location: index.php');
}

date_default_timezone_set('America/Sao_Paulo');

// Verifica se o ID foi passado
if(!isset($_GET['id']) && !isset($_GET['data_cardapio'])) {
    $_SESSION['message'] = "Cardápio não especificado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: cardapios_ceia.php');
    exit();
}

$id_cardapio = $_GET['id'];
$data_cardapio = new DateTime($_GET['data_cardapio']);
$dataAtual = new DateTime();

if ($dataAtual > $data_cardapio) {
    $_SESSION['mensagem'] = "Cardápio ultrapassado, não pode ser editado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: cardapios_ceia.php');
    exit();
}

// Busca os dados do cardápio a ser editado
function getCardapioCeiaById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM cardapio_ceia WHERE id_cardapio = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Busca os itens de cada categoria para o formulário
function getItens($pdo, $tabela) {
    $stmt = $pdo->query("SELECT * FROM $tabela ORDER BY nome_$tabela");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$cardapio = getCardapioCeiaById($pdo, $id_cardapio);

if(!$cardapio) {
    $_SESSION['mensagem'] = "Cardápio não encontrado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: cardapios_ceia.php');
    exit();
}

$ceias = getItens($pdo, 'ceia');
$complementos = getItens($pdo, 'complemento_ceia');
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Cardápio de Ceia</title>
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
                        <h4>Editar Cardápio de Ceia
                            <div class="float-end">
                                <a href="./cardapios_ceia.php" class="btn btn-danger">Voltar</a>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="acoes_cardapios_ceia.php">
                            <input type="hidden" name="id_cardapio" value="<?= $cardapio['id_cardapio'] ?>">
                            
                            <div class="row g-3">
                                <!-- Data do Cardápio -->
                                <div class="col-md-6">
                                    <label for="data_cardapio" class="form-label">Data do Cardápio</label>
                                    <input type="date" class="form-control" id="data_cardapio" name="data_cardapio" 
                                           value="<?= date('Y-m-d', strtotime($cardapio['data_cardapio'])) ?>" required>
                                </div>
                                
                                <!-- Ceia -->
                                <div class="col-md-6">
                                    <label for="id_ceia" class="form-label">Ceia</label>
                                    <select class="form-select" id="id_ceia" name="id_ceia" required>
                                        <option value="">Selecione...</option>
                                        <?php foreach ($ceias as $ceia): ?>
                                            <option value="<?= $ceia['id_ceia'] ?>" 
                                                <?= ($ceia['id_ceia'] == $cardapio['id_ceia']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($ceia['nome_ceia']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <!-- Complemento -->
                                <div class="col-md-6">
                                    <label for="id_complemento_ceia" class="form-label">Complemento</label>
                                    <select class="form-select" id="id_complemento_ceia" name="id_complemento_ceia" required>
                                        <option value="">Selecione...</option>
                                        <?php foreach ($complementos as $complemento): ?>
                                            <option value="<?= $complemento['id_complemento_ceia'] ?>" 
                                                <?= ($complemento['id_complemento_ceia'] == $cardapio['id_complemento_ceia']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($complemento['nome_complemento_ceia']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <!-- Botão de Enviar -->
                                <div class="col-12">
                                    <button type="submit" name="update_cardapioCeia" class="btn btn-primary">Atualizar Cardápio</button>
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