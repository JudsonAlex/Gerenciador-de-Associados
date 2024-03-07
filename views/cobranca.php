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
        <table <?=isset($result) ? "" : "hidden"?>>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data de filiação</th>
                    <th>Anos inadimplentes</th>
                </tr>
            </thead>
        <?php foreach($result as $data):?>
            <tr>
                <td><?=$data['nome'] ?></td>
                <td><?=$data['data_filiacao'] ?></td>
                <td><?=$data['anos_nao_pagos'] ?></td>
            </tr>
        <?php endforeach;?>
        </table>
    </div>
    
</body>
</html>