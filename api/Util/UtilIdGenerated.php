<?php

namespace Api\Util;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;


class UtilIdGenerated{

    public function __construct(){}

    public function generatedId(){
        $id = Uuid::uuid4();
        $json = json_encode($id);
        $json_decode = json_decode($json);
        
        return $json_decode;
    }

}

?>