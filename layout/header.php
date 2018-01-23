<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ganso | William</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<?php
    if (array_key_exists('usuario',$_SESSION)):
        $usuario = $_SESSION['usuario'];
?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand glyphicon glyphicon-flash" href="/navegacao.php?page=listaUsuarios"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opções <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                            if (isset($usuario['nome'])): ?>
                                <li>
                                    <a href="/navegacao.php?page=perfilUsuario&id=<?=$usuario['id'];?>">Olá, <?php echo ucfirst($usuario['nome']); ?></a>
                                </li>
                            <?php endif;
                            ?>
                       <?php if ($usuario['perfil'] == "Admin"): ?>
                        <li>
                            <a href="/navegacao.php?page=editarForm&id=<?=$usuario['id'];?>">Editar</a>
                        </li>
                        <?php endif; ?>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="/navegacao.php?page=logout">Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<?php endif; ?>

<div class="container conteudo">
    <div class="row">