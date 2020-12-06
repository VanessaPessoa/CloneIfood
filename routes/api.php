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
    Route::post('/', "RestauranteController@login");
    Route::post('/prato/{id}', "RestauranteController@updatePrato");
    Route::post('/{id}', "RestauranteController@updateRestaurante");

    Route::get('/', "RestauranteController@getAll");
    Route::get('/prato/promocao', "RestauranteController@getPratoPromocao");
    Route::get('/{id}', "RestauranteController@getRestaurante");
    Route::get('/pratos/{id}', "RestauranteController@getPratoAll");
    Route::get('/prato/{id}', "RestauranteController@getPrato");


    Route::delete('/prato/{id}', "RestauranteController@deletePrato");


});


Route::prefix('/cliente')->group(function(){
    Route::post('/create', "ClienteController@create");
    Route::post('/endereco', "ClienteController@endereco");
    Route::post('/', "ClienteController@login");

    Route::get('/', "ClienteController@getAll");
    Route::get('/{id}', "ClienteController@getCliente");
    Route::get('/endereco/{id}', "ClienteController@getEndereco");
    Route::get('/enderecos/{id}', "ClienteController@getEnderecoAll");

    Route::delete('/endereco/{id}', "ClienteController@deleteEndereco");

    Route::put('/{id}', "ClienteController@updateCliente");
    Route::put('/endereco/{id}', "ClienteController@updateEndereco");

});


Route::prefix('/pedido')->group(function(){
    Route::post('/', "PedidoController@createPedido");
    
    Route::get('/historicoCliente/{id}', "PedidoController@historicoCliente");
    Route::get('/historicoRestaurante/{id}', "PedidoController@historicoRestaurante");
    Route::get('/historicoRestauranteMes/{id}', "PedidoController@historicoRestauranteMes");
    Route::get('/historicoRestauranteSemana/{id}', "PedidoController@historicoRestauranteSemana");

    Route::get('/{id}', "PedidoController@getPedido");

});

?>
