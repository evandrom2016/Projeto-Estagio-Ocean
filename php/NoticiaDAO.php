<?php
include_once('Noticia.php');

class NoticiaDAO {

    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function insert(Noticia $noticia) {
        $this->conexao->beginTransaction();  

        try {
            $stmt = $this->conexao->prepare(
                'INSERT INTO noticia (titulo, descricao, img, autor) VALUES (:titulo, :descricao, :imagem, :autor)'
            );

            $stmt->bindValue(':titulo', addslashes($noticia->getTitulo()));
            $stmt->bindValue(':descricao', addslashes($noticia->getDescricao()));
            $stmt->bindValue(':imagem', $noticia->getImagem());
            $stmt->bindValue(':autor', addslashes($noticia->getAutor()));
            $result = $stmt->execute();

            $this->conexao->commit();

            return $result;
        }
        catch(Exception $e) {
            $this->conexao->rollback();
        }
    }

    public function update(Noticia $noticia) {
        $this->conexao->beginTransaction();  

        try {
            $stmt = $this->conexao->prepare(
                'UPDATE noticia SET titulo = :titulo, descricao = :descricao, img = :imagem, autor = :autor WHERE id = :id'
            );

            $stmt->bindValue(':id', $noticia->getID());
            $stmt->bindValue(':titulo', addslashes($noticia->getTitulo()));
            $stmt->bindValue(':descricao', addslashes($noticia->getDescricao()));
            $stmt->bindValue(':imagem', $noticia->getImagem());
            $stmt->bindValue(':autor', addslashes($noticia->getAutor()));
            $result = $stmt->execute();

            $this->conexao->commit();

            return $result;
        }
        catch(Exception $e) {
            $this->conexao->rollback();
        }
    }

    public function delete(Noticia $noticia) {
        $this->conexao->beginTransaction();

        try {
            $statement = $this->conexao->prepare(
                "DELETE FROM noticia WHERE id = '{$noticia->getID()}'"
            );

            $result = $statement->execute();

            $this->conexao->commit();  

            return $result;
        }
        catch(Exception $e) {
            $this->conexao->rollback();
        }
    }

    public function getNoticia(Noticia $noticia) {
        $statement = $this->conexao->query(
            "SELECT * FROM noticia WHERE ID = '{$noticia->getID()}'"
        );

        return $this->processResult($statement);
    }

    public function getNoticias() {
        $statement = $this->conexao->query(
            'SELECT * FROM noticia ORDER BY id DESC LIMIT 20'
        );

        return $this->processResults($statement);
    }

    public function search(Noticia $noticia) {
        $titulo = addslashes($noticia->getTitulo());

        $statement = $this->conexao->query(
            "SELECT * FROM noticia WHERE titulo LIKE '%{$titulo}%'"
        );

        return $this->processResults($statement);
    }

    private function processResult($statement) {
        $noticia = new Noticia();

        if($statement) {
            $row = $statement->fetch(PDO::FETCH_OBJ);
            $noticia->setID($row->ID);
            $noticia->setTitulo(stripslashes($row->titulo));
            $noticia->setDescricao(stripslashes($row->descricao));
            $noticia->setImagem($row->img);
            $noticia->setData($row->data);
            $noticia->setAutor(stripslashes($row->autor));
        }

        return $noticia;      
    }

    private function processResults($statement) {
        $noticias = array();

        if($statement) {
            while($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $noticia = new Noticia();
                $noticia->setID($row->ID);
                $noticia->setTitulo(stripslashes($row->titulo));
                $noticia->setDescricao(stripslashes($row->descricao));
                $noticia->setImagem($row->img);
                $noticia->setData($row->data);
                $noticia->setAutor(stripslashes($row->autor));

                $noticias[] = $noticia;
            }
        }

        return $noticias; 
    }
}