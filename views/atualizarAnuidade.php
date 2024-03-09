<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
        <h1>Cadastro de anuidades</h1>
        <?php require_once('../controllers/anuidadeController.php');?>

        <form action="../controllers/anuidadeController.php" method="post">
            <input type="hidden" name="a" value="atualizar">
            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
            <input type="text" placeholder="Digite o ano" name="ano" value="<?=$_REQUEST['ano']?>">
            <input type="text" placeholder="valor da anuidade" name="valor" value="<?=$_REQUEST['valor']?>">
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>