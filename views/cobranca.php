<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <title>Checkout</title>
</head>
<body>
    <div class="container">
        <form action="../controllers/associadoController.php" method="get">
            <input type="radio" name="status" id="atraso" value="atrasados">
            <label for="atraso">Atrasados</label>
            <input type="radio" name="status" id="em_dia" value="quitado">
            <label for="em_dia">Em dia</label>
            <button type="submit">Consultar</button>
        </form>




    </div>

    <div  class="container" <?=isset($_GET['status'])? "" : "hidden" ?>>
        <?php switch ($_GET["status"]) {
            case 'atrasados':?>
                <table border="1" class="tabela" <?=isset($result) ? "" : "hidden"?>>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Anuidades</th>
                            <th>Valores</th>
                            <th>Total</th>
                        </tr>
                    </thead> 
                    <?php foreach($result as $data):?>
                        <tr>
                            <td><a href="../controllers/pagamentoController.php?associado_id=<?=$data['associado_id']?>"> <?=$data['nome'] ?></a></td>
                            <td><?=$data['anos'] ?></td>
                            <td><?=$data['valores'] ?></td>
                            <td><?=$data['total'] ?></td>
                        </tr>
                    <?php endforeach;?>
                </table>
                <?php break;
            case 'quitado':?>
                <table class="tabela" <?=isset($result) ? "" : "hidden"?>>
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Anos Pagos</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($result as $data):?>
                        <tr>
                            <td><?=$data['nome'] ?></td>
                            <td><?=$data['anos_pagos'] ?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>

            <?php default:
                # code...
                break;
        } ?>

    </div>
    <div class="container"><a href="javascript: history.go(-1)">Voltar</a></div>
    
</body>
</html>