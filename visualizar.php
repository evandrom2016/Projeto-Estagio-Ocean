<?php
/* Essa página será responsável por receber o parâmetros 'id' da requisição, buscar dados do Banco e mostrar na tela */
include_once('php/Conexao.php');
include_once('php/NoticiaDAO.php');
include_once('php/Noticia.php');
include_once('helpers.php');

if(isset($_GET['id']) && !empty($_GET['id'])) 
{
    // Instancia uma conexão com PDO
    $conexao = new Conexao();
    $noticiaDAO = new NoticiaDAO($conexao->getInstance());

    $noticia = new Noticia();
    $noticia->setID($_GET['id']);

    $noticia = $noticiaDAO->getNoticia($noticia);

    if($noticia->getID() == null) 
    {
        echo '<h1>Post não encontrado.</h1>';
        die();
    }
}
else 
{
    header('Location: /comics-news');
}
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
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="navbar-header">      
            <a id="comics-news" class="navbar-brand" href="">ComicsNews</a>

            <button class="navbar-toggle" type="button" data-target=".navbar-collapse" data-toggle="collapse">
                <span class="glyphicon glyphicon-align-justify"></span>
            </button>
        </div>

        <ul class="nav navbar-nav collapse navbar-collapse">
            <li>
                <a href="/comics-news">
                    <span class="glyphicon glyphicon-home"></span>
                    Página Inicial
                </a>
            </li>
            <li>
                <a href="gerenciador.php">
                    <span class="glyphicon glyphicon-edit"></span>
                    Gerenciador
                </a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <div class="row">
            <center><img id="imagem-visualizacao" style="margin-top: 5px" src="img/<?php echo $noticia->getImagem(); ?>" class="img-responsive hidden-xs"></center>
        </div>

        <div class="row" style="margin-top: 10px">
            <h1><center><strong><?php echo $noticia->getTitulo(); ?></strong><center></h1>
        </div>

        <div class="row info">
            <h4><center><?php echo traduz_data_visualizacao($noticia->getData()); ?> publicado por <?php echo $noticia->getAutor(); ?><center></h4>
        </center>
        </div>
    
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <p style="text-align: justify;"><?php echo nl2br($noticia->getDescricao()); ?></p>
            </div>
        </div>
    </div>
    <br><br>
</body>
</html>