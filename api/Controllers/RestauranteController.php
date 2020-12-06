<?php
namespace Api\Controllers;

use App\Http\Controllers\Controller;
use Api\Database\Database;
use Api\Services\RestauranteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Api\Util\UtilIdGenerated;

// use App\Image;

class RestauranteController extends Controller{

    private $service; 
    private $util;

    public function __construct(){
       $this->service = new RestauranteService();
       $this->util = new UtilIdGenerated();

    }


    public function create(Request $request){

        $validatedData = $request->validate([
            'nome' => 'required',
            'nomeRestaurante' => 'required',
            'email' => 'required',
            'senha' => 'required',
            'hora_fechamento' => 'required',
            'hora_abertura' => 'required',
            'telefone' => 'required',
            'rua' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'descricao' => 'required',
            'dias_funcionamento' => 'required',
            'especialidade' => 'required',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);

        if ($file = $request->file('imagem')) {
            $destinationPath = 'public/imagem/'; // upload path
            $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage);
            $insert['imagem'] = 'http://127.0.0.1:8000/'.$destinationPath.$profileImage;
        }

      
        $body = $request->all();

        $id = $this->service->create($body, $insert['imagem']);

        if($id){
            return response()->json(['success'=>true, 'id'=>$id, 'imagem'=> $insert['imagem']], 200);
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }

    public function createPrato (Request $request){
    
        $validatedData = $request->validate([
            'nome' => 'required',
            'valor' => 'required',
            'fk_restaurante_id' => 'required',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($file = $request->file('imagem')) {
            $destinationPath = 'public/imagem/'; // upload path
            $profileImage = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileImage);
            $insert['imagem'] = 'http://127.0.0.1:8000/'.$destinationPath.$profileImage;
        }

        $body = $request->all();
        $id = $this->service->createPrato($body, $insert['imagem']);

        if($id){
            return response()->json(['success'=>true, 'id'=>$id, 'imagem'=> $insert['imagem']] );
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
        $data = $this->service->autenticacao($body);

        if($data){
            return response()->json(['success'=>true, 'data'=>$data, 'role' => 'restaurante'], 200);            
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }


    public function getAll(){
        $data =  $this->service->getAll();
        
        if($data){
            return response()->json(['success'=>true, 'data'=>$data]);
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }

    // Todos os pratos de um restaurante
    public function getPratoAll($id){
        $data =  $this->service->getPratoAll($id);
        
        if($data){
            return response()->json(['success'=>true, 'data'=>$data]);
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }

    
    public  function getRestaurante($id){
        $data = $this->service->getRestaurante($id);

        if($data){
            return response()->json(['success'=>true, 'data'=>$data]);
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }

    public function getPrato($id){
        $data = $this->service->getPrato($id);

        if($data){
            return response()->json(['success'=>true, 'data'=>$data]);
        }else{
            return response()->json(['success'=>false], 401);            
        }

    }

    public function deletePrato($id){
        $data = $this->service->deletePrato($id);
        
        if($data){
            return response()->json(['success'=>true],  200);
        }else{
            return response()->json(['success'=>false], 401);            
        }

    }

}

?>