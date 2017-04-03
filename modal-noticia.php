<?php
/* Esse arquivo é processado via ajax com Jquery, será reutilizado pelas páginas index.php e gerenciador.php, para mostrar tela modal para adicionar ou editar um post */
include_once('php/Conexao.php');
include_once('php/NoticiaDAO.php');

if(isset($_POST['id']) && !empty($_POST['id'])) {
    // Instancia uma conexão com PDO
    $conexao = new Conexao();
    $noticiaDAO = new NoticiaDAO($conexao->getInstance());
    $noticia = new Noticia();

    $noticia->setID($_POST['id']);

    $noticia = $noticiaDAO->getNoticia($noticia);
} else {
    $noticia = new Noticia();  
}
?>

<div id="modal-noticia" style="margin-top: -20px;">
    <div class="modal-dialog">
        <div class="modal-content">        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                <h4 class="modal-title"><?=($noticia->getID() != null) ? 'Editar Notícia' : 'Nova notícia'; ?></h4>
            </div>

            <div class="modal-body">
                <form id="noticiaForm" name="noticiaForm" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" method="POST">
                    <input id="id" name="id" type="hidden" value="<?php echo $noticia->getID(); ?>">

                    <div class="form-group">
                        <label for="autor" class="col-md-3 control-label">Autor</label>
                        <div class="col-md-8">
                            <input type="text" id="autor" name="autor" value="<?php echo $noticia->getAutor(); ?>" class="form-control" autofocus autocomplete="off" required>
                        </div>                              
                    </div>
                    <div class="form-group">
                        <label for="titulo" class="col-md-3 control-label">Título</label>
                        <div class="col-md-8">
                            <input id="titulo" name="titulo"  type="text" value="<?php echo $noticia->getTitulo(); ?>" class="form-control" autocomplete="off" required>
                        </div>                              
                    </div>
                    <div class="form-group">
                        <label for="descricao" class="col-md-3 control-label">Descrição</label>
                        <div class="col-md-8">
                            <textarea id="descricao" name="descricao" data-minlength="100" style="height: 150px;" class="form-control" required><?php echo $noticia->getDescricao(); ?></textarea>
                            <span class="help-block">Mínimo de cem (100) digitos</span>
                        </div>                              
                    </div>

                    <input id="img" name="img" type="hidden" value="<?php echo $noticia->getImagem(); ?>">
                    
                    <?php if($noticia->getID() != null) :?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Imagem</label>
                        <div class="col-md-8">
                            <img src="img/<?php echo $noticia->getImagem(); ?>" style="height: 150px;" class="form-control">
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="imagem" class="col-md-3 control-label"><?php echo ($noticia->getID() != null) ? '' : 'Imagem'; ?></label>
                        <div class="col-md-8">
                            <input type="file" id="imagem" name="imagem" class="form-control" <?php echo ($noticia->getID() != null) ? '' : 'required'; ?>>
                        </div>
                    </div>

                    <div class="form-group">                                   
                        <div class="col-md-offset-3 col-md-9">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary"><?php echo ($noticia->getID() != null) ? 'Atualizar' : 'Cadastrar'; ?></button>
                        </div>
                    </div> 
                </form>
            </div>                  
        </div>
    </div>
</div>

<!-- Função carregada no on-load para ativar bootstrap validator -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#noticiaForm').validator();
    });
</script>