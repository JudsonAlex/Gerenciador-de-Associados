<?php 
    require_once '../banco/connect_db.php';

    class Pagamento extends Database{
        private $associado_id, $anuidade_id, $valor_pago, $juros_pago, $data_pagamento;
        private $tabela = 'pagamentos';

        public function __construct($associado_id, $anuidade_id, $valor_pago, $juros_pago, $data_pagamento){
            parent::__construct();
            $this->associado_id = $associado_id;
            $this->anuidade_id = $anuidade_id;
            $this->valor_pago = $valor_pago;
            $this->juros_pago = $juros_pago;
            $this->data_pagamento = $data_pagamento;
            
        }

        function getID(){
            return $this->associado_id;
        }

        function listar_pagamentos($associado_id){
            $stmt = $this->connection->prepare("SELECT 
            p.id,
            a.nome AS nome_associado,
            an.ano AS ano_anuidade,
            an.valor AS valor_anuidade,
            CASE 
                WHEN date('now') > DATE(a.data_filiacao, '+90 days')  THEN
                    an.valor * 0.01 * ( 1+ round(((julianday(date('now')) - julianday(DATE(a.data_filiacao, '+90 days'))) / 30)))
                ELSE 
                    0
            END AS juros_pago,
            an.valor + CASE 
                WHEN date('now') > DATE(a.data_filiacao, '+90 days')  THEN
                    an.valor * 0.01 * ( 1+ round(((julianday(date('now')) - julianday(DATE(a.data_filiacao, '+90 days'))) / 30)))
                ELSE 
                    0
            END AS subtotal
            
            FROM 
                associados a
            INNER JOIN 
                pagamentos p ON a.id = p.associado_id
            INNER JOIN 
                anuidades an ON p.anuidade_id = an.id
            WHERE 
                a.id = ? and strftime('%Y', a.data_filiacao) <= strftime('%Y', date('now')) AND p.data_pagamento IS NULL
                ORDER BY an.ano ");
            $stmt->bindValue(1, $associado_id); 
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;

        }

        function pagar($id_pagamento){
            $sql_pagamento =  "UPDATE {$this->tabela} SET valor_pago = ?, juros_pago = ?, data_pagamento = date('now') WHERE id = ?";
            $stmt = $this->connection->prepare($sql_pagamento);
            $stmt->bindValue(1, $this->valor_pago);
            $stmt->bindValue(2, $this->juros_pago);
            $stmt->bindValue(3, $id_pagamento);
            $stmt->execute();
            

        }
    }
?>