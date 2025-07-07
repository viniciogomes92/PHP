<?php 

session_start();

require './connect_pdo.php';

date_default_timezone_set('America/Sao_Paulo');
$data_avaliacao = date('Y-m-d');
// $hora = new DateTime(date("H:i"));
$hora = new DateTime("12:15");
$horaCafeInicio = new DateTime("06:00");
$horaCafeFim = new DateTime("08:00");
$horaAlmocoInicio = new DateTime("11:15");
$horaAlmocoFim = new DateTime("13:00");

// Pegar o ID do Cardapio referente à avaliação

function getCardapioAlmoco($pdo, $data_avaliacao) {
    $stmt = $pdo->prepare('SELECT id_cardapio FROM cardapio_almoco 
                        WHERE data_cardapio=?');
    // $stmt->execute([$data_avaliacao]);
    $stmt->execute(["2025-05-06"]);

    $id_cardapio = $stmt->fetch();

    if ($id_cardapio) {
        return strval($id_cardapio[0]);
    } else {
         // Armazena a mensagem na sessão
        $_SESSION['swal'] = [
            'title' => 'Cardápio não encontrado',
            'text' => "Nenhum cardápio encontrado para data: " . $data_avaliacao . ". Favor contactar a Div. de Sistemas do CLTIAB (Ramal: 2759).",
            'icon' => 'error',
            'confirmButtonText' => 'OK'
        ];
        header('Location: avaliacao_rancho.php');
        exit;
    }
}

function getCardapioCafe($pdo, $data_avaliacao) {
    $stmt = $pdo->prepare('SELECT id_cardapio FROM cardapio_cafe 
                        WHERE data_cardapio=?');
    $stmt->execute([$data_avaliacao]);
    // $stmt->execute(["2025-05-06"]);

    $id_cardapio = $stmt->fetch();

    if ($id_cardapio) {
        return strval($id_cardapio[0]);
    } else {
        // Armazena a mensagem na sessão
        $_SESSION['swal'] = [
            'title' => 'Cardápio não encontrado',
            'text' => "Nenhum cardápio encontrado para data: " . $data_avaliacao . ". Favor contactar a Div. de Sistemas do CLTIAB (Ramal: 2759).",
            'icon' => 'error',
            'confirmButtonText' => 'OK'
        ];
        header('Location: avaliacao_rancho.php');
        exit;
    }
}

if (isset($_GET['create_avaliacao'])) {
    $id_questao = $_GET['create_avaliacao'];
    $nota_avaliacao = $_GET['nota'];

    if (($hora >= $horaCafeInicio) && ($hora <= $horaCafeFim)) {
        $id_cardapio = getCardapioCafe($pdo, $data_avaliacao);

        try {
            $stmt = $pdo->prepare("INSERT INTO avaliacao_cafe 
                                (id_cardapio, id_questao, nota_avaliacao, data_avaliacao) 
                                VALUES (?, ?, ?, ?)");
            $stmt->execute([$id_cardapio, $id_questao, $nota_avaliacao, $data_avaliacao]);

            $_SESSION['swal'] = [
                'title' => 'Pergunta Respondida, obrigado!',
                'icon' => 'success',
                'confirmButtonText' => 'OK'
            ];
            header('Location: avaliacao_rancho.php');
            exit;
        } catch (PDOException $e) {
            $_SESSION['swal'] = [
                'title' => 'Pergunta não contabilizada!',
                'icon' => 'error',
                'confirmButtonText' => 'OK'
            ];
            header('Location: avaliacao_rancho.php');
            exit;
        }
    } elseif (($hora >= $horaAlmocoInicio) && ($hora <= $horaAlmocoFim)) {
        $id_cardapio = getCardapioAlmoco($pdo, $data_avaliacao);
        
        try {
            $stmt = $pdo->prepare("INSERT INTO avaliacao_almoco 
                                (id_cardapio, id_questao, nota_avaliacao, data_avaliacao) 
                                VALUES (?, ?, ?, ?)");
            $stmt->execute([$id_cardapio, $id_questao, $nota_avaliacao, $data_avaliacao]);
            
            $_SESSION['swal'] = [
                'title' => 'Pergunta Respondida, obrigado!',
                'icon' => 'success',
                'confirmButtonText' => 'OK'
            ];
            header('Location: avaliacao_rancho.php');
            exit;
        } catch (PDOException $e) {
           $_SESSION['swal'] = [
                'title' => 'Pergunta não contabilizada!',
                'icon' => 'error',
                'confirmButtonText' => 'OK'
            ];
            header('Location: avaliacao_rancho.php');
            exit;
        }
    } else {
        var_dump("Sem avaliação");
    }
}