<?php
session_start();
require ("./connect_pdo.php");
require('./fpdf/fpdf.php');

if(empty($_SESSION)){
  header('Location: index.php');
}

// Configurar locale para português Brasil
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

class PDF extends FPDF {
    function __construct() {
        parent::__construct('L'); // Modo paisagem (horizontal)
    }
    
    function Header() {
        $this->Image('./assets/img/heraldica_bamrj.png',28, 4, 14);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 3, mb_convert_encoding('MARINHA DO BRASIL', "Windows-1252", "UTF-8"), 0, 1, 'C');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 5, mb_convert_encoding('BASE DE ABASTECIMENTO DA MARINHA NO RIO DE JANEIRO', "Windows-1252", "UTF-8"), 0, 1, 'C');
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 3, mb_convert_encoding('CARDÁPIO SEMANAL', "Windows-1252", "UTF-8"), 0, 1, 'C');
        $this->Ln(5);
    }
    
    function Footer() {
        $this->SetY(-12);
        $this->SetFont('Arial', 'I', 7);
        $this->Cell(0, 5, mb_convert_encoding('Página '.$this->PageNo().'/{nb}', "Windows-1252", "UTF-8"), 0, 0, 'C');
    }
    
    function SemanaTitle($inicio, $fim) {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 5, mb_convert_encoding(('DE '.$inicio.' À '.$fim), "Windows-1252", "UTF-8"), 0, 1, 'C');
        $this->Ln(1);
    }
    
    function DiasSemana($dias, $dates) {
        $this->SetFont('Arial', 'B', 10);
        // Cabeçalho dos dias
        foreach($dias as $dia) {
            $this->Cell(37, 5, mb_convert_encoding($dia, "Windows-1252", "UTF-8"), 1, 0, 'C');
        }
        $this->Ln();
        
        // Datas
        $this->SetFont('Arial', '', 9);
        foreach($dates as $date) {
            $this->Cell(37, 5, mb_convert_encoding($date, "Windows-1252", "UTF-8"), 1, 0, 'C');
        }
        $this->Ln();
    }
    
    function calcularAlturaTexto($texto, $largura = 37) {
        $this->SetFont('Arial', '', 9);
        $numeroLinhas = ceil($this->GetStringWidth($texto) / $largura);
        return max(5, $numeroLinhas * 4);
    }
    
    function NbLines($w, $txt) {
        // Função para contar número de linhas necessárias em uma célula
        $cw = &$this->CurrentFont['cw'];
        if($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else {
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else {
                $i++;
            }
        }
        return $nl;
    }

    function escreverLinhaCardapio($titulo, $dados) {
        $this->SetFont('Arial', 'B', 12);
        
        if (trim($titulo)) {
            $this->Cell(0, 7, mb_convert_encoding($titulo, "Windows-1252", "UTF-8"), 0, 1, 'C');
        }
        
        $this->SetFont('Arial', '', 8);
        $yInicial = $this->GetY();
        $xInicial = $this->GetX();
        $larguraCelula = 37;
        $alturaMinima = 5;
        $alturas = [];
        $buffers = [];
    
        // 1. Calcular altura necessária de cada célula
        foreach ($dados as $texto) {
            $texto = !empty($texto) ? $texto : 'N/D';
            $nb = $this->NbLines($larguraCelula, mb_convert_encoding($texto, "Windows-1252", "UTF-8"));
            $altura = max($alturaMinima, $nb * 4); // 4 = altura da linha
            $alturas[] = $altura;
            $buffers[] = mb_convert_encoding($texto, "Windows-1252", "UTF-8");
        }
    
        // 2. Determinar altura máxima para a linha
        $alturaLinha = max($alturas);
    
        // 3. Escrever cada célula com a mesma altura
        for ($i = 0; $i < count($buffers); $i++) {
            $x = $this->GetX();
            $y = $this->GetY();
            $this->MultiCell($larguraCelula, 4, $buffers[$i], 0, 'C'); // Desenha sem borda
            $this->SetXY($x, $y); // Volta
            $this->Cell($larguraCelula, $alturaLinha, '', 1, 0); // Desenha borda
            $this->SetXY($x + $larguraCelula, $y); // Próxima célula
        }
    
        $this->Ln($alturaLinha + 1); // Pula para a próxima linha
    }
    
    
    function CardapioCompleto($cafeData, $almocoData, $jantarData, $ceiaData, $agenteFiscalData, $nutricionistaData, $gestorMunicData) {
        // Café da manhã
        $this->escreverLinhaCardapio('CAFÉ DA MANHÃ', $cafeData);
        
        // Almoço
        $this->escreverLinhaCardapio('ALMOÇO', $almocoData['salada']);
        $this->escreverLinhaCardapio('', $almocoData['prato_principal']);
        $this->escreverLinhaCardapio('', $almocoData['guarnicao']);
        $this->escreverLinhaCardapio('', $almocoData['acompanhamento']);
        $this->escreverLinhaCardapio('', $almocoData['sobremesa']);

        // Jantar
        $this->escreverLinhaCardapio('JANTAR', $jantarData['salada']);
        $this->escreverLinhaCardapio('', $jantarData['prato_principal']);
        $this->escreverLinhaCardapio('', $jantarData['guarnicao']);
        $this->escreverLinhaCardapio('', $jantarData['acompanhamento']);
        $this->escreverLinhaCardapio('', $jantarData['sobremesa']);

        // Ceia
        $this->escreverLinhaCardapio('CEIA', $ceiaData);
        
        // Adicionar espaço antes das assinaturas
        $this->Ln(15);
        
        // Largura de cada coluna (ajuste conforme necessário)
        $colWidth = 60;
        
        // Posição X inicial para centralizar os três blocos
        $startX = ($this->GetPageWidth() - (3 * $colWidth)) / 2;
        $this->SetX($startX);
        
        // Voltar para a posição X inicial
        $this->SetX($startX);
        
        // Nomes dos responsáveis
        $this->SetFont('Arial', '', 10);
        $this->Cell($colWidth, 5, mb_convert_encoding($agenteFiscalData['nome_agente_fiscal'][0], "Windows-1252", "UTF-8"), 0, 0, 'C');
        $this->Cell($colWidth, 5, mb_convert_encoding($nutricionistaData['nome_nutricionista'][0], "Windows-1252", "UTF-8"), 0, 0, 'C');
        $this->Cell($colWidth, 5, mb_convert_encoding($gestorMunicData['nome_gestor_munic'][0], "Windows-1252", "UTF-8"), 0, 1, 'C');
        
        // Espaço para Posto/Graduação
        $this->Ln(2);
        $this->SetX($startX);

        //Posto/Graduação dos Responsáveis
        $this->SetFont('Arial', '', 7);
        
        $this->Cell($colWidth, 5, mb_convert_encoding($agenteFiscalData['pg_agente_fiscal'][0] . ' (' . $agenteFiscalData['corpo_quadro_agente_fiscal'][0] . ($agenteFiscalData['esp_agente_fiscal'][0] ? ' ' . $agenteFiscalData['esp_agente_fiscal'][0] : '') . ')' , "Windows-1252", "UTF-8"), 0, 0, 'C');
        
        $this->Cell($colWidth, 5, mb_convert_encoding($nutricionistaData['pg_nutricionista'][0] . ' (' . $nutricionistaData['corpo_quadro_nutricionista'][0] . ($nutricionistaData['esp_nutricionista'][0] ? ' ' . $nutricionistaData['esp_nutricionista'][0] : '') . ')' , "Windows-1252", "UTF-8"), 0, 0, 'C');
        
        $this->Cell($colWidth, 5, mb_convert_encoding($gestorMunicData['pg_gestor_munic'][0] . ' (' . $gestorMunicData['corpo_quadro_gestor_munic'][0] . ($gestorMunicData['esp_gestor_munic'][0] ? ' ' . $gestorMunicData['esp_gestor_munic'][0] : '') . ')' , "Windows-1252", "UTF-8"), 0, 0, 'C');


        // Espaço para as assinaturas
        $this->Ln(6);
        $this->SetX($startX);
        
        // Agente Fiscal
        $this->SetFont('Arial', 'B', 6);
        $this->Cell($colWidth, 5, mb_convert_encoding('AGENTE FISCAL', "Windows-1252", "UTF-8"), 0, 0, 'C');
        
        // Nutricionista
        $this->Cell($colWidth, 5, mb_convert_encoding('NUTRICIONISTA', "Windows-1252", "UTF-8"), 0, 0, 'C');
        
        // Gestor Municipal
        $this->Cell($colWidth, 5, mb_convert_encoding('GESTOR DE MUNICIAMENTO', "Windows-1252", "UTF-8"), 0, 1, 'C');
    }
}

// Função para formatar data em português
function formatarDataPortugues($data) {
    $meses = array(
        1 => 'JAN', 2 => 'FEV', 3 => 'MAR', 4 => 'ABR',
        5 => 'MAI', 6 => 'JUN', 7 => 'JUL', 8 => 'AGO',
        9 => 'SET', 10 => 'OUT', 11 => 'NOV', 12 => 'DEZ'
    );
    
    $dia = date('d', strtotime($data));
    $mes = $meses[(int)date('m', strtotime($data))];
    $ano = date('Y', strtotime($data));
    
    return $dia.' '.$mes.' '.$ano;
}

// Função para obter os dias da semana (seg a dom) com datas
function getSemanaDates($dataReferencia) {
    $day = date('N', strtotime($dataReferencia));
    $segunda = date('Y-m-d', strtotime($dataReferencia . ' - ' . ($day - 1) . ' days'));
    
    $dias = array('SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SÁB', 'DOM');
    $dates = array();
    
    for ($i = 0; $i < 7; $i++) {
        $data = date('Y-m-d', strtotime($segunda . ' + ' . $i . ' days'));
        $dates[] = date('d', strtotime($data)) . ' ' . strftime('%b', strtotime($data));
    }
    
    $inicioSemana = formatarDataPortugues($segunda);
    $fimSemana = formatarDataPortugues(date('Y-m-d', strtotime($segunda . ' + 6 days')));
    
    return array(
        'dias' => $dias,
        'dates' => $dates,
        'inicio' => $inicioSemana,
        'fim' => $fimSemana,
        'datas_completas' => array(
            date('Y-m-d', strtotime($segunda . ' + 0 days')),
            date('Y-m-d', strtotime($segunda . ' + 1 days')),
            date('Y-m-d', strtotime($segunda . ' + 2 days')),
            date('Y-m-d', strtotime($segunda . ' + 3 days')),
            date('Y-m-d', strtotime($segunda . ' + 4 days')),
            date('Y-m-d', strtotime($segunda . ' + 5 days')),
            date('Y-m-d', strtotime($segunda . ' + 6 days'))
        )
    );
}

// Buscar cardápios de café por data específica
function getCardapioCafePorData($pdo, $data) {
    $sql = "SELECT e.nome_cafe, p.nome_complemento
            FROM cardapio_cafe c
            LEFT JOIN cafe e ON c.id_cafe = e.id_cafe
            LEFT JOIN complemento p ON c.id_complemento = p.id_complemento
            WHERE c.data_cardapio = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$data]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Buscar cardápios de almoço por data específica
function getCardapioAlmocoPorData($pdo, $data) {
    $sql = "SELECT e.nome_entrada as salada,
                   p.nome_prato_principal as prato_principal,
                   g.nome_guarnicao as guarnicao,
                   a.nome_acompanhamento as acompanhamento,
                   s.nome_sobremesa as sobremesa,
                   m.posto_graduacao as pg_agente_fiscal,
                   m.corpo_quadro as corpo_quadro_agente_fiscal,
                   m.esp as esp_agente_fiscal,
                   m.nome_guerra as nome_guerra_agente_fiscal,
                   m.nome_agente_fiscal as nome_agente_fiscal,
                   n.posto_graduacao as pg_nutricionista,
                   n.corpo_quadro as corpo_quadro_nutricionista,
                   n.esp as esp_nutricionista,
                   n.nome_guerra as nome_guerra_nutricionista,
                   n.nome_nutricionista as nome_nutricionista,
                   o.posto_graduacao as pg_gestor_munic,
                   o.corpo_quadro as corpo_quadro_gestor_munic,
                   o.esp as esp_gestor_munic,
                   o.nome_guerra as nome_guerra_gestor_munic,
                   o.nome_gestor_munic as nome_gestor_munic
            FROM cardapio_almoco c
            LEFT JOIN entrada e ON c.id_entrada = e.id_entrada
            LEFT JOIN prato_principal p ON c.id_prato_principal = p.id_prato_principal
            LEFT JOIN guarnicao g ON c.id_guarnicao = g.id_guarnicao
            LEFT JOIN acompanhamento a ON c.id_acompanhamento = a.id_acompanhamento
            LEFT JOIN sobremesa s ON c.id_sobremesa = s.id_sobremesa
            LEFT JOIN agentes_fiscais m ON c.id_agente_fiscal = m.id_agente_fiscal
            LEFT JOIN nutricionistas n ON c.id_nutricionista = n.id_nutricionista
            LEFT JOIN gestores_munic o ON c.id_gestor_munic = o.id_gestor_munic
            WHERE c.data_cardapio = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$data]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getCardapioJantarPorData($pdo, $data) {
    $sql = "SELECT e.nome_entrada as salada,
                   p.nome_prato_principal as prato_principal,
                   g.nome_guarnicao as guarnicao,
                   a.nome_acompanhamento as acompanhamento,
                   s.nome_sobremesa as sobremesa
            FROM cardapio_jantar c
            LEFT JOIN entrada e ON c.id_entrada = e.id_entrada
            LEFT JOIN prato_principal p ON c.id_prato_principal = p.id_prato_principal
            LEFT JOIN guarnicao g ON c.id_guarnicao = g.id_guarnicao
            LEFT JOIN acompanhamento a ON c.id_acompanhamento = a.id_acompanhamento
            LEFT JOIN sobremesa s ON c.id_sobremesa = s.id_sobremesa
            WHERE c.data_cardapio = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$data]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Buscar cardápios de café por data específica
function getCardapioCeiaPorData($pdo, $data) {
    $sql = "SELECT e.nome_ceia, p.nome_complemento_ceia
            FROM cardapio_ceia c
            LEFT JOIN ceia e ON c.id_ceia = e.id_ceia
            LEFT JOIN complemento_ceia p ON c.id_complemento_ceia = p.id_complemento_ceia
            WHERE c.data_cardapio = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$data]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//Converte Posto/Graduação para nomeclatura extensa
function convertePG ($pg) {
    switch ($pg) {
        case 'AE':
            return $pg ? 'Almirante de Esquadra' : 'Não consta';
            break;
        case 'VA':
            return $pg ? 'Vice-Almirante' : 'Não consta';
            break;
        case 'CA':
            return $pg ? 'Contra-Almirante' : 'Não consta';
            break;
        case 'CMG':
            return $pg ? 'Capitão de Mar e Guerra' : 'Não consta';
            break;
        case 'CF':
            return $pg ? 'Capitão de Fragata' : 'Não consta';
            break;
        case 'CC':
            return $pg ? 'Capitão de Corveta' : 'Não consta';
            break;
        case 'CT':
            return $pg ? 'Capitão-Tenente' : 'Não consta';
            break;
        case '1T':
            return $pg ? 'Primeiro-Tenente' : 'Não consta';
            break;
        case '2T':
            return $pg ? 'Segundo-Tenente' : 'Não consta';
            break;
        case 'GM':
            return $pg ? 'Guarda-Marinha' : 'Não consta';
            break;
        case 'SO':
            return $pg ? 'Suboficial' : 'Não consta';
            break;
        case '1SG':
            return $pg ? 'Primeiro-Sargento' : 'Não consta';
            break;
        case '2SG':
            return $pg ? 'Segundo-Sargento' : 'Não consta';
            break;
        case '3SG':
            return $pg ? 'Terceiro-Sargento' : 'Não consta';
            break;
        case 'CB':
            return $pg ? 'Cabo' : 'Não consta';
            break;
        case 'MN':
            return $pg ? 'Marinheiro' : 'Não consta';
            break;
    }
}

// Obter a semana a partir da data de referência
$dataReferencia = $_GET['data_referencia'];
$semanaInfo = getSemanaDates($dataReferencia);

// Organizar dados no formato da tabela
$cafeData = array();
$almocoData = array(
    'salada' => array(),
    'prato_principal' => array(),
    'guarnicao' => array(),
    'acompanhamento' => array(),
    'sobremesa' => array()
);

$jantarData = array(
    'salada' => array(),
    'prato_principal' => array(),
    'guarnicao' => array(),
    'acompanhamento' => array(),
    'sobremesa' => array()
);

$ceiaData = array();

$agenteFiscalData = array(
    'pg_agente_fiscal' => array(),
    'corpo_quadro_agente_fiscal' => array(),
    'esp_agente_fiscal' => array(),
    'nome_agente_fiscal' => array()
);
$nutricionistaData = array(
    'pg_nutricionista' => array(),
    'corpo_quadro_nutricionista' => array(),
    'esp_nutricionista' => array(),
    'nome_nutricionista' => array()
);
$gestorMunicData = array(
    'pg_gestor_munic' => array(),
    'corpo_quadro_gestor_munic' => array(),
    'esp_gestor_munic' => array(),
    'nome_gestor_munic' => array()
);


foreach($semanaInfo['datas_completas'] as $data) {
    // Buscar cardápio do café para o dia específico
    $cafe = getCardapioCafePorData($pdo, $data);
    $cafeText = $cafe ? $cafe['nome_cafe'] : 'N/D';
    if ($cafe && $cafe['nome_complemento']) {
        $cafeText .= ' ('.$cafe['nome_complemento'].')';
    }
    $cafeData[] = $cafeText;
    
    // Buscar cardápio do almoço para o dia específico
    $almoco = getCardapioAlmocoPorData($pdo, $data);
    $almocoData['salada'][] = $almoco ? $almoco['salada'] : 'N/D';
    $almocoData['prato_principal'][] = $almoco ? $almoco['prato_principal'] : 'N/D';
    $almocoData['guarnicao'][] = $almoco ? $almoco['guarnicao'] : 'N/D';
    $almocoData['acompanhamento'][] = $almoco ? $almoco['acompanhamento'] : 'N/D';
    $almocoData['sobremesa'][] = $almoco ? $almoco['sobremesa'] : 'N/D';

    // Buscar cardápio do almoço para o dia específico
    $jantar = getCardapioJantarPorData($pdo, $data);
    $jantarData['salada'][] = $jantar ? $jantar['salada'] : 'N/D';
    $jantarData['prato_principal'][] = $jantar ? $jantar['prato_principal'] : 'N/D';
    $jantarData['guarnicao'][] = $jantar ? $jantar['guarnicao'] : 'N/D';
    $jantarData['acompanhamento'][] = $jantar ? $jantar['acompanhamento'] : 'N/D';
    $jantarData['sobremesa'][] = $jantar ? $jantar['sobremesa'] : 'N/D';

    // Buscar cardápio da ceia para o dia específico
    $ceia = getCardapioCeiaPorData($pdo, $data);
    $ceiaText = $ceia ? $ceia['nome_ceia'] : 'N/D';
    if ($ceia && $ceia['nome_complemento_ceia']) {
        $ceiaText .= ' ('.$ceia['nome_complemento_ceia'].')';
    }
    $ceiaData[] = $ceiaText;

    // Buscar cardápio do almoço que contém as informações dos responsáveis
    $almoco = getCardapioAlmocoPorData($pdo, $data);
    
    // Agente Fiscal
    $agenteFiscalData['pg_agente_fiscal'][] = $almoco ? convertePG($almoco['pg_agente_fiscal']) : 'Não Consta';
    $agenteFiscalData['corpo_quadro_agente_fiscal'][] = $almoco ? $almoco['corpo_quadro_agente_fiscal'] : 'Não Consta';
    $agenteFiscalData['esp_agente_fiscal'][] = $almoco ? $almoco['esp_agente_fiscal'] : '';
    $agenteFiscalData['nome_agente_fiscal'][] = $almoco ? $almoco['nome_agente_fiscal'] : 'Não consta';
    
    // Nutricionista
    $nutricionistaData['pg_nutricionista'][] = $almoco ? convertePG($almoco['pg_nutricionista']) : 'Não Consta';
    $nutricionistaData['corpo_quadro_nutricionista'][] = $almoco ? $almoco['corpo_quadro_nutricionista'] : 'Não Consta';
    $nutricionistaData['esp_nutricionista'][] = $almoco ? $almoco['esp_nutricionista'] : '';
    $nutricionistaData['nome_nutricionista'][] = $almoco ? $almoco['nome_nutricionista'] : 'Não consta';
    
    // Gestor Municiamento
    $gestorMunicData['pg_gestor_munic'][] = $almoco ? convertePG($almoco['pg_gestor_munic']) : 'Não Consta';
    $gestorMunicData['corpo_quadro_gestor_munic'][] = $almoco ? $almoco['corpo_quadro_gestor_munic'] : 'Não Consta';
    $gestorMunicData['esp_gestor_munic'][] = $almoco ? $almoco['esp_gestor_munic'] : '';
    $gestorMunicData['nome_gestor_munic'][] = $almoco ? $almoco['nome_gestor_munic'] : 'Não consta';
}

// Criar PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Título da semana
$pdf->SemanaTitle($semanaInfo['inicio'], $semanaInfo['fim']);

// Dias da semana
$pdf->DiasSemana($semanaInfo['dias'], $semanaInfo['dates']);

// Cardápio completo com células individuais por dia
$pdf->CardapioCompleto($cafeData, $almocoData, $jantarData, $ceiaData, $agenteFiscalData, $nutricionistaData, $gestorMunicData);

// Gerar nome do arquivo com a semana
$nomeArquivo = 'Cardapio_Semanal_'.str_replace(' ', '_', $semanaInfo['inicio']).'_a_'.str_replace(' ', '_', $semanaInfo['fim']).'.pdf';

// Saída do PDF
$pdf->Output('D', $nomeArquivo);

?>