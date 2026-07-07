<?php
require_once '../utils/json_helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rNum = isset($_POST['rodada_num']) ? (int)$_POST['rodada_num'] : 0;
    $rodadas = ler_json('rodadas.json');

    $q1A = isset($_POST['quadra1_A']) ? $_POST['quadra1_A'] : '';
    $q1B = isset($_POST['quadra1_B']) ? $_POST['quadra1_B'] : '';
    $q2A = isset($_POST['quadra2_A']) ? $_POST['quadra2_A'] : '';
    $q2B = isset($_POST['quadra2_B']) ? $_POST['quadra2_B'] : '';

    if ($q1A === '' || $q1B === '' || $q2A === '' || $q2B === '') {
        header("Location: rodadas.php?r=$rNum");
        exit;
    }

    $q1A = (int)$q1A;
    $q1B = (int)$q1B;
    $q2A = (int)$q2A;
    $q2B = (int)$q2B;

    if ($q1A < 0 || $q1A > 15 || $q1B < 0 || $q1B > 15 || $q2A < 0 || $q2A > 15 || $q2B < 0 || $q2B > 15) {
        header("Location: rodadas.php?r=$rNum");
        exit;
    }

    if ($q1A === $q1B || $q2A === $q2B) {
        header("Location: rodadas.php?r=$rNum");
        exit;
    }

    if (isset($rodadas[$rNum])) {
        $rodadas[$rNum]['jogos']['quadra1']['placarA'] = $q1A;
        $rodadas[$rNum]['jogos']['quadra1']['placarB'] = $q1B;
        $rodadas[$rNum]['jogos']['quadra2']['placarA'] = $q2A;
        $rodadas[$rNum]['jogos']['quadra2']['placarB'] = $q2B;
        $rodadas[$rNum]['concluida'] = true;

        gravar_json('rodadas.json', $rodadas);
    }

    header("Location: rodadas.php?r=$rNum&sucesso=1");
    exit;
}