<?php
    require_once '../models/Anuidades.php';

    class anuidadeController{
        private $model;

        function __construct()
        {
            $this->model = new Anuidade(
                $_REQUEST['ano'],
                $_REQUEST['valor']
            );
        }

        function cadastrar_anuidades(){
            $this->model->cadastrar();
            header('location: ../views/cadastro_anuidade.php');
        }

        function atualizar(){
            $id = $_REQUEST['id'];
            $this->model->atualizar($id);
            header('location: ../views/cadastro_anuidade.php');

        }

        function listar_anuidades(){

            $this->model->listar($_REQUEST['id']);
        }
    }
    $arrayActions = array("cadastrar_anuidades" );
    $controller = new anuidadeController();
    $action = !empty($_REQUEST['a']) ? $_REQUEST['a'] : 'listar_anuidades';
    //echo "action = " . $action . $_POST['a'];

    $controller->{$action}();
?>