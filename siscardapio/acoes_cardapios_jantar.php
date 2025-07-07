<?php 

session_start();

require './connect_pdo.php';

if(empty($_SESSION)){
    header('Location: index.php');
}

date_default_timezone_set('America/Sao_Paulo');


if (isset($_POST['create_cardapioJantar'])) {
    
    $data_cardapio = new DateTime($_POST['data_cardapio']);
    $dataAtual = new DateTime();

    if ($dataAtual > $data_cardapio) {
        $_SESSION['mensagem'] = "Data ultrapassada, não pode ser inserido novo cardápio.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: cardapios_cafe.php');
        exit();
    }
    
    $data_cardapio = $_POST['data_cardapio'];
    $id_entrada = $_POST['id_entrada'];
    $id_prato_principal = $_POST['id_prato_principal'];
    $id_guarnicao = $_POST['id_guarnicao'];
    $id_acompanhamento = $_POST['id_acompanhamento'];
    $id_sobremesa = $_POST['id_sobremesa'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO cardapio_jantar 
                              (data_cardapio, id_entrada, id_prato_principal, id_guarnicao, id_acompanhamento, id_sobremesa) 
                              VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$data_cardapio, $id_entrada, $id_prato_principal, $id_guarnicao, $id_acompanhamento, $id_sobremesa]);
        
        $_SESSION['mensagem'] = "Cardápio de Jantar adicionado com sucesso.";
        $_SESSION['mensagem_type'] = "success";
        header('Location: cardapios_jantar.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Cardápio de Jantar não foi adicionado.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: cardapios_jantar.php');
    }
}

// Atualizar Cardápio de Jantar
if(isset($_POST['update_cardapioJantar'])) {
    $id_cardapio = $_POST['id_cardapio'];
    $data_cardapio = $_POST['data_cardapio'];
    $id_entrada = $_POST['id_entrada'];
    $id_prato_principal = $_POST['id_prato_principal'];
    $id_guarnicao = $_POST['id_guarnicao'];
    $id_acompanhamento = $_POST['id_acompanhamento'];
    $id_sobremesa = $_POST['id_sobremesa'];

    try {
        $query = "UPDATE cardapio_jantar SET 
                  data_cardapio=:data_cardapio, 
                  id_entrada=:id_entrada, 
                  id_prato_principal=:id_prato_principal, 
                  id_guarnicao=:id_guarnicao, 
                  id_acompanhamento=:id_acompanhamento, 
                  id_sobremesa=:id_sobremesa
                  WHERE id_cardapio=:id_cardapio";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':data_cardapio', $data_cardapio);
        $stmt->bindParam(':id_entrada', $id_entrada);
        $stmt->bindParam(':id_prato_principal', $id_prato_principal);
        $stmt->bindParam(':id_guarnicao', $id_guarnicao);
        $stmt->bindParam(':id_acompanhamento', $id_acompanhamento);
        $stmt->bindParam(':id_sobremesa', $id_sobremesa);
        $stmt->bindParam(':id_cardapio', $id_cardapio);
        
        $stmt->execute();
        
        $_SESSION['message'] = "Cardápio de jantar atualizado com sucesso!";
        header('Location: cardapios_jantar.php');
        exit();
        
    } catch(PDOException $e) {
        $_SESSION['message'] = "Erro ao atualizar cardápio de jantar: " . $e->getMessage();
        header('Location: cardapios_jantar.php');
        exit();
    }
}

if (isset($_POST['delete_cardapioJantar_id']) && isset($_POST['delete_cardapioJantar_data'])) {
    $id_cardapio = $_POST['delete_cardapioJantar_id'];

    $data_cardapio = new DateTime($_POST['delete_cardapioJantar_data']);
    $dataAtual = new DateTime();

    if ($dataAtual > $data_cardapio) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Cardápio ultrapassado, não pode ser excluído.',
            'redirect' => 'cardapios_jantar.php'
        ]);
        exit;
    }
    
    try {
        $stmt = $pdo->prepare("DELETE FROM cardapio_jantar WHERE id_cardapio = ?");
    
        $stmt->bindParam(1, $_POST['delete_cardapioJantar']);
    
        $stmt->execute();

        $_SESSION['mensagem'] = "Cardápio de Jantar excluído com sucesso.";
        $_SESSION['mensagem_type'] = "success";
        header('Location: cardapios_jantar.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Cardápio de Jantar não foi excluído.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: cardapios_jantar.php');
    }
  }

?>