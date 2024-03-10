<?php 
    require_once '../models/Pagamentos.php';

    class pagamentoController{
        private $model;

        function __construct()
        {
            $this->model = new Pagamento(
                $_REQUEST['associado_id'],
                $_REQUEST['anuidade_id'],
                $_REQUEST['valor_pago'],
                $_REQUEST['juros_pago'],
                $_REQUEST['data_pagamento']
            );
        }

        function listar_pagamento(){
            $result = $this->model->listar_pagamentos($this->model->getID());
            // header('location: ../views/pagamento.php');
            require_once('../views/pagamento.php');
            
            

        }

        function pagar(){
            $id_pagamento = $_REQUEST['pagamento_id'];
            $this->model->pagar($id_pagamento);
            header("location: ../controllers/associadoController.php?status=atrasados");
        }
    }
    $controller = new pagamentoController();
    $action = !empty($_REQUEST['a']) ? $_REQUEST['a'] : 'listar_pagamento';
    //echo "action = " . $action . $_POST['a'];

    $controller->{$action}();
?>