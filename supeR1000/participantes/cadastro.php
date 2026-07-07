<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Super 8</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/ui.js" defer></script>
</head>
<body>
    <header>SISTEMA SUPER 8 - BEACH TENNIS</header>
    <div class="container-cadastro">
        <?php if (isset($_GET['sucesso'])): ?>
            <div class="sucesso-msg">Salvo com sucesso</div>
        <?php endif; ?>
        
        <form action="salvar_participantes.php" method="POST">
            <div class="card-grid">
                <?php for ($i = 1; $i <= 8; $i++): ?>
                    <div class="card">
                        <label>Jogador <?php echo $i; ?></label>
                        <input type="text" name="jogador_<?php echo $i; ?>" placeholder="Nome Completo">
                    </div>
                <?php endfor; ?>
            </div>
            <button type="submit" class="btn">Salvar</button>
            <a href="../index.php" class="btn btn-voltar">Voltar à Tela Inicial</a>
        </form>
    </div>
    <footer>
        <p>Programação para Internet I </p>
        <br>
        <p> Desenvolvido por Luiza Batista Sirqueira </p>
    </footer></body>
</html>