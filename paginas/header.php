<?php
session_start();

$email = $_SESSION['email'];

$pdo = conectar();

$mostrarNome = $pdo->prepare('SELECT * FROM pessoa WHERE email = :email');

$mostrarNome->bindParam(":email", $email);

if ($mostrarNome->execute()){
    $mostrarNome = $mostrarNome->fetch(PDO::FETCH_ASSOC);
}
else{
    echo "Erro ao cadastrar";
    print_r($mostrarNome->errorInfo());
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ganso | William</title>
    <link rel="stylesheet" href="/../css/bootstrap.min.css">
    <link rel="stylesheet" href="/../css/estilos.css">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

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
                        if (!empty($mostrarNome['nome'])): ?>
                        <li><p>Olá <?php echo $mostrarNome['nome'];?></p></li>
                        <?php endif; ?>
                        <li><a href="/navegacao.php?page=perfilUsuario.php">Perfil</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/navegacao.php?page=logout">Sair</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container conteudo">
    <div class="row">