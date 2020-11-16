<?php

namespace Api\Database;

use Illuminate\Support\Facades\DB;

class Database {

    private static $instance;

    private function __construct(){
        $this->createBase();
    }

    public static function getInstance(){
        
        if(!isset(self::$instance)) {
            $instance = new Database();
        }

        return $instance;
    }

    private function createBase(){
        DB::statement("CREATE TABLE IF NOT EXISTS cliente (
            senha VARCHAR(10) NOT NULL,
            id VARCHAR(36) PRIMARY KEY,
            nome VARCHAR(30) NOT NULL,
            telefone VARCHAR(11) NOT NULL,
            email VARCHAR(30) NOT NULL UNIQUE
        )");

        DB::statement("CREATE TABLE IF NOT EXISTS restaurante(
            id VARCHAR(36) PRIMARY KEY,
            nome VARCHAR(30) NOT NULL,
            hora_fechamento VARCHAR(5) NOT NULL,
            hora_abertura VARCHAR(5) NOT NULL, 
            descricao TEXT NOT NULL,
            dias_funcionamento VARCHAR(20) NOT NULL,
            pode_retirarSN TINYINT NOT NULL,
            telefone VARCHAR(11) NOT NULL,
            email VARCHAR(50) NOT NULL UNIQUE,
            senha VARCHAR(10) NOT NULL,
            imagem TEXT NULL,
            rua VARCHAR(60) NOT NULL,
            numero INT NULL,
            complemento VARCHAR(40) NULL,
            ponto_referencia VARCHAR(100) NULL,
            estado CHAR(2) NOT NULL,
            cidade VARCHAR(100) NOT NULL,
            especialidade ENUM('acai', 'africana', 'arabe', 'alema', 'argentina', 'bebidas',
            'brasileira', 'cafeteria', 'carnes','chinesa', 'congelados', 'colombiana',
            'coreana', 'doces e bolos', 'espanhola', 'francesa','frutos do mar',
            'marmita', 'mexicana','salgados', 'saudavel', 'sorvete', 'lacnhe', 'sucos') NOT NULL
        )");

        DB::statement("CREATE TABLE IF NOT EXISTS enderecoCliente (
            id VARCHAR(36) PRIMARY KEY,
            rua VARCHAR(60) NOT NULL,
            numero INT NULL,
            complemento VARCHAR(40),
            ponto_referencia VARCHAR(100),
            estado CHAR(2) NOT NULL,
            cidade VARCHAR(100) NOT NULL,
            nome_identificador VARCHAR(40),
            fk_cliente_id VARCHAR(36) NOT NULL,
            FOREIGN KEY(fk_cliente_id)
                REFERENCES cliente (id)
        )");

        DB::statement("CREATE TABLE IF NOT EXISTS pedido(
            id VARCHAR(36) PRIMARY KEY,
            hora_pedido VARCHAR(5) NOT NULL,
            valor float(10,2) NOT NULL,
            fk_cliente_id VARCHAR(36) NOT NULL,
            FOREIGN KEY(fk_cliente_id)
                REFERENCES cliente (id)
        )");

        DB::statement("CREATE TABLE IF NOT EXISTS prato (
            descricao TEXT,
            nome VARCHAR(30) NOT NULL,
            id VARCHAR(36) PRIMARY KEY,
            imagem TEXT NULL,
            valor FLOAT(10,2) NOT NULL,
            fk_restaurante_id VARCHAR(36) NOT NULL,
            FOREIGN KEY(fk_restaurante_id)
                REFERENCES restaurante (id)
        )");

        DB::statement("CREATE TABLE IF NOT EXISTS pedido_prato (
            id VARCHAR(36) PRIMARY KEY,
            quantidade INT NOT NULL,
            fk_pedido_id VARCHAR(36) NOT NULL,
            fk_prato_id VARCHAR(36) NOT NULL,
            FOREIGN KEY(fk_pedido_id)
                REFERENCES pedido (id),
            FOREIGN KEY(fk_prato_id)
                REFERENCES prato (id)
        )");
    }

    public function createRestaurante($data, $id){

        DB::insert('INSERT INTO restaurante (
            nome, 
            hora_fechamento, 
            hora_abertura, 
            descricao, 
            dias_funcionamento, 
            pode_retirarSN, 
            telefone,
            email, 
            senha, 
            imagem, 
            rua, 
            numero, 
            complemento, 
            ponto_referencia, 
            estado, 
            cidade,
            especialidade,
            id
            )
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )',
            [
                $data['nome'],
                $data['hora_fechamento'],
                $data['hora_abertura'],
                $data['descricao'],
                $data['dias_funcionamento'],
                $data['pode_retirarSN'],
                $data['telefone'],
                $data['email'],
                $data['senha'],
                $data['imagem'],
                $data['rua'],
                $data['numero'],
                $data['complemento'],
                $data['ponto_referencia'],
                $data['estado'],
                $data['cidade'],
                $data['especialidade'],
                $id
            ]
        );
    }

    public function createCliente($data, $id){

        DB::insert('INSERT INTO cliente (
                nome,
                telefone,
                email,
                senha,
                id
            )
            VALUES(?, ?, ?, ?, ?)',
            [
                $data['nome'],
                $data['telefone'],
                $data['email'],
                $data['senha'],
                $id
            ]
        );
    }

    public function createEnderecoCliente($data, $id){

        DB::insert('INSERT INTO enderecoCliente (
            rua,
            numero,
            complemento,
            ponto_referencia,
            estado,
            cidade,
            nome_identificador,
            fk_cliente_id,
            id
        ) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)',
        [
            $data['rua'],
            $data['numero'],
            $data['complemento'],
            $data['ponto_referencia'],
            $data['estado'],
            $data['cidade'],
            $data['nome_identificador'],
            $data['fk_cliente_id'],
            $id
        ]);
    }

    public function createPrato($data, $id){

        DB::insert('INSERT INTO prato (
            nome,
            descricao,
            imagem,
            valor,
            fk_restaurante_id,
            id
        )
        VALUES(?, ?, ?, ?, ?, ?)',
        [
            $data['nome'],
            $data['descricao'],
            $data['imagem'],
            $data['valor'],
            $data['fk_restaurante_id'],
            $id
        ]
    );
    }

    public function createPedido($data, $id){
        
       $db = DB::insert('INSERT INTO pedido (
            hora_pedido,
            valor,
            fk_cliente_id,
            id
        )
        VALUES(?, ?, ?, ?)',
        [
            $data['hora_pedido'],
            $data['valor'],
            $data['fk_cliente_id'],
            $id
        ]);       
    }

    public function createPedidoPrato($idPedido, $idPrato, $quantidade, $id){
   
        DB::insert('INSERT INTO pedido_prato (
            quantidade,
            fk_pedido_id,
            fk_prato_id,
            id
        )
        VALUES(?, ?, ?, ?)',
        [
            $quantidade,
            $idPedido,
            $idPrato,
            $id
        ]);
    }   

    public function getCliente($id){
        $results = DB::select( DB::raw("SELECT * FROM cliente WHERE id = '$id'") );

        return $results;
    }

    public function getClienteAll(){
        $results = DB::select( DB::raw("SELECT * FROM cliente") );

        return $results;
    }

    public function getRestaurante($id){
        $results = DB::select( DB::raw("SELECT * FROM restaurante WHERE id = '$id'") );

        return $results;
    }

    public function getRestauranteAll(){
        $results = DB::select( DB::raw("SELECT * FROM restaurante") );

        return $results;
    }

    public function getPrato($id){
        $results = DB::select( DB::raw("SELECT * FROM prato WHERE id = '$id'") );

        return $results;
    }

    public function getEndereco($id){
        $results = DB::select( DB::raw("SELECT * FROM endereco WHERE id = '$id'") );

        return $results;
    }    


    public function autenticacaoCliente($email, $senha){
        $results = DB::select( DB::raw("SELECT * FROM cliente WHERE email = '$email' AND senha = '$senha' ") );

        return $results;
    }

    public function autenticacaoRestaurante($email, $senha){
        $results = DB::select( DB::raw("SELECT * FROM restaurante WHERE email = '$email' AND senha = '$senha' ") );

        return $results;
    }
}
?>
