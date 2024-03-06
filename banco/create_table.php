<?php
$query_associados = 'CREATE TABLE IF NOT EXISTS associados (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    data_filiacao DATE NOT NULL
);';

$query_anuidades = 'CREATE TABLE IF NOT EXISTS anuidades (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    ano INT NOT NULL,
    valor DECIMAL(10, 2) NOT NULL
);';

$query_pagamentos = 'CREATE TABLE IF NOT EXISTS pagamentos (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    associado_id INT,
    anuidade_id INT,
    valor_pago DECIMAL(10, 2),
    juros_pago DECIMAL(10, 2),
    data_pagamento DATE,
    FOREIGN KEY (associado_id) REFERENCES associados(id),
    FOREIGN KEY (anuidade_id) REFERENCES anuidades(id)
);';

$trigger = "CREATE TRIGGER inserir_pagamento_associado AFTER INSERT ON associados
BEGIN
    -- Inserir um novo registro na tabela pagamentos
    INSERT INTO pagamentos (associado_id, anuidade_id)
    -- Selecionar o último ID inserido na tabela associados
    SELECT new.id, a.id
    FROM associados AS new
    -- Realizar um CROSS JOIN com a tabela anuidades
    CROSS JOIN anuidades AS a
    -- Adicionar uma condição para verificar se a anuidade é maior ou igual à data de filiação do associado
    WHERE a.ano >= strftime('%Y',new.data_filiacao);
END;";

try{
    $db = new PDO("sqlite:". __DIR__. "/database.sqlite3");
    $db->exec($query_associados);
    $db->exec($query_anuidades);
    $db->exec($query_pagamentos);
    $db->exec($trigger);
    echo 'deu certo';
} catch(PDOException $erro) {
    echo $erro->getMessage();
}






