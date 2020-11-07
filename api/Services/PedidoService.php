<?php

namespace Api\Services;
use Api\Database\Database;

class PedidoService{
   private $db;

   public function __construct(){
        $this->db = Database::getInstance();
   }

   public function createPedido($data){
        $this->db->createPedido($data); 
        
   }

   public function pratosPedidos($data){
        foreach ($data['pratos'] as $prato){
          $this->db->createPedidoPrato($data['fk_pedido_id'], $prato['id'], $prato['quantidade']);
        }
   }
}

?>