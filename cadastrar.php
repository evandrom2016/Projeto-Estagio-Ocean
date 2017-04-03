<?php
/* Arquivo para receber os dados da requisição e salvar post no banco de dados */
include_once('php/Conexao.php');
include_once('php/NoticiaDAO.php');
include_once('php/Noticia.php');

$result = false;

if(count($_POST) > 0) 
{  
	// Instancia uma conexão com PDO
	$conexao = new Conexao();
	$noticiaDAO = new NoticiaDAO($conexao->getInstance());

    $noticia = new Noticia();  

    if(isset($_POST['id']) && !empty($_POST['id'])) {
    	$noticia->setID($_POST['id']);
    }

    $noticia->setTitulo($_POST['titulo']);
    $noticia->setDescricao($_POST['descricao']);

    $imagem = $_FILES['imagem'];

	// Se a foto estiver sido selecionada
	if (!empty($imagem['name'])) {
	    // Pega extensão da imagem
	    preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem['name'], $ext);
	    // Gera um nome único para a imagem
	    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
	    // Caminho onde ficará a imagem
	    $caminho_imagem = "img/" . $nome_imagem;
	    // Faz o upload da imagem para seu respectivo caminho
	    move_uploaded_file($imagem["tmp_name"], $caminho_imagem);

        if ($noticia->getID() != null) {
            // Remove imagem antiga da pasta img
            unlink("img/".$_POST['img']);
        }        

    	$noticia->setImagem($nome_imagem); 
    } else {
    	$noticia->setImagem($_POST['img']);
    }

    $noticia->setAutor($_POST['autor']);  
    
    if ($noticia->getID() != null) {
    	$result = $noticiaDAO->update($noticia);
    } else {
    	$result = $noticiaDAO->insert($noticia);
    }
}
?>