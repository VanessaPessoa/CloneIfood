<?php
namespace Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestauranteController extends Controller{

    public function create(Request $request){
        $name = $request->name;
        $email = $request->email;
        $senha = $request->senha;
        $hora_fechamento = $request->hora_fechamento;
        $hora_abertura = $request->hora_abertura;
        $telefone = $request->telefone;
        $rua = $request->rua;
        $estado = $request->estado;
        $cidade = $request->cidade;
        $pode_retirarSN = $request->pode_retirarSN;        
        $descricao = $request->descricao;


        if($request->has('numero')){
            $numero = $request->numero;
        }

        if($request->has('complemento')){
            $complemento = $request->complemento;
        }
        
        if($request->has('ponto_referencia')){
            $ponto_referencia = $request->ponto_referencia;
        }

        if($request->has('imagem')){
            $imagem = $request->imagem;
        }


        $body = $request->all();

        return response()->json([
            "body"=>$body
        ]);
    }
}

?>