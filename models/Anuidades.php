<?php

require_once '../banco/connect_db.php';

class Anuidade extends Database{
    private $ano, $valor;
    private $tabela = "anuidades";
    
    
    public function __construct($ano, $valor)
    {
        parent::__construct();
        $this->ano = $ano;
        $this->valor = $valor;
        
    }
    
    public function cadastrar(){
        $sql_cadastro = "INSERT INTO {$this->tabela} (ano, valor) VALUES (?,?)";
        $stmt = $this->connection->prepare($sql_cadastro);
        $stmt->bindValue(1, $this->ano);
        $stmt->bindValue(2, $this->valor);
        $stmt->execute();


    }
    public function listar(){
        $sqlListar = $this->connection->query("SELECT * FROM {$this->tabela }");
        $result = $sqlListar->fetchAll();
    }

}
?>
