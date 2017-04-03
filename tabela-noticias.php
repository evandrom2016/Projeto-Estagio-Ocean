<?php
/* Esse arquivo é processado via ajax com Jquery, para atualizar tabela de notícias quando um post é salvo, aualizado ou excluído, ou, quando é realizada uma pesquisa */
include_once('php/Conexao.php');
include_once('php/NoticiaDAO.php');
include_once('php/Noticia.php');
include_once('helpers.php');

// Instanciar uma conexão com PDO
$conexao = new Conexao();
$noticiaDAO = new NoticiaDAO($conexao->getInstance());
$noticia = new Noticia();

if(isset($_POST['operacao']) && !empty($_POST['operacao'])) {
    $operacao = $_POST['operacao'];
     
    if($operacao == 'search') {
        $noticia->setTitulo($_POST['titulo']);
        $noticias = $noticiaDAO->search($noticia);
    }

    if($operacao == 'delete') {
        $noticia->setID($_POST['id']);
        $noticia = $noticiaDAO->getNoticia($noticia);

        $result = $noticiaDAO->delete($noticia); 

        if($result) {
            // Remove imagem do post da pasta img
            unlink("img/".$noticia->getImagem());
        }     
    }

    if($operacao != 'search') {
        $noticias = $noticiaDAO->getNoticias($noticia);
    }
} else {
    $noticias = $noticiaDAO->getNoticias();
}
?>

<div class="row">    
    <table id="tabela-noticias" class="table table-striped pagin-table table-hover table-bordered" style="margin-top: 5px"> 
        <th width="15%">Autor</th>
        <th width="20%">Título</th>
        <th width="45%">Descrição</th>
        <th width="10%">Data</th>
        <th width="10%">Ações</th>   
        <?php foreach($noticias as $noticia) : ?>
        <tr>
            <td><?php echo $noticia->getAutor(); ?></td>
            <td><?php echo $noticia->getTitulo(); ?></td>
            <td><?php echo descricao_resumida($noticia->getDescricao()); ?></td>
            <td><?php echo $noticia->getData(); ?></td>
            <td>
                <a href="visualizar.php?id=<?php echo $noticia->getID(); ?>" title="Mostrar" class="glyphicon glyphicon-search"></a>
                <a href="javascript:void(0);" title="Editar" onClick="editarPost('<?php echo $noticia->getID(); ?>');" class="glyphicon glyphicon-edit"></a>
                <a href="javascript:void(0);" title="Excluir" onClick="confirmacaoExclusao('<?php echo $noticia->getID(); ?>');" class="glyphicon glyphicon-trash"></a>
            </td>
        </tr>        
        <?php endforeach; ?>
        <?php echo (sizeof($noticias) == 0) ? "<tr><td colspan='5'><em><strong>Nenhum post encontrado.</strong></em></td></tr>" : "" ?>
    </table>
</div>