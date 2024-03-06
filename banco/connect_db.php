<?php

class Database{
    protected $connection = null;
    public $path = __DIR__ . '/database.sqlite3';

    public function __construct() {
        $this->connectDatabase();
    }

    function connectDatabase(): PDO{
        try{
            $this->connection = new PDO("sqlite:$this->path");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'conectado';
            return $this->connection;
        } catch( PDOException $error){
            echo 'Falha ao conectar ao banco'. $error->getMessage();
        }
    }

    
}