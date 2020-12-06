<?php

namespace Api\Services;
use Api\Database\Database;
use Api\Util\UtilIdGenerated;

class PedidoService{
   private $db;
   private $util;

   public function __construct(){
        $this->db = Database::getInstance();
        $this->util = new UtilIdGenerated();
   }

   public function createPedido($data){
        $idPedido = $this->util->generatedId();
        $this->db->createPedido($data, $idPedido);  
     


        foreach ($data['pratos'] as $prato){
            $id = $this->util->generatedId();

            $this->db->createPedidoPrato($idPedido, $prato['id'], $prato['quantidade'], $id);
        }      
   }

   public function getPedido($id){
     $db = $this->db->getPedido($id);
     return $db;
   }

   public function historicoRestaurante($id){
     $db = $this->db->historicoRestaurante($id);
     return $db;
   }

   public function historicoCliente($id){
     $db = $this->db->historicoCliente($id);
     return $db;
   }

}

?>
