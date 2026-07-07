<?php
define('DATA_PATH', __DIR__ . '/../data/');

function ler_json($arquivo) {
    $caminho_completo = DATA_PATH . $arquivo;
    if (!file_exists($caminho_completo)) {
        return [];
    }
    $conteudo = file_get_contents($caminho_completo);
    return json_decode($conteudo, true) ?: [];
}

function gravar_json($arquivo, $dados) {
    $caminho_completo = DATA_PATH . $arquivo;
    $conteudo = json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($caminho_completo, $conteudo);
}

function apagar_dados_torneio() {
    $participantes_file = DATA_PATH . 'participantes.json';
    $rodadas_file = DATA_PATH . 'rodadas.json';

    if (file_exists($participantes_file)) {
        unlink($participantes_file);
    }
    if (file_exists($rodadas_file)) {
        unlink($rodadas_file);
    }
}