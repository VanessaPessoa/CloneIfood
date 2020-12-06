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
            nomeCliente VARCHAR(30) NOT NULL,
            telefone VARCHAR(11) NOT NULL,
            email VARCHAR(30) NOT NULL UNIQUE
        )");

        DB::statement("CREATE TABLE IF NOT EXISTS restaurante(
            id VARCHAR(36) PRIMARY KEY,
            nome VARCHAR(30) NOT NULL,
            nomeRestaurante VARCHAR(30) NOT NULL,
            hora_fechamento VARCHAR(5) NOT NULL,
            hora_abertura VARCHAR(5) NOT NULL, 
            descricao TEXT NOT NULL,
            dias_funcionamento VARCHAR(20) NOT NULL,
            telefone VARCHAR(11) NOT NULL,
            email VARCHAR(50) NOT NULL UNIQUE,
            senha VARCHAR(10) NOT NULL,
            imagem TEXT NOT NULL,
            rua VARCHAR(60) NOT NULL,
            numero INT NULL,
            complemento VARCHAR(40) NULL,
            ponto_referencia VARCHAR(100) NULL,
            estado CHAR(2) NOT NULL,
            cidade VARCHAR(100) NOT NULL,
            especialidade ENUM('Açaí',
                                'Africana',
                                'Arabe',
                                'Alemã',
                                'Argentina',
                                'Bebidas',
                                'Brasileira',
                                'Cafeteria',
                                'Carnes',
                                'Chinesa',
                                'Congelados',
                                'Colombiana',
                                'Coreana',
                                'Doces e bolos',
                                'Espanhola',
                                'Francesa',
                                'Peixes',
                                'Marmita',
                                'Mexicana',
                                'Salgados',
                                'Saudavel',
                                'Sorvete',
                                'Lanches',
                                'Sucos') NOT NULL
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
            fk_enderecocliente_id VARCHAR(36) NOT NULL,
            FOREIGN KEY(fk_enderecocliente_id)
                REFERENCES enderecocliente (id)
        )");

        DB::statement("CREATE TABLE IF NOT EXISTS prato (
            descricao TEXT,
            nome VARCHAR(30) NOT NULL,
            id VARCHAR(36) PRIMARY KEY,
            imagem TEXT NOT NULL,
            valor FLOAT(10,2) NOT NULL,
            ativo INT NOT NULL,
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

    public function createRestaurante($data, $id, $imagem){

        DB::insert('INSERT INTO restaurante (
            nome, 
            nomeRestaurante,
            hora_fechamento, 
            hora_abertura, 
            descricao, 
            dias_funcionamento, 
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
                $data['nomeRestaurante'],
                $data['hora_fechamento'],
                $data['hora_abertura'],
                $data['descricao'],
                $data['dias_funcionamento'],
                $data['telefone'],
                $data['email'],
                $data['senha'],
                $imagem,
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
                nomeCliente,
                telefone,
                email,
                senha,
                id
            )
            VALUES(?, ?, ?, ?, ?)',
            [
                $data['nomeCliente'],
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

    public function createPrato($data, $id, $imagem){

        DB::insert('INSERT INTO prato (
            nome,
            descricao,
            imagem,
            valor,
            fk_restaurante_id,
            id,
            ativo
        )
        VALUES(?, ?, ?, ?, ?, ?, ?)',
        [
            $data['nome'],
            $data['descricao'],
            $imagem,
            $data['valor'],
            $data['fk_restaurante_id'],
            $id,
            1
        ]
    );
    }

    public function createPedido($data, $id){
        
       $db = DB::insert('INSERT INTO pedido (
            hora_pedido,
            valor,
            fk_enderecocliente_id,
            id
        )
        VALUES(?, ?, ?, ?)',
        [
            $data['hora_pedido'],
            $data['valor'],
            $data['fk_enderecocliente_id'],
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
        
        $results = DB::select( DB::raw("SELECT * FROM prato INNER JOIN restaurante  ON prato.fk_restaurante_id = restaurante.id WHERE prato.id= '$id' AND prato.ativo = 1") );

        return $results;
    }

    public function getPratoAll($id){
        
        $results = DB::select( DB::raw("SELECT * FROM prato INNER JOIN restaurante  ON prato.fk_restaurante_id = restaurante.id WHERE restaurante.id= '$id' AND prato.ativo = 1") );

        return $results;
    }

    public function getEndereco($id){
        
        $results = DB::select(DB::raw("SELECT * FROM enderecocliente INNER JOIN cliente  ON enderecocliente.fk_cliente_id = cliente.id WHERE enderecocliente.id='$id' "));

        return $results;
    }    

    public function getEnderecoAll($id){
        
        $results = DB::select(DB::raw("SELECT * FROM enderecocliente INNER JOIN cliente  ON enderecocliente.fk_cliente_id = cliente.id WHERE cliente.id='$id' "));

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

    public function historicoRestaurante($id){
        
        $results = DB::select(
            DB::raw("
                SELECT  pedido.id, pedido.valor, pedido.hora_pedido, 
                C.nomeCliente, C.telefone, C.email,
                E.rua, E.numero, E.complemento, E.ponto_referencia,
                prato.nome, prato.descricao, prato.imagem, prato.valor
                FROM cliente C
                JOIN enderecocliente E ON E.fk_cliente_id = C.id
                JOIN pedido ON pedido.fk_enderecocliente_id = E.id
                JOIN pedido_prato PP ON PP.fk_pedido_id = pedido.id
                JOIN prato ON PP.fk_prato_id = prato.id
                WHERE prato.fk_restaurante_id = '$id'
            ")
        );
        
        return $results;
    }

    public function getPedido($id){
        
        $results = DB::select(
            DB::raw("
            SELECT  pedido.id, pedido.valor, pedido.hora_pedido, 
            C.nomeCliente, C.telefone, C.email,
            E.rua, E.numero, E.complemento, E.ponto_referencia,
            prato.nome, prato.descricao, prato.imagem, prato.valor,
            R.nomeRestaurante
            FROM cliente C
            JOIN enderecocliente E ON E.fk_cliente_id = C.id
            JOIN pedido ON pedido.fk_enderecocliente_id = E.id
            JOIN pedido_prato PP ON PP.fk_pedido_id = pedido.id
            JOIN prato ON PP.fk_prato_id = prato.id
            JOIN restaurante R ON R.id =  prato.fk_restaurante_id
            WHERE pedido.id = '$id';
            ")
        );

        return $results;
    }

    public function historicoCliente($id){
        
        $results = DB::select(
            DB::raw("
            SELECT  pedido.id, pedido.valor, pedido.hora_pedido, 
            C.nomeCliente, C.telefone, C.email,
            E.rua, E.numero, E.complemento, E.ponto_referencia,
            prato.nome, prato.descricao, prato.imagem, prato.valor,
            R.nomeRestaurante
            FROM cliente C
            JOIN enderecocliente E ON E.fk_cliente_id = C.id
            JOIN pedido ON pedido.fk_enderecocliente_id = E.id
            JOIN pedido_prato PP ON PP.fk_pedido_id = pedido.id
            JOIN prato ON PP.fk_prato_id = prato.id
            JOIN restaurante R ON R.id =  prato.fk_restaurante_id
            WHERE C.id = '$id'
            ;
            ")
        );

        return $results;
    }

    public function deleteEndereco($id){
       
        $results = DB::delete(DB::raw("DELETE FROM enderecocliente WHERE id = '$id'"));

        return $results;
    }

    public function deletePrato($id){
        
        $results = DB::update(DB::raw("UPDATE prato SET ativo = 0 WHERE id = '$id'"));
        
        return $results;
    }


    public function updateNomeCliente($id, $nome){
        
        $results = DB::update(
           DB::raw( 
                "UPDATE cliente SET nomeCliente = '$nome' WHERE id = '$id'"            
        ));
        
        return $results;
    }

    public function updateTelefoneCliente($id, $telefone){
        
        $results = DB::update(
           DB::raw( 
                "UPDATE cliente SET telefone = '$telefone' WHERE id = '$id'"            
        ));
        
        return $results;
    }

    public function ruaCliente($id, $rua){
        
        $results = DB::update(
           DB::raw( 
                "UPDATE enderecocliente SET rua = '$rua' WHERE id = '$id'"            
        ));
        
        return $results;
    }
    
    public function numeroCliente($id, $numero){
        
        $results = DB::update(
           DB::raw( 
                "UPDATE enderecocliente SET numero = '$numero' WHERE id = '$id'"            
        ));
        
        return $results;
    }

    public function complementoCliente($id, $complemento){
        
        $results = DB::update(
           DB::raw( 
                "UPDATE enderecocliente SET complemento = '$complemento' WHERE id = '$id'"            
        ));
        
        return $results;
    }

    public function pontoReferenciaCliente($id, $ponto_referencia){
        
        $results = DB::update(
           DB::raw( 
                "UPDATE enderecocliente SET ponto_referencia = '$ponto_referencia' WHERE id = '$id'"            
        ));
        
        return $results;
    }

    public function cidadeCliente($id, $cidade){
        
        $results = DB::update(
           DB::raw( 
                "UPDATE enderecocliente SET cidade = '$cidade' WHERE id = '$id'"            
        ));
        
        return $results;
    }

    public function estadoCliente($id, $estado){
        
        $results = DB::update(
           DB::raw( 
                "UPDATE enderecocliente SET estado = '$estado' WHERE id = '$id'"            
        ));
        
        return $results;
    }

    public function nomeIdentificadorCliente($id, $nome_identificador){
        
        $results = DB::update(
           DB::raw( 
                "UPDATE enderecocliente SET nome_identificador = '$nome_identificador' WHERE id = '$id'"            
        ));
        
        return $results;
    }
   

}
?>
