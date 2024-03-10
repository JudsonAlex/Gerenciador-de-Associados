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
    FOREIGN KEY (associado_id) REFERENCES associados(id) ON DELETE CASCADE,
    FOREIGN KEY (anuidade_id) REFERENCES anuidades(id) ON DELETE CASCADE
);';

$trigger_add_associados= "CREATE TRIGGER IF NOT EXISTS inserir_pagamento_associado AFTER INSERT ON associados
BEGIN
    INSERT INTO pagamentos (associado_id, anuidade_id, valor_pago, juros_pago, data_pagamento)
    SELECT NEW.id, anuidades.id, NULL, NULL, NULL
    FROM anuidades
    WHERE anuidades.ano >= strftime('%Y', NEW.data_filiacao);
END;";

$trigger_add_anuidades = "CREATE TRIGGER IF NOT EXISTS inserir_pagamento_anuidade AFTER INSERT ON anuidades
BEGIN
    INSERT INTO pagamentos (associado_id, anuidade_id, valor_pago, juros_pago, data_pagamento)
    SELECT associados.id, NEW.id, NULL, NULL, NULL
    FROM associados
    WHERE strftime('%Y', associados.data_filiacao) <= (SELECT ano FROM anuidades WHERE id = NEW.id);
END;";

try{
    $db = new PDO("sqlite:". __DIR__. "/database.sqlite3");
    $db->exec($query_associados);
    $db->exec($query_anuidades);
    $db->exec($query_pagamentos);
    $db->exec($trigger_add_associados);
    $db->exec($trigger_add_anuidades);
    echo 'Banco criado com sucesso!'. PHP_EOL;
} catch(PDOException $erro) {
    echo $erro->getMessage();
}






