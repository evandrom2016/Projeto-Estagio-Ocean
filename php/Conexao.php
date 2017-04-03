<?php

class Conexao {   
    // Dados para conexao com o Banco de Dados
    private $host     = 'localhost';
    private $usuario = 'root';
    private $senha = '';
    private $banco     = 'comicsnews';

    public $conexao;
    
    // Conecta com o Banco de Dados e retorna uma conexao
    public function __construct(){
        if(!isset($this->conexao)){
            // Conecta o Banco de Dados
            try{
                $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->banco, $this->usuario, $this->senha);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conexao = $conn;
            }catch(PDOException $e){
                die("Falha de conexao com o Banco de Dados: " . $e->getMessage());
            }
        }
    }

    public function getInstance() {
        return $this->conexao;
    }
}