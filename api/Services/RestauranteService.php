<?php

namespace Api\Services;
use Api\Util\UtilRefactoryRestaurante;
use Api\Database\Database;

class RestauranteService{

   private $util; 
   private $db;

   public function __construct(){
      $this->util = new UtilRefactoryRestaurante();
      $this->db = Database::getInstance();
   }

   public function create($data){

     $body = $this->util->handleRefactory($data);
   //   dd($body);
     $db = $this->db->createRestaurante($body); 
   }
}

?>