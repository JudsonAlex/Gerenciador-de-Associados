<?php

require_once '../banco/connect_db.php';

class Associado extends Database{
    private $nome, $email, $cpf, $data;
    private $tabela = "associados";
    
    
    public function __construct($nome, $email, $cpf, $data)
    {
        parent::__construct();
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->data = $data;
        
        
    }
    
    public function cadastrar(){
        $sql_cadastro = "INSERT INTO {$this->tabela} (nome, email, cpf, data_filiacao) VALUES (?,?,?,?)";
        $stmt = $this->connection->prepare($sql_cadastro);
        $stmt->bindValue(1, $this->nome);
        $stmt->bindValue(2, $this->email);
        $stmt->bindValue(3, $this->cpf);
        $stmt->bindValue(4, $this->data);
        $stmt->execute();


    }
    public function listar($status){
        switch ($status) {
            case 'atrasados':
                $sqlListar = $this->connection->query("SELECT a.nome, a.data_filiacao, GROUP_CONCAT(an.ano) AS anos_nao_pagos
                FROM associados AS a
                INNER JOIN anuidades AS an ON an.ano >= strftime('%Y', a.data_filiacao) AND an.ano <= strftime('%Y', date('now'))
                LEFT JOIN pagamentos AS p ON a.id = p.associado_id AND an.id = p.anuidade_id
                WHERE p.valor_pago IS NULL 
                GROUP BY a.nome, a.data_filiacao
                ORDER BY a.nome ASC;");
                $result = $sqlListar->fetchAll();
                return $result;
                break;
            case 'quitado':
                $sqlListar = $this->connection->query("SELECT associados.nome, GROUP_CONCAT(anuidades.ano) AS anos_pagos
                FROM associados
                JOIN pagamentos ON associados.id = pagamentos.associado_id
                JOIN anuidades ON pagamentos.anuidade_id = anuidades.id
                GROUP BY associados.nome
                HAVING SUM(pagamentos.valor_pago) = SUM(anuidades.valor);");
                $result = $sqlListar->fetchAll();
                return $result;
                break;
        }
        // $sqlListar = $this->connection->query("SELECT * FROM {$this->tabela }");
        // $result = $sqlListar->fetchAll();
    }

    function listarTudo(){
        $this->connection->query("SELECT * FROM associados");
    }

}
?>
