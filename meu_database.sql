CREATE TABLE IF NOT EXISTS associados (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    data_filiacao DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS anuidades (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    ano INT NOT NULL,
    valor DECIMAL(10, 2) NOT NULL
);

CREATE TABLE IF NOT EXISTS pagamentos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    associado_id INT,
    anuidade_id INT,
    valor_pago DECIMAL(10, 2) NOT NULL,
    juros_pago DECIMAL(10, 2) NOT NULL,
    data_pagamento DATE NOT NULL,
    FOREIGN KEY (associado_id) REFERENCES associados(id),
    FOREIGN KEY (anuidade_id) REFERENCES anuidades(id)
);
