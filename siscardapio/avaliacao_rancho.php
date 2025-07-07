<?php 

session_start();

require './connect.php';

$emojis = [
    1 => '😠',
    // 2 => '😕',
    2 => '😐',
    3 => '🙂',
    4 => '😄'
];

// Inicie a sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifique se há mensagem SweetAlert para exibir
if (isset($_SESSION['swal'])) {
    $swal_data = json_encode($_SESSION['swal']);
    unset($_SESSION['swal']); // Limpa a mensagem após pegar
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pesquisa de Satisfação - Rancho BAMRJ</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/heraldica_bamrj.png">
    <link href="./css/bootstrap/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/emojis.css">
    <link rel="stylesheet" href="./css/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./sweetalert2/dist/sweetalert2.css">
</head>
<body class="bg-primary">
<div class="container mt-5 ">
    <div class="card d-flex flex-column align-items-center justify-content-center border rounded-start-5 rounded-end-5 px-5">
        <h1 class="mb-4 text-center display-1 fw-bolder">Pesquisa de Satisfação <br> Rancho BAMRJ </h1>
        <img class="mb-5" style="width: 300px;" src="./assets/img/BAMRJ_NOBG.png" alt="Heráldica BAMRJ">
        <form action="teste.php" method="post" class="d-flex flex-column align-items-center justify-content-center mb-5">
            <?php
            $result = $connect_db->query("SELECT id, questao FROM questoes WHERE ativa='A'");
            while ($row = $result->fetch_assoc()):
            ?>
                <div class="mb-3 d-flex flex-column align-items-center justify-content-center">
                    <label class="form-label display-3 mb-5" style="text-align: center;"><strong><?= htmlspecialchars($row['questao']) ?></strong></label>
                    <div class="form-check form-check-inline">
                        <?php for ($i = 4; $i >= 1; $i--): 
                            $inputId = "questao_{$row['id']}_nota_{$i}";
                        ?>
                            <div class="form-check form-check-inline mb-5">
                                <!-- <input class="form-check-input display-5 me-lg-5" type="radio"
                                    name="respostas[<?= $row['id'] ?>]"
                                    id="<?= $inputId ?>" value="<?= $i ?>" required>
                                <label class="form-check-label display-5" for="<?= $inputId ?>">
                                    <?= $i ?>
                                </label> -->
                                <input class="form-check-input d-none" type="radio"
                                    name="respostas[<?= $row['id'] ?>]"
                                    id="<?= $inputId ?>" value="<?= $i ?>" required>
                                <label onclick="sendAvaliacao(<?= $row['id'] ?>, <?= $i ?>)" class="form-check-label display-1 emoji-label" for="<?= $inputId ?>" style="cursor: pointer;">
                                    <?= $emojis[$i] ?>
                                </label>
                            </div>
                        <?php endfor; ?>
                        <?php 
      
                            include ("./mensagem.php");
                        
                        ?>
                    </div>
                </div>
            <?php endwhile; ?>
            <!-- <button style="width: 500px; height: 100px; font-size: 48px;" type="submit" class="btn btn-primary btn-lg">Enviar</button> -->
        </form>
    </div>
</div>
<script src="./js/bootstrap/bootstrap.js" defer></script>
<script src="./sweetalert2/dist/sweetalert2.js" defer></script>
<script src="./js/sweetAlert2.js" defer></script>
<script src="./js/emojisAnimation.js" defer></script>
<script src="./js/sendAvaliacao.js" defer></script>
<?php if (isset($swal_data)): ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire(<?= $swal_data ?>);
    });
    </script>
<?php endif; ?>
</body>
</html>