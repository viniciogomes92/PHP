<?php 

session_start();

require './connect_pdo.php';

if(empty($_SESSION)){
    header('Location: index.php');
}

date_default_timezone_set('America/Sao_Paulo');

if (isset($_POST['create_cardapioAlmoco'])) {
    
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
    
    // Busca os IDs do Agente Fiscal, Nutricionista e Gestor Munic ativos na data da criação do cardápio
    $stmt = $pdo->prepare("SELECT a.id_agente_fiscal, b.id_nutricionista, c.id_gestor_munic
                            FROM agentes_fiscais a, nutricionistas b, gestores_munic c
                            WHERE a.status='A' AND b.status='A' AND c.status='A'");
    $stmt->execute();
    $ids = $stmt->fetchAll();

    foreach ($ids as $id) {
        $id_agente_fiscal = $id['id_agente_fiscal'];
        $id_nutricionista = $id['id_nutricionista'];
        $id_gestor_munic = $id['id_gestor_munic'];
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO cardapio_almoco 
                              (data_cardapio, id_entrada, id_prato_principal, id_guarnicao, id_acompanhamento, id_sobremesa, id_agente_fiscal, id_nutricionista, id_gestor_munic) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$data_cardapio, $id_entrada, $id_prato_principal, $id_guarnicao, $id_acompanhamento, $id_sobremesa, $id_agente_fiscal, $id_nutricionista, $id_gestor_munic]);
        
        $_SESSION['mensagem'] = "Cardápio de Almoço adicionado com sucesso.";
        $_SESSION['mensagem_type'] = "success";
        header('Location: cardapios_almoco.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Cardápio de Almoço não foi adicionado.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: cardapios_almoco.php');
    }
}

// Atualizar Cardápio
if(isset($_POST['update_cardapioAlmoco'])) {
    $id_cardapio = $_POST['id_cardapio'];
    $data_cardapio = $_POST['data_cardapio'];
    $id_entrada = $_POST['id_entrada'];
    $id_prato_principal = $_POST['id_prato_principal'];
    $id_guarnicao = $_POST['id_guarnicao'];
    $id_acompanhamento = $_POST['id_acompanhamento'];
    $id_sobremesa = $_POST['id_sobremesa'];

    try {
        $query = "UPDATE cardapio_almoco SET 
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
        
        $_SESSION['message'] = "Cardápio atualizado com sucesso!";
        header('Location: cardapios_almoco.php');
        exit();
        
    } catch(PDOException $e) {
        $_SESSION['message'] = "Erro ao atualizar cardápio: " . $e->getMessage();
        header('Location: cardapios_almoco.php');
        exit();
    }
}

if (isset($_POST['delete_cardapioAlmoco_id']) && isset($_POST['delete_cardapioAlmoco_data'])) {
    $id_cardapio = $_POST['delete_cardapioAlmoco_id'];

    $data_cardapio = new DateTime($_POST['delete_cardapioAlmoco_data']);
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
        $stmt = $pdo->prepare("DELETE FROM cardapio_almoco WHERE id_cardapio = ?");
    
        $stmt->bindParam(1, $_POST['delete_cardapioAlmoco']);
    
        $stmt->execute();

        $_SESSION['mensagem'] = "Cardápio de Almoço excluído com sucesso.";
        $_SESSION['mensagem_type'] = "success";
        header('Location: cardapios_almoco.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Cardápio de Almoço não foi excluído.";
        $_SESSION['mensagem_type'] = "danger";
        header('Location: cardapios_almoco.php');
    }
  }

?>