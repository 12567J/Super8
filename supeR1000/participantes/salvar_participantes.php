<?php
require_once '../utils/json_helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $participantes = [];
    $valido = true;

    for ($i = 1; $i <= 8; $i++) {
        $nome = isset($_POST["jogador_$i"]) ? trim($_POST["jogador_$i"]) : '';
        if ($nome === '') {
            $valido = false;
            break;
        }
        $participantes["J$i"] = ['nome' => $nome];
    }

    if ($valido) {
        gravar_json('participantes.json', $participantes);
        header('Location: cadastro.php?sucesso=1');
        exit;
    } else {
        header('Location: cadastro.php');
        exit;
    }
}