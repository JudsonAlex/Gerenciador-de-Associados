CREATE TABLE IF NOT EXISTS associados (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    data_filiacao DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS anuidades (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    ano INTEGER NOT NULL,
    valor DECIMAL(10, 2) NOT NULL
);

CREATE TABLE IF NOT EXISTS pagamentos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    associado_id INTEGER,
    anuidade_id INTEGER,
    valor_pago DECIMAL(10, 2),
    juros_pago DECIMAL(10, 2) ,
    data_pagamento DATE ,
    FOREIGN KEY (associado_id) REFERENCES associados(id),
    FOREIGN KEY (anuidade_id) REFERENCES anuidades(id)
);
-- Criação do trigger 1 ( insere anuidades dos anos posteriores ao seu cadastro)
CREATE TRIGGER IF NOT EXISTS inserir_pagamento_associado AFTER INSERT ON associados
BEGIN
    -- Insere uma nova linha na tabela pagamentos com os valores padrão
    INSERT INTO pagamentos (associado_id, anuidade_id, valor_pago, juros_pago, data_pagamento)
    SELECT NEW.id, anuidades.id, NULL, NULL, NULL
    FROM anuidades
    WHERE anuidades.ano >= strftime('%Y', NEW.data_filiacao);
END;

-- Criação do trigger 2 (insere anuidade cadastrada para associados que anteriormente)
CREATE TRIGGER IF NOT EXISTS inserir_pagamento_anuidade AFTER INSERT ON anuidades
BEGIN
    -- Insere linhas na tabela de pagamentos para associados com ano de filiação menor ou igual ao ano da nova anuidade
    INSERT INTO pagamentos (associado_id, anuidade_id, valor_pago, juros_pago, data_pagamento)
    SELECT associados.id, NEW.id, NULL, NULL, NULL
    FROM associados
    WHERE strftime('%Y', associados.data_filiacao) <= (SELECT ano FROM anuidades WHERE id = NEW.id);
END;

-- BUSCAR DEVEDORES
SELECT a.nome, a.data_filiacao, GROUP_CONCAT(an.ano) AS anos_nao_pagos
FROM associados AS a
INNER JOIN anuidades AS an ON an.ano >= strftime('%Y', a.data_filiacao) AND an.ano <= strftime('%Y', date('now'))
LEFT JOIN pagamentos AS p ON a.id = p.associado_id AND an.id = p.anuidade_id
WHERE p.valor_pago IS NULL 
GROUP BY a.nome, a.data_filiacao
ORDER BY a.nome ASC;




