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
    valor_pago DECIMAL(10, 2) NOT NULL,
    juros_pago DECIMAL(10, 2) NOT NULL,
    data_pagamento DATE NOT NULL,
    FOREIGN KEY (associado_id) REFERENCES associados(id),
    FOREIGN KEY (anuidade_id) REFERENCES anuidades(id)
);';

try{
    $db = new PDO("sqlite:". __DIR__. "/database.sqlite3");
    $db->exec($query_associados);
    $db->exec($query_anuidades);
    $db->exec($query_pagamentos);
    echo 'deu certo';
} catch(PDOException $erro) {
    echo $erro->getMessage();
}






