<!-- Arquivo header será reutilizado pelas páginas index.php, visualizar.php e gerenciador.php -->
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

    <div class="pull-right hidden-xs" style="margin-top: 8px; margin-right: 5px">
        <div class="box-tools" style="display:inline-table">
            <div class="input-group">
                <input type="text" id="busca" name="busca" class="form-control" onkeyup="buscarPost();" placeholder="Título">
                <span class="input-group-addon">Pesquisar</span>
            </div>
        </div>
        <button class="btn btn-success" onclick="novoPost();" style="margin-top: -27px">Nova Notícia</button>
    </div>
</nav>