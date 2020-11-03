<?php
namespace Api\Controllers;

use App\Http\Controllers\Controller;
use Api\Database\Database;
use Api\Services\RestauranteService;
use Illuminate\Http\Request;

class RestauranteController extends Controller{

    private $service; 

    public function __construct(){
       $this->service = new RestauranteService();
    }


    public function create(Request $request){

        $validatedData = $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'senha' => 'required',
            'hora_fechamento' => 'required',
            'hora_abertura' => 'required',
            'telefone' => 'required',
            'rua' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'pode_retirarSN' => 'required',
            'descricao' => 'required',
            'dias_funcionamento' => 'required'
        ]);

        $body = $request->all();

        $this->service->create($body);

    }
}

?>