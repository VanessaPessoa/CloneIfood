<?php

namespace Api\Services;
use Api\Util\UtilRefactoryRestaurante;
use Api\Util\UtilRefactoryPrato;
use Api\Database\Database;

class RestauranteService{

   private $util; 
   private $db;
   private $util_prato; 

   public function __construct(){
      $this->util = new UtilRefactoryRestaurante();
      $this->db = Database::getInstance();
      $this->util_prato = new UtilRefactoryPrato();

   }

   public function create($data){

     $body = $this->util->handleRefactory($data);
     $db = $this->db->createRestaurante($body); 
   }

   public function createPrato($data){
    //  $body = $this->
    $body = $this->util_prato->handleRefactory($data);
    $db = $this->db->createPrato($body);
  }
}

?>