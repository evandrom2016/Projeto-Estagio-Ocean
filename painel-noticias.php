<?php
/* Esse arquivo é processado via ajax com Jquery, para atualizar painel de notícias quando é realizada uma pesquisa */
include_once('php/Conexao.php');
include_once('php/NoticiaDAO.php');
include_once('php/Noticia.php');
include_once('helpers.php');

// Instancia uma conexão com PDO
$conexao = new Conexao();
$noticiaDAO = new NoticiaDAO($conexao->getInstance());

if(isset($_POST['titulo']) && !empty($_POST['titulo'])) 
{
    $noticia = new Noticia();
    $noticia->setTitulo($_POST['titulo']);

    $noticias = array();
    $noticias = $noticiaDAO->search($noticia);

    if(sizeof($noticias) == 0)
    {
        echo '<h2>Nenhum post encontrado.</h2>';
    }
}
else 
{
    $noticias = $noticiaDAO->getNoticias();
}
?>

<div id="noticias" class="row">
    <?php foreach($noticias as $noticia) : ?>
    <div class="col-md-3">
        <a href="visualizar.php?id=<?= $noticia->getID(); ?>" class="thumbnail">
            <figure class="imagem-home">               
                <img src="img/<?= $noticia->getImagem(); ?>" class="img-responsive"> 
                <figcaption>
                    <label style="margin-top: 10px; margin-left: 10px; margin-right: 10px; font-size: 10px; color: #B7FB09"><span class="glyphicon glyphicon-calendar"></span>&nbsp<?= traduz_data_home($noticia->getData()) . ' publicado por ' . $noticia->getAutor(); ?></label>
                    <h5 style="margin-left: 10px; margin-right: 10px;"><strong><?= $noticia->getTitulo(); ?></strong></h5>
                    <label style="margin-left: 10px; margin-right: 10px; font-size: 10px; text-align: justify"><?= descricao_resumida($noticia->getDescricao()); ?></label>
                </figcaption>
            </figure>
        </a>
    </div>   
    <?php endforeach; ?>   
</div>