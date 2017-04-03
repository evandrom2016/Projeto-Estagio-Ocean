<?php
/* Arquivo para receber os dados do formulário e salvar post no banco de dados */
include_once('cadastrar.php');
?>

<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<title>Portal ComicsNews</title>
  	<meta name=viewport content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/noticias.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/validator.min.js"></script>

    <script src="js/noticias.js"></script>

    <script>
    	/* Função para buscar posts com JQuery */
        function buscarPost() {
            var titulo = $('#busca').val();
            $('#noticias').load('painel-noticias.php', {titulo:titulo});
        }
        /* Função para chamar tela modal com JQuery */
        function novoPost() {
            $('#modal-noticia').load('modal-noticia.php');
            $('#modal-noticia').modal('show');           
        }         
    </script>
</head>
<body>
	<!-- Menu do topo -->
    <?php include_once('header.php'); ?>

    <div class="container">
    	<!-- Exibe mensagem  de sucesso quando post é salvo -->
        <?php echo $result?"<div class='row alert alert-success' style='margin-bottom: 20px'>Post salvo com sucesso.</div>":'';?>

        <!-- Painel de noticias -->
        <?php include_once('painel-noticias.php'); ?> 
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