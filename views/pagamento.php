<?php
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <div class="container">
        <h1>Débitos</h1>
        <h2>Associado: <?= $result[0]['nome_associado'] ?> </h2>

        <table>
            <thead>
                <th>Ano</th>
                <th>valor nominal</th>
                <th>valor juros</th>
                <th>Subtotal</th>
            </thead>
            <tbody>
                <?php foreach ($result as $value) {
                    $total += $value['subtotal'];

                ?>
                    <tr>
                        <td><?= $value['ano_anuidade'] ?></td>
                        <td> R$<?= $value['valor_anuidade'] ?></td>
                        <td> R$<?= $value['juros_pago'] ?></td>
                        <td>R$<?= $value['subtotal'] ?></td>
                        <td>
                            <form method="POST" action="../controllers/pagamentoController.php">
                                <input type="hidden" name="a" value="pagar">
                                <input type="hidden" name="valor_pago" value="<?=$value['subtotal']?>">
                                <input type="hidden" name="juros_pago" value="<?=$value['juros_pago']?>">   
                                <input type="hidden" name="pagamento_id" value="<?= $value['id'] ?>">
                                <button type="submit">Pagar</button>
                            </form>
                        </td>
                    </tr>

                <?php } ?>

                <tr>
                    <td colspan="3" style="border-top: 1px solid #000; text-align: right;">Total</td>
                    <td style="border-top: 1px solid #000;"><?= $total ?></td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="container"><a href="javascript: history.go(-1)">Voltar</a></div>
</body>

</html>