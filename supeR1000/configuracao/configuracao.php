<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração - Super 8</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>SISTEMA SUPER 8 - BEACH TENNIS</header>
    <div class="container">
        <form action="gerar_rodadas.php" method="POST">
            <div class="card-grid" style="grid-template-columns: 1fr; max-width: 500px;">
                <div class="card">
                    <label>
                        <input type="radio" name="formato" value="rotativas"> Duplas Rotativas (7 Rodadas)
                    </label>
                </div>
                <div class="card">
                    <label>
                        <input type="radio" name="formato" value="fixas"> Duplas Fixas (3 Rodadas)
                    </label>
                </div>
            </div>
            <button type="submit" class="btn">Salvar</button>
            <a href="../index.php" class="btn btn-voltar">Voltar à Tela Inicial</a>
        </form>
    </div>
    <footer>
        <p>Programação para Internet I </p>
        <br>
        <p> Desenvolvido por Luiza Batista Sirqueira </p>
    </footer>
</body>
</html>
