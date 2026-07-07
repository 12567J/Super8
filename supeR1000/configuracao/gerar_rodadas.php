<?php
require_once '../utils/json_helper.php';
require_once '../utils/sorteio.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formato = isset($_POST['formato']) ? $_POST['formato'] : '';
    $participantes = ler_json('participantes.json');

    if (empty($formato) || count($participantes) === 0) {
        header('Location: configuracao.php');
        exit;
    }

    if ($formato === 'rotativas') {
        $rodadas = gerarRodadasRotativas($participantes);
    } else {
        $rodadas = gerarRodadasFixas($participantes);
    }

    $config = ['formato' => $formato];
    gravar_json('config.json', $config);
    gravar_json('rodadas.json', $rodadas);

    header('Location: ../index.php');
    exit;
}