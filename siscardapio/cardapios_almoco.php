<?php 
session_start();
require ("./connect_pdo.php");

if(empty($_SESSION)){
  header('Location: index.php');
}

// Configuração da paginação
$itensPorPagina = 7; // Número de itens por página
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaAtual - 1) * $itensPorPagina;

// Busca os itens de cada categoria para o formulário
function getItens($pdo, $tabela) {
    $stmt = $pdo->query("SELECT * FROM $tabela ORDER BY nome_$tabela");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Busca todos os cardápios cadastrados para exibir na listagem (com paginação)
function getCardapios($pdo, $itensPorPagina, $offset) {
    // Query para contar o total de registros
    $sqlCount = "SELECT COUNT(*) as total FROM cardapio_almoco";
    $totalRegistros = $pdo->query($sqlCount)->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Query principal com paginação
    $sql = "SELECT c.*, 
                   e.nome_entrada,
                   p.nome_prato_principal,
                   g.nome_guarnicao,
                   a.nome_acompanhamento,
                   s.nome_sobremesa
            FROM cardapio_almoco c
            LEFT JOIN entrada e ON c.id_entrada = e.id_entrada
            LEFT JOIN prato_principal p ON c.id_prato_principal = p.id_prato_principal
            LEFT JOIN guarnicao g ON c.id_guarnicao = g.id_guarnicao
            LEFT JOIN acompanhamento a ON c.id_acompanhamento = a.id_acompanhamento
            LEFT JOIN sobremesa s ON c.id_sobremesa = s.id_sobremesa
            ORDER BY c.data_cardapio DESC
            LIMIT $itensPorPagina OFFSET $offset";
    
    $resultados = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    
    return [
        'dados' => $resultados,
        'total' => $totalRegistros,
        'paginas' => ceil($totalRegistros / $itensPorPagina)
    ];
}

$entradas = getItens($pdo, 'entrada');
$pratos = getItens($pdo, 'prato_principal');
$guarnicoes = getItens($pdo, 'guarnicao');
$acompanhamentos = getItens($pdo, 'acompanhamento');
$sobremesas = getItens($pdo, 'sobremesa');
$cardapiosData = getCardapios($pdo, $itensPorPagina, $offset);
$cardapios = $cardapiosData['dados'];
$totalPaginas = $cardapiosData['paginas'];
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="'nipth=device-'nipth, initial-scale=1">
    <title>Cardápios Almoço</title>
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
              <h4>Novo Cardápio de Almoço
                <div class="float-end">
                  <a href="./cardapios_dashboard.php" class="btn btn-danger">Voltar</a>
                </div>
              </h4>
            </div>
            <div class="card-body">
                <?php if (isset($success_message)): ?>
                    <div class="alert alert-success"><?= $success_message ?></div>
                <?php elseif (isset($error_message)): ?>
                    <div class="alert alert-danger"><?= $error_message ?></div>
                <?php endif; ?>
                
                <form method="POST" action="acoes_cardapios_almoco.php">
                    <div class="row g-3">
                        <!-- Data do Cardápio -->
                        <div class="col-md-6">
                            <label for="data_cardapio" class="form-label">Data do Cardápio</label>
                            <input type="date" class="form-control" id="data_cardapio" name="data_cardapio" required>
                        </div>
                        
                        <!-- Entrada -->
                        <div class="col-md-6">
                            <label for="id_entrada" class="form-label">Entrada</label>
                            <select class="form-select" id="id_entrada" name="id_entrada" required>
                                <option value="">Selecione...</option>
                                <?php foreach ($entradas as $entrada): ?>
                                    <option value="<?= $entrada['id_entrada'] ?>"><?= htmlspecialchars($entrada['nome_entrada']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Prato Principal -->
                        <div class="col-md-6">
                            <label for="id_prato_principal" class="form-label">Prato Principal</label>
                            <select class="form-select" id="id_prato_principal" name="id_prato_principal" required>
                                <option value="">Selecione...</option>
                                <?php foreach ($pratos as $prato): ?>
                                    <option value="<?= $prato['id_prato_principal'] ?>"><?= htmlspecialchars($prato['nome_prato_principal']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Guarnição -->
                        <div class="col-md-6">
                            <label for="id_guarnicao" class="form-label">Guarnição</label>
                            <select class="form-select" id="id_guarnicao" name="id_guarnicao" required>
                                <option value="">Selecione...</option>
                                <?php foreach ($guarnicoes as $guarnicao): ?>
                                    <option value="<?= $guarnicao['id_guarnicao'] ?>"><?= htmlspecialchars($guarnicao['nome_guarnicao']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Acompanhamento -->
                        <div class="col-md-6">
                            <label for="id_acompanhamento" class="form-label">Acompanhamento</label>
                            <select class="form-select" id="id_acompanhamento" name="id_acompanhamento" required>
                                <option value="">Selecione...</option>ass="form-select" id="id_acompanham
                                <?php foreach ($acompanhamentos as $acompanhamento): ?>
                                    <option value="<?= $acompanhamento['id_acompanhamento'] ?>"><?= htmlspecialchars($acompanhamento['nome_acompanhamento']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Sobremesa -->
                        <div class="col-md-6">
                            <label for="id_sobremesa" class="form-label">Sobremesa</label>
                            <select class="form-select" id="id_sobremesa" name="id_sobremesa" required>
                                <option value="">Selecione...</option>
                                <?php foreach ($sobremesas as $sobremesa): ?>
                                    <option value="<?= $sobremesa['id_sobremesa'] ?>"><?= htmlspecialchars($sobremesa['nome_sobremesa']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Botão de Enviar -->
                        <div class="col-12">
                            <button type="submit" name="create_cardapioAlmoco" class="btn btn-primary">Cadastrar Cardápio</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
          <!-- Listagem de Cardápios -->                              
          <div class="card mt-5">
            <div class="card-header">
                <h5 class="mb-0">Cardápios Cadastrados</h5>
            </div>
            <div class="card-body">
                <?php if (count($cardapios) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Entrada</th>
                                    <th>Prato Principal</th>
                                    <th>Guarnição</th>
                                    <th>Acompanhamento</th>
                                    <th>Sobremesa</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cardapios as $cardapio): ?>
                                    <tr class="cardapio-item">
                                        <td hidden><?= $cardapio['id_cardapio'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($cardapio['data_cardapio'])) ?></td>
                                        <td><?= htmlspecialchars($cardapio['nome_entrada']) ?></td>
                                        <td><?= htmlspecialchars($cardapio['nome_prato_principal']) ?></td>
                                        <td><?= htmlspecialchars($cardapio['nome_guarnicao']) ?></td>
                                        <td><?= htmlspecialchars($cardapio['nome_acompanhamento']) ?></td>
                                        <td><?= htmlspecialchars($cardapio['nome_sobremesa']) ?></td>
                                        <td>
                                            <a href="cardapios_almoco-edit.php?id=<?= $cardapio['id_cardapio'] ?>&data_cardapio=<?= $cardapio['data_cardapio'] ?>" class="btn btn-sm btn-success mb-1">
                                                <span class="bi-pencil-fill"></span>&nbsp;Editar
                                            </a>
                                            
                                            <form action="./acoes_cardapios_almoco.php" method="POST" class="d-inline">
                                                <button onclick="return confirmaDeleteCardapioAlmoco(<?=$cardapio['id_cardapio']?>, '<?= $cardapio['data_cardapio'] ?>')" type="button" name="delete_cardapioAlmoco" value="<?=$cardapio['id_cardapio']?>" class="btn btn-danger btn-sm">
                                                <span class="bi-trash3-fill"></span>&nbsp;Excluir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Paginação -->
                    <nav aria-label="Navegação de páginas">
                        <ul class="pagination justify-content-center">
                            <?php if ($paginaAtual > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?pagina=<?= $paginaAtual - 1 ?>" aria-label="Anterior">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            
                            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                                <li class="page-item <?= ($i == $paginaAtual) ? 'active' : '' ?>">
                                    <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            
                            <?php if ($paginaAtual < $totalPaginas): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?pagina=<?= $paginaAtual + 1 ?>" aria-label="Próximo">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    
                    <div class="text-center text-muted">
                        Mostrando <?= count($cardapios) ?> de <?= $cardapiosData['total'] ?> registros
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">Nenhum cardápio cadastrado ainda.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
      </div>
    </div>
  </body>
</html>