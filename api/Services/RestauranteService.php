<?php

namespace Api\Services;
use Api\Util\UtilRefactoryRestaurante;
use Api\Util\UtilRefactoryPrato;
use Api\Util\UtilIdGenerated;
use Api\Database\Database;

class RestauranteService{

    private $util; 
    private $db;
    private $util_prato; 

    public function __construct(){
        $this->util = new UtilRefactoryRestaurante();
        $this->db = Database::getInstance();
        $this->util_prato = new UtilRefactoryPrato();
        $this->idGenerate = new UtilIdGenerated();

    }

    public function create($data, $imagem){
        $id = $this->idGenerate->generatedId();
        $body = $this->util->handleRefactory($data);
        $db = $this->db->createRestaurante($body, $id, $imagem); 
        
        return $id;
    }

    public function createPrato($data, $imagem){
        $id = $this->idGenerate->generatedId();
        $body = $this->util_prato->handleRefactory($data);
        $db = $this->db->createPrato($body, $id, $imagem);

        return $id;
    }
 
    public function autenticacao($data){
        $db = $this->db->autenticacaoRestaurante($data['email'], $data['senha']);
        return $db;
    }

    public function getAll(){
        $db = $this->db->getRestauranteAll();

        return $db;
    }

    public function getRestaurante($id){
        $db = $this->db->getRestaurante($id);

        return $db;
    }

    public function getPratoAll($id){
        $db = $this->db->getPratoAll($id);
        return $db;
    }

    public function getPrato($id){
        $db = $this->db->getPrato($id);
        return $db;
    }

    public function deletePrato($id){
        $db = $this->db->deletePrato($id);
        
        return $db;
    }
}

?>