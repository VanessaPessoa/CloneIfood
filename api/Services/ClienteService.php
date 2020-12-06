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
        
        if(isset($data['nomeCliente'])){
            $this->db->updateNomeCliente($id, $data['nomeCliente']);
        }
        
        if(isset($data['telefone'])){
            $this->db->updateTelefoneCliente($id, $data['telefone']);
        }
        
    }

    public function updateEndereco($id, $data){
        
        if(isset($data['rua'])){
            $this->db->updateRuaCliente($id, $data['rua']);
        }
        
        if(isset($data['numero'])){
            $this->db->updateNumeroCliente($id, $data['numero']);
        }

        if(isset($data['complemento'])){
            $this->db->updateComplementoCliente($id, $data['complemento']);
        }
        
        if(isset($data['ponto_referencia'])){
            $this->db->updatePontoReferenciaCliente($id, $data['ponto_referencia']);
        }

        if(isset($data['cidade'])){
            $this->db->updateCidadeCliente($id, $data['cidade']);
        }
        
        if(isset($data['estado'])){
            $this->db->updateEstadoCliente($id, $data['estado']);
        }

        if(isset($data['nome_identificador'])){
            $this->db->updateNomeIdentificadorEndereco($id, $data['nome_identificador']);
        }
        
    }
    
}

?>