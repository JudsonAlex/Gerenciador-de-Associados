<?php

use function PHPSTORM_META\type;

    require_once '../models/Associados.php';

    class associadoController{
        private $model;
        
        function __construct()
        {
            
            $this->model = new Associado(
                $_POST['nome'],
                $_POST['email'],
                $_POST['cpf'],
                $_POST['data_filiacao'],
            );
        }
        
        function cadastrar_associados(){
            $this->model->cadastrar();       
            
        }

        function listar_associados(){
            $status = $_GET['status'];
            $result = $this->model->listar($status);
        
            require_once('../views/cobranca.php');
            return $result;
        }
    }
    $arrayActions = array("cadastrar_associados" );
    $controller = new associadoController();
    $action = !empty($_POST['a']) ? $_POST['a'] : 'listar_associados';
    //echo "action = " . $action . $_POST['a'];

    $controller->{$action}();






?>
