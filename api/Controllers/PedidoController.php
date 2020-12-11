<?php
namespace Api\Controllers;

use App\Http\Controllers\Controller;
use Api\Database\Database;
use Api\Services\PedidoService;
use Illuminate\Http\Request;

class PedidoController extends Controller{

    private $service; 

    public function __construct(){
       $this->service = new PedidoService();
    }

    public function createPedido(Request $request){
        $validatedData = $request->validate([
            'valor' => 'required',
            'fk_enderecocliente_id' => 'required',
        ]);
        $body = $request->all();
        $this->service->createPedido($body);
        return response()->json(['success'=>true, "data" => $body]);
    }

    public function historicoCliente($id){
        $data =  $this->service->historicoCliente($id);
        
        if($data){
            return response()->json(['success'=>true, 'data'=>$data]);
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }

    public function historicoRestaurante($id){
        $data =  $this->service->historicoRestaurante($id);
        
        if($data){
            return response()->json(['success'=>true, 'data'=>$data]);
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }

    public function historicoRestauranteMes($id){
        $data =  $this->service->historicoRestauranteMes($id);
        
        if($data){
            return response()->json(['success'=>true, 'data'=>$data]);
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }

    public function historicoRestauranteSemana($id){
        $data =  $this->service->historicoRestauranteSemana($id);
        
        if($data){
            return response()->json(['success'=>true, 'data'=>$data]);
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }

    public function getPedido($id){
        $data =  $this->service->getPedido($id);
        
        if($data){
            return response()->json(['success'=>true, 'data'=>$data]);
        }else{
            return response()->json(['success'=>false], 401);            
        }
    }
}

?>