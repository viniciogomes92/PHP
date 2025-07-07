<?php 

session_start();

require './connect_pdo.php';

if(empty($_SESSION)){
    header('Location: index.php');
}

date_default_timezone_set('America/Sao_Paulo');

if (isset($_POST['create_cardapioCafe'])) {
    
    $data_cardapio = new DateTime($_POST['data_cardapio']);
    $dataAtual = new DateTime();

    if ($dataAtual > $data_cardapio) {
        $_SESSION['mensagem'] = "Data ultrapassada, não pode ser inserido novo cardápio.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: cardapios_cafe.php');
        exit();
    }
    
    $data_cardapio = $_POST['data_cardapio'];
    $id_cafe = $_POST['id_cafe'];
    $id_complemento = $_POST['id_complemento'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO cardapio_cafe 
                              (data_cardapio, id_cafe, id_complemento) 
                              VALUES (?, ?, ?)");
        $stmt->execute([$data_cardapio, $id_cafe, $id_complemento]);
        
        $_SESSION['mensagem'] = "Cardápio de Café da Manhã adicionado com sucesso.";
        $_SESSION['mensagem_type'] = "success";
        header('Location: cardapios_cafe.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Cardápio de Café da Manhã não foi adicionado.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: cardapios_cafe.php');
    }
}

// Atualizar Cardápio de Café
if(isset($_POST['update_cardapioCafe'])) {
    $id_cardapio = $_POST['id_cardapio'];
    $data_cardapio = $_POST['data_cardapio'];
    $id_cafe = $_POST['id_cafe'];
    $id_complemento = $_POST['id_complemento'];

    try {
        $query = "UPDATE cardapio_cafe SET 
                  data_cardapio=:data_cardapio, 
                  id_cafe=:id_cafe, 
                  id_complemento=:id_complemento
                  WHERE id_cardapio=:id_cardapio";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':data_cardapio', $data_cardapio);
        $stmt->bindParam(':id_cafe', $id_cafe);
        $stmt->bindParam(':id_complemento', $id_complemento);
        $stmt->bindParam(':id_cardapio', $id_cardapio);
        
        $stmt->execute();
        
        $_SESSION['message'] = "Cardápio de café atualizado com sucesso!";
        header('Location: cardapios_cafe.php');
        exit();
        
    } catch(PDOException $e) {
        $_SESSION['message'] = "Erro ao atualizar cardápio de café: " . $e->getMessage();
        header('Location: cardapios_cafe.php');
        exit();
    }
}

if (isset($_POST['delete_cardapioCafe_id']) && isset($_POST['delete_cardapioCafe_data'])) {
    $id_cardapio = $_POST['delete_cardapioCafe_id'];

    $data_cardapio = new DateTime($_POST['delete_cardapioCafe_data']);
    $dataAtual = new DateTime();

    if ($dataAtual > $data_cardapio) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Cardápio ultrapassado, não pode ser excluído.',
            'redirect' => 'cardapios_cafe.php'
        ]);
        exit;
    }
    
    try {
        $stmt = $pdo->prepare("DELETE FROM cardapio_cafe WHERE id_cardapio = ?");
    
        $stmt->bindParam(1, $_POST['delete_cardapioCafe']);
    
        $stmt->execute();

        $_SESSION['mensagem'] = "Cardápio de Café da Manhã excluído com sucesso.";
        $_SESSION['mensagem_type'] = "success";
        header('Location: cardapios_cafe.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Cardápio de Café da Manhã não foi excluído.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: cardapios_cafe.php');
    }
  }

?>