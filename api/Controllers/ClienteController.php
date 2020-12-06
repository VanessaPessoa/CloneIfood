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
            'nomeCliente' => 'required'
        ]);
         
        $body = $request->all();
        $id = $this->service->create($body);
        if($id){
            return response()->json(['success'=>true, 'id'=>$id], 200);
        }else{
            return response()->json(['success'=>false], 401);            
        }
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

        if($id){
            return response()->json(['success'=>true, 'id'=>$id], 200);
        }else{
            return response()->json(['success'=>false], 401);            
        }

    }

    public function login(Request $request){      
        $validatedData = $request->validate([
            'email' => 'required',
            'senha' => 'required',
        ]);

        $body = $request->all();
        $id = $this->service->autenticacao($body);

        if($id){
            return response()->json(['success'=>true, 'data'=>$id, 'role' => 'cliente'], 200);            
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }

    public function getAll(){
        $data =  $this->service->getAll();

        if($data){
            return response()->json(['success'=>true, 'data'=>$data], 200);
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }

    public function getCliente($id){
        $data = $this->service->getCliente($id);
        
        if($data){
            return response()->json(['success'=>true, 'data'=>$data], 200);
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }

    public function getEndereco($id){
        $data = $this->service->getEndereco($id);
        
        if($data){
            return response()->json(['success'=>true, 'data'=>$data], 200);
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }

    public function getEnderecoAll($id){
        $data = $this->service->getEnderecoAll($id);
        
        if($data){
            return response()->json(['success'=>true, 'data'=>$data], 200);
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }

    public function deleteEndereco($id){
        $data = $this->service->deleteEndereco($id);
        
        if($data){
            return response()->json(['success'=>true],  200);
        }else{
            return response()->json(['success'=>false], 401);            
        }

    }

    public function updateCliente(Request $request, $id){      
      
        $body = $request->all();
        $data = $this->service->updateCliente($id, $body);
        
        return response()->json(['success'=>true], 200);            
      
    }

    public function updateEndereco(Request $request, $id){
        
        $body = $request->all();
        $data = $this->service->updateEndereco($id, $body);

        return response()->json(['success'=>true], 200);  
    }


}

?>