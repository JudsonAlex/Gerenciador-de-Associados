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
    public function listar(){
        $sqlListar = $this->connection->query("SELECT * FROM {$this->tabela }");
        $result = $sqlListar->fetchAll();
    }

}
?>
