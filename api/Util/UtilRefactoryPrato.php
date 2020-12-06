<?php

namespace Api\Util;

use Api\Abstrat\IRefactory;

class UtilRefactoryPrato implements IRefactory{

    public function __construct(){

    }

    public function handleRefactory($data){

        if(!isset($data['imagem'])){
           $data['imagem'] = null;
        }

        if(!isset($data['descricao'])){
            $data['descricao'] = null;
        }
        
        return $data;
    }
}

?>