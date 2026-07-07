<?php
function calcularClassificacao($participantes, $rodadas) {
    $ranking = [];
    
    foreach ($participantes as $id => $p) {
        $ranking[$id] = [
            'nome' => $p['nome'],
            'jogos' => 0,
            'vitorias' => 0,
            'derrotas' => 0,
            'games_vencidos' => 0,
            'games_perdidos' => 0,
            'pontos' => 0
        ];
    }

    foreach ($rodadas as $r) {
        foreach ($r['jogos'] as $jogo) {
            if ($jogo['placarA'] === '' || $jogo['placarB'] === '') {
                continue;
            }

            $pA = (int)$jogo['placarA'];
            $pB = (int)$jogo['placarB'];
            
            foreach ($jogo['duplaA'] as $jId) {
                if (isset($ranking[$jId])) {
                    $ranking[$jId]['jogos']++;
                    $ranking[$jId]['games_vencidos'] += $pA;
                    $ranking[$jId]['games_perdidos'] += $pB;
                    $ranking[$jId]['pontos'] += $pA;
                    if ($pA > $pB) {
                        $ranking[$jId]['vitorias']++;
                        $ranking[$jId]['pontos'] += 2;
                    } else {
                        $ranking[$jId]['derrotas']++;
                    }
                }
            }

            foreach ($jogo['duplaB'] as $jId) {
                if (isset($ranking[$jId])) {
                    $ranking[$jId]['jogos']++;
                    $ranking[$jId]['games_vencidos'] += $pB;
                    $ranking[$jId]['games_perdidos'] += $pA;
                    $ranking[$jId]['pontos'] += $pB;
                    if ($pB > $pA) {
                        $ranking[$jId]['vitorias']++;
                        $ranking[$jId]['pontos'] += 2;
                    } else {
                        $ranking[$jId]['derrotas']++;
                    }
                }
            }
        }
    }

    uasort($ranking, function($a, $b) {
        if ($a['pontos'] != $b['pontos']) {
            return $b['pontos'] - $a['pontos'];
        }
        if ($a['vitorias'] != $b['vitorias']) {
            return $b['vitorias'] - $a['vitorias'];
        }
        $saldoA = $a['games_vencidos'] - $a['games_perdidos'];
        $saldoB = $b['games_vencidos'] - $b['games_perdidos'];
        return $saldoB - $saldoA;
    });

    return $ranking;
}