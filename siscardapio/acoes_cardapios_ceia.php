<?php 

session_start();

require './connect_pdo.php';

if(empty($_SESSION)){
    header('Location: index.php');
}

date_default_timezone_set('America/Sao_Paulo');

if (isset($_POST['create_cardapioCeia'])) {
    
    $data_cardapio = new DateTime($_POST['data_cardapio']);
    $dataAtual = new DateTime();

    if ($dataAtual > $data_cardapio) {
        $_SESSION['mensagem'] = "Data ultrapassada, não pode ser inserido novo cardápio.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: cardapios_ceia.php');
        exit();
    }

    $data_cardapio = $_POST['data_cardapio'];
    $id_ceia = $_POST['id_ceia'];
    $id_complemento_ceia = $_POST['id_complemento_ceia'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO cardapio_ceia 
                              (data_cardapio, id_ceia, id_complemento_ceia) 
                              VALUES (?, ?, ?)");
        $stmt->execute([$data_cardapio, $id_ceia, $id_complemento_ceia]);
        
        $_SESSION['mensagem'] = "Cardápio da Ceia adicionado com sucesso.";
        $_SESSION['mensagem_type'] = "success";
        header('Location: cardapios_ceia.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Cardápio da Ceia não foi adicionado.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: cardapios_ceia.php');
    }
}

// Atualizar Cardápio de Ceia
if(isset($_POST['update_cardapioCeia'])) {
    $id_cardapio = $_POST['id_cardapio'];
    $data_cardapio = $_POST['data_cardapio'];
    $id_ceia = $_POST['id_ceia'];
    $id_complemento_ceia = $_POST['id_complemento_ceia'];

    try {
        $query = "UPDATE cardapio_ceia SET 
                  data_cardapio=:data_cardapio, 
                  id_ceia=:id_ceia, 
                  id_complemento_ceia=:id_complemento_ceia
                  WHERE id_cardapio=:id_cardapio";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':data_cardapio', $data_cardapio);
        $stmt->bindParam(':id_ceia', $id_ceia);
        $stmt->bindParam(':id_complemento_ceia', $id_complemento_ceia);
        $stmt->bindParam(':id_cardapio', $id_cardapio);
        
        $stmt->execute();
        
        $_SESSION['message'] = "Cardápio de ceia atualizado com sucesso!";
        header('Location: cardapios_ceia.php');
        exit();
        
    } catch(PDOException $e) {
        $_SESSION['message'] = "Erro ao atualizar cardápio de ceia: " . $e->getMessage();
        header('Location: cardapios_ceia.php');
        exit();
    }
}

if (isset($_POST['delete_cardapioCeia_id']) && isset($_POST['delete_cardapioCeia_data'])) {

    $id_cardapio = $_POST['delete_cardapioCeia_id'];

    $data_cardapio = new DateTime($_POST['delete_cardapioCeia_data']);
    $dataAtual = new DateTime();

    if ($dataAtual > $data_cardapio) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Cardápio ultrapassado, não pode ser excluído.',
            'redirect' => 'cardapios_ceia.php'
        ]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM cardapio_ceia WHERE id_cardapio = ?");
        $stmt->execute([$id_cardapio]);

        $_SESSION['mensagem'] = "Cardápio da Ceia excluído com sucesso.";
        $_SESSION['mensagem_type'] = "success";
        header('Location: cardapios_ceia.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Cardápio da Ceia não foi excluído.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: cardapios_ceia.php');
        exit;
    }
}