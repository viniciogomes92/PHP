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
    header('Location: cardapios_cafe.php');
    exit();
}

$id_cardapio = $_GET['id'];
$data_cardapio = new DateTime($_GET['data_cardapio']);
$dataAtual = new DateTime();

if ($dataAtual > $data_cardapio) {
    $_SESSION['mensagem'] = "Cardápio ultrapassado, não pode ser editado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: cardapios_cafe.php');
    exit();
}

// Busca os dados do cardápio a ser editado
function getCardapioCafeById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM cardapio_cafe WHERE id_cardapio = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Busca os itens de cada categoria para o formulário
function getItens($pdo, $tabela) {
    $stmt = $pdo->query("SELECT * FROM $tabela ORDER BY nome_$tabela");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$cardapio = getCardapioCafeById($pdo, $id_cardapio);

if(!$cardapio) {
    $_SESSION['mensagem'] = "Cardápio não encontrado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: cardapios_cafe.php');
    exit();
}

$cafes = getItens($pdo, 'cafe');
$complementos = getItens($pdo, 'complemento');
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Cardápio de Café da Manhã</title>
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
                        <h4>Editar Cardápio de Café da Manhã
                            <div class="float-end">
                                <a href="./cardapios_cafe.php" class="btn btn-danger">Voltar</a>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="acoes_cardapios_cafe.php">
                            <input type="hidden" name="id_cardapio" value="<?= $cardapio['id_cardapio'] ?>">
                            
                            <div class="row g-3">
                                <!-- Data do Cardápio -->
                                <div class="col-md-6">
                                    <label for="data_cardapio" class="form-label">Data do Cardápio</label>
                                    <input type="date" class="form-control" id="data_cardapio" name="data_cardapio" 
                                           value="<?= date('Y-m-d', strtotime($cardapio['data_cardapio'])) ?>" required>
                                </div>
                                
                                <!-- Café -->
                                <div class="col-md-6">
                                    <label for="id_cafe" class="form-label">Café da Manhã</label>
                                    <select class="form-select" id="id_cafe" name="id_cafe" required>
                                        <option value="">Selecione...</option>
                                        <?php foreach ($cafes as $cafe): ?>
                                            <option value="<?= $cafe['id_cafe'] ?>" 
                                                <?= ($cafe['id_cafe'] == $cardapio['id_cafe']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($cafe['nome_cafe']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <!-- Complemento -->
                                <div class="col-md-6">
                                    <label for="id_complemento" class="form-label">Complemento</label>
                                    <select class="form-select" id="id_complemento" name="id_complemento" required>
                                        <option value="">Selecione...</option>
                                        <?php foreach ($complementos as $complemento): ?>
                                            <option value="<?= $complemento['id_complemento'] ?>" 
                                                <?= ($complemento['id_complemento'] == $cardapio['id_complemento']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($complemento['nome_complemento']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <!-- Botão de Enviar -->
                                <div class="col-12">
                                    <button type="submit" name="update_cardapioCafe" class="btn btn-primary">Atualizar Cardápio</button>
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