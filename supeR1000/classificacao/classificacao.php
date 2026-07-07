<?php
require_once '../utils/json_helper.php';
require_once '../utils/pontuacao.php';

$participantes = ler_json('participantes.json');
$rodadas = ler_json('rodadas.json');
$config = ler_json('config.json');
$formato = isset($config['formato']) ? $config['formato'] : 'rotativas';

$tabela = calcularClassificacao($participantes, $rodadas);

$textoCampeao = '';
if (!empty($tabela)) {
    if ($formato === 'rotativas') {
        $primeiroId = array_key_first($tabela);
        $textoCampeao = "CAMPEÃO: " . $tabela[$primeiroId]['nome'] . " (" . $tabela[$primeiroId]['pontos'] . " Pts)";
    } else {
        $keys = array_keys($tabela);
        if (count($keys) >= 2) {
            $id1 = $keys[0];
            $id2 = $keys[1];
            $textoCampeao = "CAMPEÕES: " . $tabela[$id1]['nome'] . " / " . $tabela[$id2]['nome'] . " (" . $tabela[$id1]['pontos'] . " Pts)";
        } elseif (count($keys) === 1) {
            $id1 = $keys[0];
            $textoCampeao = "CAMPEÃO: " . $tabela[$id1]['nome'] . " (" . $tabela[$id1]['pontos'] . " Pts)";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classificação - Super 8</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>SISTEMA SUPER 8 - BEACH TENNIS</header>
    <div class="container">
        <h2 style="text-align: center; margin-bottom: 15px;">Tabela de Classificação</h2>
        
        <?php if ($textoCampeao !== ''): ?>
            <div class="sucesso-msg" style="background-color: #FFA500; color: #FFFFFF; font-size: 1.2rem; margin-bottom: 20px;">
                <?php echo $textoCampeao; ?>
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Pos</th>
                    <th>Nome</th>
                    <th>V</th>
                    <th>D</th>
                    <th>GM+</th>
                    <th>GM-</th>
                    <th>Pts</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pos = 1;
                foreach ($tabela as $id => $dados): ?>
                    <tr>
                        <td><strong><?php echo $pos++; ?>º</strong></td>
                        <td style="text-align: left; font-weight: bold;"><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['vitorias']; ?></td>
                        <td><?php echo $dados['derrotas']; ?></td>
                        <td><?php echo $dados['games_vencidos']; ?></td>
                        <td><?php echo $dados['games_perdidos']; ?></td>
                        <td style="background-color: #00FA9A; font-weight: bold;"><?php echo $dados['pontos']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-voltar" style="margin-top: 20px;">Voltar à Tela Inicial</a>
    </div>
   <footer>
        <p>Programação para Internet I </p>
        <br>
        <p> Desenvolvido por Luiza Batista Sirqueira </p>
    </footer>

</body>
</html>