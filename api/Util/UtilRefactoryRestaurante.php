<?php

namespace Api\Util;

use Api\Abstrat\IRefactory;

class UtilRefactoryRestaurante implements IRefactory{

    public function __construct(){

    }

    public function handleRefactory($data){
        
        if(!isset($data['imagem'])){
           $data['imagem'] = 'null';
        }

        if(!isset($data['numero'])){
           $data['numero'] = 'null';
        }

        if(!isset($data['complemento'])){
            $data['complemento'] = 'null';
        }

        if(!isset($data['ponto_referencia'])){
            $data['ponto_referencia'] = 'null';
        }

        return $data;
    }
}

?>