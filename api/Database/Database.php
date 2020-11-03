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
            id INT PRIMARY KEY AUTO_INCREMENT,
            nome VARCHAR(30) NOT NULL,
            telefone VARCHAR(11) NOT NULL,
            email VARCHAR(30) NOT NULL UNIQUE
        )");

        DB::statement("CREATE TABLE IF NOT EXISTS restaurante(
            id INT PRIMARY KEY AUTO_INCREMENT,
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
            cidade VARCHAR(100) NOT NULL
        )");

        DB::statement("CREATE TABLE IF NOT EXISTS enderecoCliente (
            id INT PRIMARY KEY AUTO_INCREMENT,
            rua VARCHAR(60) NOT NULL,
            numero INT,
            complemento VARCHAR(40),
            ponto_referencia VARCHAR(100),
            estado CHAR(2),
            cidade VARCHAR(100),
            nome_identificador VARCHAR(40),
            fk_cliente_id INT NOT NULL,
            FOREIGN KEY(fk_cliente_id)
                REFERENCES cliente (id)
        )");

        DB::statement("CREATE TABLE IF NOT EXISTS pedido(
            id INT PRIMARY KEY AUTO_INCREMENT,
            hora_pedido DATETIME NOT NULL,
            valor float(10,2),
            fk_cliente_id INT NOT NULL,
            FOREIGN KEY(fk_cliente_id)
                REFERENCES cliente (id)
        )");

        DB::statement("CREATE TABLE IF NOT EXISTS prato (
            descricao TEXT,
            nome VARCHAR(30) NOT NULL,
            id INT PRIMARY KEY AUTO_INCREMENT,
            imagem TEXT NULL,
            valor FLOAT(10,2) NOT NULL,
            fk_restaurante_id INT NOT NULL,
            FOREIGN KEY(fk_restaurante_id)
                REFERENCES restaurante (id)
        )");

        DB::statement("CREATE TABLE IF NOT EXISTS pedido_prato (
            id INT PRIMARY KEY AUTO_INCREMENT,
            quantidade INT NOT NULL,
            fk_pedido_id INT NOT NULL,
            fk_prato_id INT NOT NULL,
            FOREIGN KEY(fk_pedido_id)
                REFERENCES pedido (id),
            FOREIGN KEY(fk_prato_id)
                REFERENCES prato (id)
        )");
    }

    public function createRestaurante($data){

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
            cidade
            )
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )',
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
                $data['cidade']
            ]

        );
       
    }
}

?>
