<?php

namespace Api\Services;
use Api\Database\Database;
use Api\Util\UtilRefactoryCliente;
use Api\Util\UtilIdGenerated;

class ClienteService{
   private $db;
   private $util; 
   private $idGenerate;

    public function __construct(){
        $this->util = new UtilRefactoryCliente(); 
        $this->db = Database::getInstance();
        $this->idGenerate = new UtilIdGenerated();
    }

    public function create($data){
        $id = $this->idGenerate->generatedId();
        $db = $this->db->createCliente($data, $id); 
       
        return $id;
    }

    public function endereco($data){
        $id = $this->idGenerate->generatedId();
        $body = $this->util->handleRefactory($data);
        $db = $this->db->createEnderecoCliente($body, $id);
       
        return $id;
   }

    public function autenticacao($data){
       $db = $this->db->autenticacaoCliente($data['email'], $data['senha']);
       return $db;
    }

    public function getAll(){
        $db = $this->db->getClienteAll();

        return $db;
    }

    public function getCliente($id){
        $db = $this->db->getCliente($id);

        return $db;
    }

    public function getEnderecoAll($id){
        
        $db = $this->db->getEnderecoAll($id);
        
        return $db;
    }

    public function getEndereco($id){
        
        $db = $this->db->getEndereco($id);
        
        return $db;
    }

    public function deleteEndereco($id){
        $db = $this->db->deleteEndereco($id);
        
        return $db;
    }

    public function updateCliente($id, $data){
        $db = $this->db->updateCliente($id, $data['nomeCliente']);
        
        return $db;
    }
    
}

?>