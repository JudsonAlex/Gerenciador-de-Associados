<?php



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
            header('location: ../views/cadastro_associados.php?status=listar_todos');
            
        }

        function listar_associados(){
            global $result;
            $status = $_GET['status'];
            $result = $this->model->listar($status);
            if ($status !== 'listar_todos' ){
                require_once('../views/cobranca.php');
            }
            return $result;
        }
    }
    $arrayActions = array("cadastrar_associados" );
    $controller = new associadoController();
    $action = !empty($_REQUEST['a']) ? $_REQUEST['a'] : 'listar_associados';
    //echo "action = " . $action . $_POST['a'];

    $controller->{$action}();






?>
