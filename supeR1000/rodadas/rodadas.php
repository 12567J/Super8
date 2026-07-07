<?php
require_once '../utils/json_helper.php';

$rodadas = ler_json('rodadas.json');
$participantes = ler_json('participantes.json');
$config = ler_json('config.json');
$formato = isset($config['formato']) ? $config['formato'] : 'rotativas';

$totalRodadas = count($rodadas);
$rodadaPendente = 0;

foreach ($rodadas as $num => $r) {
    if (!$r['concluida']) {
        $rodadaPendente = $num;
        break;
    }
}

if ($rodadaPendente === 0 && !empty($rodadas)) {
    $rodadaPendente = $totalRodadas;
}

$rodadaExibidaNum = isset($_GET['r']) ? (int)$_GET['r'] : $rodadaPendente;
if ($rodadaExibidaNum < 1) { $rodadaExibidaNum = 1; }
if ($rodadaExibidaNum > $totalRodadas) { $rodadaExibidaNum = $totalRodadas; }

$rodadaAtual = isset($rodadas[$rodadaExibidaNum]) ? $rodadas[$rodadaExibidaNum] : null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rodadas - Super 8</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/ui.js" defer></script>
    <style>
        .paginacao-rodadas {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
            width: 100%;
        }
        .paginacao-link {
            display: inline-block;
            padding: 6px 12px;
            background-color: #FFFFFF;
            color: #333333;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            border: 1px solid #DCDCDC;
            font-size: 0.9rem;
        }
        .paginacao-link:hover {
            background-color: #FFA500;
            color: #FFFFFF;
            border-color: #FFA500;
        }
        .paginacao-atual {
            background-color: #FFA500;
            color: #FFFFFF;
            border-color: #FFA500;
        }
    </style>
</head>
<body>
    <header>SISTEMA SUPER 8 - BEACH TENNIS</header>
    <div class="container">
        <?php if (isset($_GET['sucesso'])): ?>
            <div class="sucesso-msg">Rodadas salvas com sucesso</div>
        <?php endif; ?>

        <?php if (!$rodadaAtual): ?>
            <div class="card">
                <p style="text-align: center; font-weight: bold;">Nenhuma rodada gerada até o momento.</p>
            </div>
        <?php else: ?>
            <h2 style="text-align: center; margin-bottom: 5px;">Rodada <?php echo $rodadaExibidaNum; ?> de <?php echo $totalRodadas; ?></h2>
            
            <div class="paginacao-rodadas">
                <?php for ($i = 1; $i <= $totalRodadas; $i++): 
                    if ($i <= $rodadaPendente || $rodadas[$i]['concluida'] || $i === $rodadaExibidaNum): ?>
                        <a href="rodadas.php?r=<?php echo $i; ?>" class="paginacao-link <?php echo ($i === $rodadaExibidaNum) ? 'paginacao-atual' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>

            <form action="salvar_placar.php" method="POST">
                <input type="hidden" name="rodada_num" value="<?php echo $rodadaExibidaNum; ?>">
                
                <?php foreach (['quadra1', 'quadra2'] as $q): 
                    $jogo = $rodadaAtual['jogos'][$q];
                    $jogadorA1 = isset($participantes[$jogo['duplaA'][0]]['nome']) ? $participantes[$jogo['duplaA'][0]]['nome'] : '';
                    $jogadorA2 = isset($participantes[$jogo['duplaA'][1]]['nome']) ? $participantes[$jogo['duplaA'][1]]['nome'] : '';
                    $jogadorB1 = isset($participantes[$jogo['duplaB'][0]]['nome']) ? $participantes[$jogo['duplaB'][0]]['nome'] : '';
                    $jogadorB2 = isset($participantes[$jogo['duplaB'][1]]['nome']) ? $participantes[$jogo['duplaB'][1]]['nome'] : '';
                    
                    $nomeDuplaA = $formato === 'fixas' ? "Dupla A (" . $jogadorA1 . " / " . $jogadorA2 . ")" : $jogadorA1 . ' / ' . $jogadorA2;
                    $nomeDuplaB = $formato === 'fixas' ? "Dupla B (" . $jogadorB1 . " / " . $jogadorB2 . ")" : $jogadorB1 . ' / ' . $jogadorB2;
                ?>
                    <div class="rodada-container">
                        <h3 style="text-transform: uppercase; margin-bottom: 10px; border-bottom: 1px solid #DCDCDC; padding-bottom: 5px;"><?php echo $q; ?></h3>
                        
                        <div class="placar-input">
                            <span><?php echo $nomeDuplaA; ?></span>
                            <input type="number" class="placar-A" name="<?php echo $q; ?>_A" min="0" max="15" value="<?php echo $jogo['placarA'] !== '' ? $jogo['placarA'] : ''; ?>">
                        </div>
                        <div class="placar-input">
                            <span><?php echo $nomeDuplaB; ?></span>
                            <input type="number" class="placar-B" name="<?php echo $q; ?>_B" min="0" max="15" value="<?php echo $jogo['placarB'] !== '' ? $jogo['placarB'] : ''; ?>">
                        </div>
                    </div>
                <?php endforeach; ?>

                <button type="submit" class="btn">Salvar</button>
            </form>
        <?php endif; ?>
        <a href="../index.php" class="btn btn-voltar">Voltar à Tela Inicial</a>
    </div>
   <footer>
        <p>Programação para Internet I </p>
        <br>
        <p> Desenvolvido por Luiza Batista Sirqueira </p>
    </footer>
</body>
</html>