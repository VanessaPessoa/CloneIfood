<?php
namespace Api\Controllers;

use App\Http\Controllers\Controller;
use Api\Database\Database;
use Api\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller{

    private $service; 

    public function __construct(){
       $this->service = new ClienteService();
    }


    public function create(Request $request){
        $validatedData = $request->validate([
            'email' => 'required',
            'senha' => 'required',
            'telefone' => 'required',
            'nome' => 'required'
        ]);
         
        $body = $request->all();
        $id = $this->service->create($body);
        return response()->json(['success'=>true, 'id'=>$id]);
    }

    public function endereco(Request $request){

        $validatedData = $request->validate([
            'rua' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'fk_cliente_id' => 'required'
        ]);

        $body = $request->all();

        $id = $this->service->endereco($body);
        return response()->json(['success'=>true, 'id'=>$id]);

    }

    public function login(Request $request){      
        $validatedData = $request->validate([
            'email' => 'required',
            'senha' => 'required',
        ]);

        $body = $request->all();
        $id = $this->service->autenticacao($body);
        return response()->json(['success'=>true, 'id'=>$id]);
    }

    public function getAll(){
        $data =  $this->service->getAll();
        
        return response()->json(['success'=>true, 'data'=>$data]);
    }

    public function getCliente($id){
        $data = $this->service->getCliente($id);

        return response()->json(['success'=>true, 'data'=>$data]);
    }
}

?>