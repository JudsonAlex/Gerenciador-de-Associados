<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Cadastro de anuidades</title>
    <link rel="stylesheet" href="../index.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de anuidades</h1>
        <form action="../controllers/anuidadeController.php" method="post">
            <input type="hidden" name="a" value="cadastrar_anuidades">
            <input type="text" placeholder="Digite o ano" name="ano">
            <input type="text" placeholder="valor da anuidade" name="valor">
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>