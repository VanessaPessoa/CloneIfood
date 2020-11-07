<?php

namespace Api\Services;
use Api\Database\Database;
use Api\Util\UtilRefactoryCliente;

class ClienteService{
   private $db;
   private $util; 

   public function __construct(){
        $this->util = new UtilRefactoryCliente(); 
        $this->db = Database::getInstance();
   }

   public function create($data){
        $db = $this->db->createCliente($data); 

   }

   public function endereco($data){
        $body = $this->util->handleRefactory($data);
        $db = $this->db->createEnderecoCliente($body); 
  }
}

?>