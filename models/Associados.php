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

                $sqlListar = $this->connection->query("SELECT 
                a.id AS associado_id,
                a.nome AS nome,
                GROUP_CONCAT(an.ano, ', ') AS anos,
                GROUP_CONCAT('R$' || printf('%.2f', an.valor), ' - ') AS valores,
                printf('R$%.2f', SUM(an.valor)) AS total
                FROM 
                    associados a
                LEFT JOIN 
                    pagamentos p ON a.id = p.associado_id
                LEFT JOIN 
                    anuidades an ON p.anuidade_id = an.id
                WHERE p.data_pagamento IS NULL
                GROUP BY 
                    a.id, a.nome;
                ");
                $result = $sqlListar->fetchAll();
                return $result;
                break;
            case 'quitado':
                $sqlListar = $this->connection->query("SELECT associados.nome, GROUP_CONCAT(anuidades.ano) AS anos_pagos
                FROM associados
                JOIN pagamentos ON associados.id = pagamentos.associado_id
                JOIN anuidades ON pagamentos.anuidade_id = anuidades.id
                GROUP BY associados.nome
                HAVING SUM(pagamentos.valor_pago) >= SUM(anuidades.valor);");
                $result = $sqlListar->fetchAll();
                return $result;
                break;

            case 'listar_todos':
                $sqlListar = $this->connection->query("SELECT * FROM associados;");
                $result = $sqlListar->fetchAll();
                return $result;
                break;
        }
        
    }


}
?>
