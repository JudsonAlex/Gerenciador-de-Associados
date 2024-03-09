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
    <div class="container">
        <table class="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ano</th>
                    <th>VALOR</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once("../controllers/anuidadeController.php");
                    foreach ($result as $key => $value){?>
                        <tr>
                            <td><?=$value["id"]?></td>
                            <td><?=$value["ano"]?></td>
                            <td><?=$value["valor"]?></td>
                            <td><a href="../views/atualizarAnuidade.php?id=<?=$value['id']?>&ano=<?=$value['ano']?>&valor=<?=$value['valor']?>">EDITAR</a></td>

                        </tr>
                        
                    <?php }
        
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>