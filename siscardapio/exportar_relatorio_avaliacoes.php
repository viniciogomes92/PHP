<?php

session_start();

if(empty($_SESSION)){
  header('Location: index.php');
}

require 'connect_pdo.php';
require './dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// Recebe os parâmetros
if ((isset($_GET['mes_ano'])) && (isset($_GET['tipoRelatorio']))) {
    $mes_ano = $_GET['mes_ano'];
    list($ano, $mes) = explode('-', $mes_ano);
    $tipoRelatorio = $_GET['tipoRelatorio'];
}

$totalAvaliacoesMes = 0;
$mesExtenso = '';

switch ($mes) {
    case '01':
        $mesExtenso = 'Janeiro';
        break;
    case '02':
        $mesExtenso = 'Fevereiro';
        break;
    case '03':
        $mesExtenso = 'Março';
        break;
    case '04':
        $mesExtenso = 'Abril';
        break;
    case '05':
        $mesExtenso = 'Maio';
        break;
    case '06':
        $mesExtenso = 'Junho';
        break;
    case '07':
        $mesExtenso = 'Julho';
        break;
    case '08':
        $mesExtenso = 'Agosto';
        break;
    case '09':
        $mesExtenso = 'Setembro';
        break;
    case '10':
        $mesExtenso = 'Outubro';
        break;
    case '11':
        $mesExtenso = 'Novembro';
        break;
    case '12':
        $mesExtenso = 'Dezembro';
        break;
}


if ($tipoRelatorio === "cafe") {
    $sql = "
        SELECT
            ca.data_cardapio,
            q.questao,
            COUNT(a.id_avaliacao) AS total_respostas,
            SUM(CASE WHEN a.nota_avaliacao = 4 THEN 1 ELSE 0 END) / COUNT(a.id_avaliacao) * 100 AS percentual_nota_4,
            SUM(CASE WHEN a.nota_avaliacao = 3 THEN 1 ELSE 0 END) / COUNT(a.id_avaliacao) * 100 AS percentual_nota_3,
            SUM(CASE WHEN a.nota_avaliacao = 2 THEN 1 ELSE 0 END) / COUNT(a.id_avaliacao) * 100 AS percentual_nota_2,
            SUM(CASE WHEN a.nota_avaliacao = 1 THEN 1 ELSE 0 END) / COUNT(a.id_avaliacao) * 100 AS percentual_nota_1,
            e.nome_cafe,
            p.nome_complemento
        FROM cardapio_cafe ca
        JOIN avaliacao_cafe a ON ca.id_cardapio = a.id_cardapio
        JOIN questoes q ON a.id_questao = q.id
        JOIN cafe e ON ca.id_cafe = e.id_cafe
        JOIN complemento p ON ca.id_complemento = p.id_complemento
        WHERE MONTH(ca.data_cardapio) = ? AND YEAR(ca.data_cardapio) = ?
        GROUP BY ca.data_cardapio, q.id
        ORDER BY ca.data_cardapio, q.id;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$mes, $ano]);
    $dados = $stmt->fetchAll();
} elseif ($tipoRelatorio === "almoco") {
    $sql = "
        SELECT
            ca.data_cardapio,
            q.questao,
            COUNT(a.id_avaliacao) AS total_respostas,
            SUM(CASE WHEN a.nota_avaliacao = 4 THEN 1 ELSE 0 END) / COUNT(a.id_avaliacao) * 100 AS percentual_nota_4,
            SUM(CASE WHEN a.nota_avaliacao = 3 THEN 1 ELSE 0 END) / COUNT(a.id_avaliacao) * 100 AS percentual_nota_3,
            SUM(CASE WHEN a.nota_avaliacao = 2 THEN 1 ELSE 0 END) / COUNT(a.id_avaliacao) * 100 AS percentual_nota_2,
            SUM(CASE WHEN a.nota_avaliacao = 1 THEN 1 ELSE 0 END) / COUNT(a.id_avaliacao) * 100 AS percentual_nota_1,
            e.nome_entrada,
            p.nome_prato_principal,
            g.nome_guarnicao,
            aco.nome_acompanhamento,
            s.nome_sobremesa
        FROM cardapio_almoco ca
        JOIN avaliacao_almoco a ON ca.id_cardapio = a.id_cardapio
        JOIN questoes q ON a.id_questao = q.id
        JOIN entrada e ON ca.id_entrada = e.id_entrada
        JOIN prato_principal p ON ca.id_prato_principal = p.id_prato_principal
        JOIN guarnicao g ON ca.id_guarnicao = g.id_guarnicao
        JOIN acompanhamento aco ON ca.id_acompanhamento = aco.id_acompanhamento
        JOIN sobremesa s ON ca.id_sobremesa = s.id_sobremesa
        WHERE MONTH(ca.data_cardapio) = ? AND YEAR(ca.data_cardapio) = ?
        GROUP BY ca.data_cardapio, q.id
        ORDER BY ca.data_cardapio, q.id;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$mes, $ano]);
    $dados = $stmt->fetchAll();
}

if (!$dados) {
    $_SESSION['mensagem'] = "Não existem avaliações para o mês selecionado.";
    $_SESSION['mensagem_type'] = "danger";
    header('Location: exportar_relatorio_mensal.php');
    exit;
}
 
// Agrupar os dados por dia
$relatorio = [];
foreach ($dados as $linha) {
    $data = date('d/m/Y', strtotime($linha['data_cardapio']));
    if ($tipoRelatorio === "almoco") {
        if (!isset($relatorio[$data])) {
            $relatorio[$data] = [
                'cardapio' => "{$linha['nome_entrada']}, {$linha['nome_prato_principal']}, {$linha['nome_guarnicao']}, {$linha['nome_acompanhamento']}, {$linha['nome_sobremesa']}",
                'questoes' => []
            ];
        }
    } elseif ($tipoRelatorio === "cafe") {
        if (!isset($relatorio[$data])) {
            $relatorio[$data] = [
                'cardapio' => "{$linha['nome_cafe']}, {$linha['nome_complemento']}",
                'questoes' => []
            ];
        }
    }
    
    $relatorio[$data]['questoes'][] = [
        'questao' => $linha['questao'],
        '4' => number_format($linha['percentual_nota_4'], 2),
        '3' => number_format($linha['percentual_nota_3'], 2),
        '2' => number_format($linha['percentual_nota_2'], 2),
        '1' => number_format($linha['percentual_nota_1'], 2),
        'total' => $linha['total_respostas']
    ];
}

// Montar o HTML
$html = '
<style>
body { font-family: DejaVu Sans, sans-serif; }
h2 { text-align: center; }
table { width: 100%; border-collapse: collapse; font-size: 12px; }
th, td { border: 1px solid #000; padding: 5px; text-align: center; }
th { background-color: #eee; }
.cardapio { 
    text-align: center;
}

table.cabecalho { 
    border: none;
}
</style>

<table class="cabecalho" style="width: 100%; margin-bottom: 20px;">
    <tr>
        <td style="width: 20%; text-align: center;">
            <img src="http://bamrj.mb/sites/default/files/BRASAO%20DRUPAL%20BAMRJ_0_0.png" alt="Heráldica BAMRJ" width="80">
        </td>
        <td style="text-align: center;">
            <h1 style="margin: 0;">Base de Abastecimento da Marinha no Rio de Janeiro</h1>
            <h2 style="margin: 0;">Relatório de Avaliação do Cardápio - '.$mes.'/'.$ano.'</h2>
        </td>
    </tr>
</table>


<table>
<thead>
    <tr>
        <th>Data</th>
        <th>Questão</th>
        <th>4</th>
        <th>3</th>
        <th>2</th>
        <th>1</th>
        <th>Total de Avaliações por Questão</th>
        <th>Cardápio do Dia</th>
    </tr>
</thead>
<tbody>
';

foreach ($relatorio as $data => $info) {
    $rowspan = count($info['questoes']);
    $primeira = true;
    foreach ($info['questoes'] as $q) {
        $html .= '<tr>';
        if ($primeira) {
            $html .= '<td rowspan="'.$rowspan.'">'.$data.'</td>';
        }
        $html .= '
            <td>'.$q['questao'].'</td>
            <td>'.$q['4'].'</td>
            <td>'.$q['3'].'</td>
            <td>'.$q['2'].'</td>
            <td>'.$q['1'].'</td>
            <td>'.$q['total'].'</td>';
        if ($primeira) {
            $html .= '<td class="cardapio" rowspan="'.$rowspan.'">'.$info['cardapio'].'</td>';
            $primeira = false;
        }
        $html .= '</tr>';
        $totalAvaliacoesMes += $q['total'];
    }
}

$html .= '
</tbody>
</table>
<p style="text-align: right;">Total de Avaliações do mês de ' . $mesExtenso . ': ' . $totalAvaliacoesMes .'</p>
';


// Gerar o PDF
$dompdf = new Dompdf();
$dompdf->set_option('isRemoteEnabled', true);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("relatorio_cardapio_{$mes}_{$ano}.pdf", ["Attachment" => false]);
?>
