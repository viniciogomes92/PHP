<?php
session_start();
require ("./connect_pdo.php");

if(empty($_SESSION)){
  header('Location: index.php');
}

$valorSelecionado = isset($_GET['mesano']) ? $_GET['mesano'] : '';

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Relatório Mensal de Avaliações</title>
    <link href="./css/bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/flatpickr/flatpicker.min.css">
    <link rel="stylesheet" href="./css/flatpickr/monthSelect.css">
    <link rel="shortcut icon" href="./assets/img/heraldica_bamrj.png" type="image/x-icon">
</head>
<body>
    <script src="./js/bootstrap/bootstrap.js" defer></script>
    <?php include ("./navbar.php"); ?>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Relatório Mensal de Avaliações</h4>
                    </div>
                    <div class="card-body">
                        <form action="exportar_relatorio_avaliacoes.php" method="GET">
                            <div class="mb-3">
                                <label class="form-label" for="tipoRelatorio">Relatório de:</label>
                                <select class="form-control" name="tipoRelatorio" id="tipoRelatorio">
                                    <option value="cafe" selected>Café da Manhã</option>
                                    <option value="almoco">Almoço</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="mes_ano">Selecione um mês:</label>
                                <input type="text" class="flatpickr-input form-control" id="mes_ano" name="mes_ano" placeholder="Selecione o mês/ano" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                                <a href="./cardapios_dashboard.php" class="btn btn-secondary">Voltar</a>
                                <?php 
                                    include ('./mensagem.php');
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/flatpickr/flatpickr.js" defer></script>
    <script src="./js/flatpickr/pt.js" defer></script>
    <script src="./js/flatpickr/monthSelect.js" defer></script>
    <script src="./js/relatorioMensal.js" defer></script>
</body>
</html>