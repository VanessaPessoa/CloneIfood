<?php

namespace Api\Services;
use Api\Database\Database;

class PedidoService{
   private $db;

   public function __construct(){
        $this->db = Database::getInstance();
   }

   public function createPedido($data){
        $idPedido =  $this->db->createPedido($data);  

        foreach ($data['pratos'] as $prato){
            $this->db->createPedidoPrato($idPedido, $prato['id'], $prato['quantidade']);
        }      
   }
}

?>