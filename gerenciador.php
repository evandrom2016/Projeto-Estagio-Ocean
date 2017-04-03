<?php
/* Arquivo para receber os dados do formulário e salvar post no banco de dados */
include_once('cadastrar.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Gerenciador de Posts</title>
    <meta charset=utf-8>
    <meta name=viewport content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/noticias.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    
    <script src="js/validator.min.js"></script>
    <script src="js/noticias.js"></script>

    <script type="text/javascript">  
        /* Função para buscar posts com JQuery */
        function buscarPost() {
            var titulo = $('#busca').val();
            $('#tabela-noticias').load('tabela-noticias.php', {titulo:titulo, operacao:'search'});
        }
        /* Função para chamar tela modal com JQuery */
        function novoPost() {
            $('#modal-noticia').load('modal-noticia.php');
            $('#modal-noticia').modal('show');           
        }
        /* Função para chamar tela modal com dados do post selecionado com JQuery */
        function editarPost(id) {
            $('#modal-noticia').load('modal-noticia.php', {id:id});
            $('#modal-noticia').modal('show');           
        }
        /* Função confirmar exclusão */
        function confirmacaoExclusao(id) { 
            bootbox.confirm({
                message:'Confirma a exclusão do post?',
                callback: function(confirmacao){
                  if (confirmacao) {
                        excluirPost(id);
                        bootbox.alert('Post excluído com sucesso!');  
                    } 
                },
                buttons: {
                    cancel: {label: 'Não',className:'btn-danger'},
                    confirm: {label: 'Sim',className:'btn-success'}           
                }
            });
        }
        /* Função excluir e atualizar tabela de posts via ajax com JQuery */
        function excluirPost(id) {
            $.ajax({                    
                type: "POST",
                data: {id:id, operacao:'delete'},                    
                url: "tabela-noticias.php",
                dataType: "html",
                success: function(result) {
                    $("#tabela-noticias").html(result);                       
                }
            });
        }
    </script>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">	
        <!-- Exibe mensagem  de sucesso quando post é salvo -->	
		<?php echo $result ? "<div class='row alert alert-success'>Post salvo com sucesso.</div>" : ""; ?>

        <!-- Tabela de posts -->
        <?php include 'tabela-noticias.php'; ?>
    </div>

    <!-- Tela modal é carregada via JQuery -->
    <div id="modal-noticia" class="modal fade"></div>

    <!-- Função carregada no on-load para ativar tempo de exibição da mensagem de sucesso, caso post tenha sido salvo -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.alert-success').delay(5000).slideUp(function(){
                $('.alert-success').html('');
            });
        });
    </script>
</body>
</html>