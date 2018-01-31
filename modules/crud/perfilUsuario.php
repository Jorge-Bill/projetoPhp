<?php

$id = $_GET['id'];

$pdo = conectar();

$perfil = $pdo->prepare('SELECT * FROM pessoa WHERE id = :id');

$perfil->bindParam(":id", $id);

if ($perfil->execute()){
    $perfil = $perfil->fetch(PDO::FETCH_ASSOC);
}
if ($_GET['id'] == ""){
    header("Location: /navegacao.php");
}

if (!intval($_GET['id'])) {
    header("Location: /navegacao.php?page=listaUsuarios");
}

?>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Perfil</h1>
                </div>
                <div class="panel-body">
                    <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                        <?php
                        if (!empty($perfil['foto'])): ?>
                            <div class="container-fluid">
                                <img class="thumbnail fotoPerfil" src="/public/imagens/<?php echo $perfil['foto'];?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                        <div class="container">
                            <h2 style="color: #2aabd2;""><?php echo htmlspecialchars(ucfirst($perfil['nome'])); ?></h2>
                        </div>
                        <hr>
                        <table class="table table-hover"">
                        <ul class="container details">
                            <li><p style="color: #2aabd2;"><span class="glyphicon glyphicon-user" style="width:50px; color: #2aabd2;"></span><?= htmlspecialchars( $perfil['perfil'])?></p></li>
                            <li><p style="color: #2aabd2;"><span class="glyphicon glyphicon-envelope one" style="width:50px; color: #2aabd2;"></span><?= htmlspecialchars( $perfil['email'])?></p></li>
                        </ul>
                        </table>
                        <hr>
                        <div class="pull-right">
                            <a class="btn btn-success" href="/navegacao.php?page=listaUsuarios">Voltar
                                <espan class="glyphicon glyphicon-list-alt"></espan></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
