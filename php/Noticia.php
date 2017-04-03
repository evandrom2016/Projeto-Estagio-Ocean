<?php

class Noticia {

	private $id;
	private $titulo;
	private $descricao;
	private $imagem;
	private $data;
	private $autor;

	public function getID() {
		return $this->id;
	}

	public function setID($id) {
		$this->id = $id;
	}

	public function getTitulo() {
		return $this->titulo;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	public function getDescricao() {
		return $this->descricao;
	}

	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}

	public function getImagem() {
		return $this->imagem;
	}

	public function setImagem($imagem) {
		$this->imagem = $imagem;
	}

	public function getData() {
		return $this->data;
	}

	public function setData($data) {
		$this->data = $data;
	}

	public function getAutor() {
		return $this->autor;
	}

	public function setAutor($autor) {
		$this->autor = $autor;
	}
}

?>