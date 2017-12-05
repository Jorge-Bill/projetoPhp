<?php

//require_once "editarUsuario.php";

$id = $_REQUEST['id'];

$pdo = conectar();

$perfil = $pdo->prepare('SELECT * FROM pessoa WHERE id = :id');

$perfil->bindParam(":id", $id);


if ($perfil->execute()){
    $perfil = $perfil->fetch(PDO::FETCH_ASSOC);
}
?>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">  <h1>Perfil</h1>
                </div>
                <div class="panel-body">
                    <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                        <?php
                        if (!empty($perfil['foto'])): ?>
                            <div class="container-fluid">
                                <a href=”/navegacao.php?page=listaUsuarios&id=<?=$pessoa->id;?>"> <img class="thumbnail fotoPerfil"src="../imagens/<?php echo $perfil['foto'];?> "></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8" >
                        <div class="container" >
                            <h2><?php echo $perfil['nome']?></h2>
                        </div>
                        <hr>
                        <ul class="container details" >
                            <li><p><span class="glyphicon glyphicon-user" style="width:50px;"></span><?php echo $perfil['perfil']?></p></li>
                            <li><p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span><?php echo $perfil['email']?></p></li>
                        </ul>
                        <hr>
                        <div class="pull-right">
                            <a class="btn btn-success glyphicon glyphicon-tasks" href="/navegacao.php?page=listaUsuarios&id=<?=$pessoa->id;?>"> Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!--teste-->
<!--    --><?php
//    if (!empty($perfil['foto'])): ?>
<!--        <div class="container-fluid">-->
<!--            <img class="img-circle fotoPerfil"src="../imagens/--><?php //echo $perfil['foto'];?><!-- ">-->
<!--        </div>-->
<!--    --><?php //endif; ?>
<!--    <div class="container">-->
<!--        <div class="col-md-7 col-md-offset-2 col-xs-12 text-center">-->
<!--            <div class="modal-dialog modal-sm-12">-->
<!--                <h1 class="text-center">Perfil</h1>-->
<!---->
<!--                <table class="table table-hover">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <td class="danger"><strong>Nome:</strong></td>-->
<!--                        <td class="danger"><strong>Email:</strong></td>-->
<!--                        <td class="danger"><strong>Perfil:</strong></td>-->
<!--                    </tr>-->
<!---->
<!--                    <tr>-->
<!--                        <td>--><?php //echo $perfil['nome']?><!--</td>-->
<!--                        <td>--><?php //echo $perfil['email']?><!--</td>-->
<!--                        <td>--><?php //echo $perfil['perfil']?><!--</td>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                </table>-->
<!--                <div class="pull-right">-->
<!--                    <a class="btn btn-success" href="listaUsuarios.php"> Voltar</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<?php
require_once "footer.php";?>