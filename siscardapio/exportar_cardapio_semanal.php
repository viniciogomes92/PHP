<?php
session_start();
require ("./connect_pdo.php");

if(empty($_SESSION)){
  header('Location: index.php');
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selecionar Semana para Cardápio</title>
    <link href="./css/bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap-icons/font/bootstrap-icons.css">
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
                        <h4 class="mb-0">Selecionar Semana para Cardápio</h4>
                    </div>
                    <div class="card-body">
                        <form action="exportar_cardapios_pdf.php" method="GET">
                            <div class="mb-3">
                                <label for="data_referencia" class="form-label">Selecione uma data dentro da semana desejada:</label>
                                <input type="date" class="form-control" id="data_referencia" name="data_referencia" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Gerar Cardápio PDF</button>
                                <a href="./cardapios_dashboard.php" class="btn btn-secondary">Voltar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>