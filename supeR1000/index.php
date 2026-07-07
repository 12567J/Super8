<?php
require_once 'utils/json_helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['zerar'])) {
    apagar_dados_torneio();
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal - Super 8</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>SISTEMA SUPER 8 - BEACH TENNIS</header>
    <div class="container">
        <a href="participantes/cadastro.php" class="btn">Cadastrar Participantes</a>
        <a href="configuracao/configuracao.php" class="btn">Configurar Formato</a>
        <a href="rodadas/rodadas.php" class="btn">Gerenciar Rodadas</a>
        <a href="classificacao/classificacao.php" class="btn">Visualizar Classificação</a>
        
        <form action="index.php" method="POST" onsubmit="return confirm('Deseja realmente apagar todos os dados e zerar o torneio?');">
            <input type="hidden" name="zerar" value="1">
            <button type="submit" class="btn btn-perigo">Zerar Torneio</button>
        </form>
    </div>
    <footer>
        <p>Programação para Internet I </p>
        <br>
        <p> Desenvolvido por Luiza Batista Sirqueira </p>
    </footer></body>
</html>