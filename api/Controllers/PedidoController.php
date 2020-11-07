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
            'hora_pedido' => 'required',
            'valor' => 'required',
            'fk_cliente_id' => 'required'
        ]);
        $body = $request->all();
        $this->service->createPedido($body);
        return response()->json(['success'=>true]);
    }

    public function pratosPedidos(Request $request){
        $validatedData = $request->validate([
            'fk_pedido_id' => 'required'
        ]);
        $body = $request->all();
        $this->service->pratosPedidos($body);
    }
}

?>