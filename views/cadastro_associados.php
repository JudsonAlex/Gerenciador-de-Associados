<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Cadastro de Associados</title>
    <link rel="stylesheet" href="../index.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Associado</h1>
        <form action="../controllers/associadoController.php" method="post">
            <input type="hidden" name="a" value="cadastrar_associados">
            <input type="text" placeholder="Digite seu nome" name="nome">
            <input type="email" placeholder="Digite seu email" name="email">
            <input type="text" placeholder="Digite seu cpf" name="cpf">
            <input type="date" name="data_filiacao" id="data_filiacao">
            <button type="submit">Cadastrar</button>
        </form>
    </div>
    <div class="container">
        <table class="tabela">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Data de Filiação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once("../controllers/associadoController.php");
                    foreach ($result as $key => $value){?>
                        <tr>
                            <td><?=$value["nome"]?></td>
                            <td><?=$value["email"]?></td>
                            <td><?=$value["cpf"]?></td>
                            <td><?=$value["data_filiacao"]?></td>
                        </tr>
                        
                    <?php }
        
                ?>
                
            </tbody>
        </table>
    </div>
    <div class="container"><a href="javascript: history.go(-1)">Voltar</a></div>
</body>
</html>