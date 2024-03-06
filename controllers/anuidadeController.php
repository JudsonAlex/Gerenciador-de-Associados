<?php
    require_once '../models/Anuidades.php';

    class anuidadeController{
        private $model;

        function __construct()
        {
            $this->model = new Anuidade(
                $_POST['ano'],
                $_POST['valor']
            );
        }

        function cadastrar_anuidades(){
            $this->model->cadastrar();
        }

        function listar_anuidades(){
            $this->model->listar();
        }
    }
    $arrayActions = array("cadastrar_anuidades" );
    $controller = new anuidadeController();
    $action = !empty($_POST['a']) ? $_POST['a'] : 'listar';
    echo "action = " . $action . $_POST['a'];

    $controller->{$action}();
?>