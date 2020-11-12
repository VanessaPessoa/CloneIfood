<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Api\Database\Database;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/create', function(Request $request) {
    $db = Database::getInstance();
    return response()->json(['success'=>true]);
});

Route::prefix('restaurante')->group(function(){
    Route::post('/create', "RestauranteController@create");
    Route::post('/prato', "RestauranteController@createPrato");

});

Route::prefix('/cliente')->group(function(){
    Route::post('/create', "ClienteController@create");
    Route::post('/endereco', "ClienteController@endereco");
});

Route::prefix('pedido')->group(function(){
    Route::post('/', "PedidoController@createPedido");
});





/*
/****** Routes cliente******
/ Autenticaçao
/ lista de restaurantes -
/ lista pratos do restaurante
/ lista dados restaurante
/   
/ lista dos pedidos
/ fazer pedido
/ editar perfil
/ cadastrar endereco
/ lista enderecos
/ editar endereco
/ deleta endereco
/
/
/****** Restaurante ********
/ autenticacao
/ lista dos pedidos
/ lista dos  seus pratos
/ cria prato
/ edita prato
/ edita perfil
/ deleta prato
*/

?>