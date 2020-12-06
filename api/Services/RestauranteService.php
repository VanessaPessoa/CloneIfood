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

    public function updatePrato($id, $data, $imagem){
        
        if($imagem){
            $this->db->updateImagemPrato($id, $imagem);
        }
        
        if(isset($data['descricao'])){
            $this->db->updateDescricaoPrato($id, $data['descricao']);
        }

        if(isset($data['valor'])){
            $this->db->updateValorPrato($id, $data['valor']);
        }
        
    }

    public function updateRestaurante($id, $data, $imagem){
        
        if($imagem){
            $this->db->updateImagemRestaurante($id, $imagem);
        }
        
        if(isset($data['hora_fechamento'])){
            $this->db->updateHoraFechamentoRestaurante($id, $data['hora_fechamento']);
        }

        if(isset($data['hora_abertura'])){
            $this->db->updateHoraAberturaRestaurante($id, $data['hora_abertura']);
        }

        if(isset($data['telefone'])){
            $this->db->updateTelefoneRestaurante($id, $data['telefone']);
        }

        if(isset($data['rua'])){
            $this->db->updateRuaRestaurante($id, $data['rua']);
        }

        if(isset($data['numero'])){
            $this->db->updateNumeroRestaurante($id, $data['numero']);
        }

        if(isset($data['complemento'])){
            $this->db->updateComplementoRestaurante($id, $data['complemento']);
        }

        if(isset($data['ponto_referencia'])){
            $this->db->updatePontoReferenciaRestaurante($id, $data['ponto_referencia']);
        }

        if(isset($data['estado'])){
            $this->db->updateEstadoRestaurante($id, $data['estado']);
        }

        if(isset($data['cidade'])){
            $this->db->updateCidadeRestaurante($id, $data['cidade']);
        }

        if(isset($data['especialidade'])){
            $this->db->updateEspecialidadeRestaurante($id, $data['especialidade']);
        }

        if(isset($data['descricao'])){
            $this->db->updateDescricaoRestaurante($id, $data['descricao']);
        }
        
    }

    public function getPratoPromocao(){
        $db = $this->db->pratoPromocao();

        return $db;
    }
}

?>