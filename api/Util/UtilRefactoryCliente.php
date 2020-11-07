<?php

namespace Api\Util;

use Api\Abstrat\IRefactory;

class UtilRefactoryCliente implements IRefactory{

    public function __construct(){

    }

    public function handleRefactory($data){

        if(!isset($data['numero'])){
           $data['numero'] = -1;
        }

        if(!isset($data['complemento'])){
            $data['complemento'] = 'null';
        }

        if(!isset($data['ponto_referencia'])){
            $data['ponto_referencia'] = 'null';
        }

        if(!isset($data['nome_identificador'])){
            $data['nome_identificador'] = 'null';
        }
        return $data;
    }
}

?>