<?php
require_once "consultarPessoa.php";
$usuario = $_SESSION['usuario'];
?>

<h3>Bem vindo, <?= ucfirst($usuario['nome']); ?></h3>
<?php if($usuario['perfil'] == "Admin"): ?>
    <a class="btn btn-primary" href="/navegacao.php?page=form-cadastro">
        <span class="glyphicon glyphicon-plus"></span> Criar Usuario
    </a>
<?php endif; ?>
<div class="pull-right">
    <button onclick="mostarCard()" class="btn btn-default btnDev"><span class="glyphicon glyphicon-th-large"></span></button>
    <button onclick="mostarTab()" class="btn btn-default btnDev"><span class="glyphicon glyphicon-th-list"></span></button>
</div>
<br>
<hr>

<div class="container" id="cartao">
    <div class="row">
        <?php foreach ($detalhesPessoa as $key => $pessoa){ ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail" style=" box-shadow: 1px 1px 1px #dbdbdb;">
                    <img class="img-responsive imgCard" src="../imagens/<?=ucfirst(strtolower($pessoa->foto));?>" alt="foto de perfil">
                    <div class="caption">
                        <h3><?=ucfirst(strtolower($pessoa->nome));?></h3>
                        <p><?=ucfirst(strtolower($pessoa->email));?></p>
                        <p><?=ucfirst(strtolower($pessoa->perfil));?></p>
                        <a class="btn btn-sm btn-info" href="/navegacao.php?page=perfilUsuario&id=<?=$pessoa->id;?>">
                            <span class="glyphicon glyphicon-user"></span> Perfil
                        </a>
                        <?php if($usuario['perfil'] == "Admin"): ?>
                            <a class="btn btn-sm btn-warning" href="/navegacao.php?page=editarForm&id=<?=$pessoa->id;?>">
                                <span class="glyphicon glyphicon-pencil"></span> Editar
                            </a>
                            <button onclick="apagarConf()" class="btn btn-sm btn-danger">
                                <span class="glyphicon glyphicon-trash"></span>  Excluir
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="text-center">

        <nav aria-label="Page navigation">
            <ul class="pager">
                <li>
                    <a href="navegacao.php?page=listaUsuarios&pagination=<?= $pagina = 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">Primeira</span>
                    </a>
                </li>
                <li><a href="navegacao.php?page=listaUsuarios&pagination=<?= $pagina = 1; ?>">1</a></li>
                <li><a href="navegacao.php?page=listaUsuarios&pagination=<?= $pagina = 2; ?>">2</a></li>
                <li><a href="navegacao.php?page=listaUsuarios&pagination=<?= $pagina = 3; ?>">3</a></li>
                <li><a href="navegacao.php?page=listaUsuarios&pagination=<?= $pagina = 4; ?>">4</a></li>
                <li>
                    <a href="navegacao.php?page=listaUsuarios&pagination=<?= $pagina = 4; ?>" aria-label="Next">
                        <span aria-hidden="true">Última</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!---->
        <!--            --><?php //if ($pagina > 1): ?>
        <!--                <a href="navegacao.php?page=listaUsuarios&pagination=--><?//= $pagina - 1; ?><!--" class="btn btn-default glyphicon glyphicon glyphicon-chevron-left"></a> --->
        <!--            --><?php //else: ?>
        <!--                <p class="glyphicon glyphicon-chevron-left"></p>-->
        <!--            --><?php //endif; ?>
        <!--            --><?php //if (($totalPaginas) > $pagina): ?>
        <!--                <a href="navegacao.php?page=listaUsuarios&pagination=--><?//= $pagina + 1; ?><!--" class="btn btn-default glyphicon glyphicon-chevron-right"></a>-->
        <!--            --><?php //else: ?>
        <!--                <p class="glyphicon glyphicon-chevron-right glyphicon"></p>-->
        <!--            --><?php //endif; ?>
    </div>
</div>

<div class="panel panel-default " id="tabela">
    <div class="panel-heading">
        <h1 class="text-center">Lista de usuários</h1>
    </div>
    <div class="panel-body table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>perfil</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <!--            --><?php
            //                while ($calculete=$query->fetch(PDO::FETCH_ASSOC)){
            //            ?>
            <?php foreach ($detalhesPessoa as $key => $pessoa): ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?=ucfirst(strtolower($pessoa->nome));?></td>
                    <td><?=ucfirst(strtolower($pessoa->email));?></td>
                    <td><?=ucfirst(strtolower($pessoa->perfil));?></td>
                    <td>
                        <a class="btn btn-sm btn-info" href="/navegacao.php?page=perfilUsuario&id=<?=$pessoa->id;?>">
                            <span class="glyphicon glyphicon-user"></span> Perfil
                        </a>
                        <?php if($usuario['perfil'] == "Admin"): ?>
                            <a class="btn btn-sm btn-warning" href="/navegacao.php?page=editarForm&id=<?=$pessoa->id;?>">
                                <span class="glyphicon glyphicon-pencil"></span> Editar
                            </a>
                            <button onclick="apagarConf()" class="btn btn-sm btn-danger">
                                <span class="glyphicon glyphicon-trash"></span>  Excluir
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <!--            --><?php
            //                }
            //            ?>
            </tbody>
        </table>
        <br>
        <div class="text-center">

            <nav aria-label="Page navigation">
                <ul class="pager">
                    <li>
                        <a href="navegacao.php?page=listaUsuarios&pagination=<?= $pagina = 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">Primeira</span>
                        </a>
                    </li>
                    <li><a href="navegacao.php?page=listaUsuarios&pagination=<?= $pagina = 1; ?>">1</a></li>
                    <li><a href="navegacao.php?page=listaUsuarios&pagination=<?= $pagina = 2; ?>">2</a></li>
                    <li><a href="navegacao.php?page=listaUsuarios&pagination=<?= $pagina = 3; ?>">3</a></li>
                    <li><a href="navegacao.php?page=listaUsuarios&pagination=<?= $pagina = 4; ?>">4</a></li>
                    <li>
                        <a href="navegacao.php?page=listaUsuarios&pagination=<?= $pagina = 4; ?>" aria-label="Next">
                            <span aria-hidden="true">Última</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!---->
            <!--            --><?php //if ($pagina > 1): ?>
            <!--                <a href="navegacao.php?page=listaUsuarios&pagination=--><?//= $pagina - 1; ?><!--" class="btn btn-default glyphicon glyphicon glyphicon-chevron-left"></a> --->
            <!--            --><?php //else: ?>
            <!--                <p class="glyphicon glyphicon-chevron-left"></p>-->
            <!--            --><?php //endif; ?>
            <!--            --><?php //if (($totalPaginas) > $pagina): ?>
            <!--                <a href="navegacao.php?page=listaUsuarios&pagination=--><?//= $pagina + 1; ?><!--" class="btn btn-default glyphicon glyphicon-chevron-right"></a>-->
            <!--            --><?php //else: ?>
            <!--                <p class="glyphicon glyphicon-chevron-right glyphicon"></p>-->
            <!--            --><?php //endif; ?>
        </div>
    </div>
</div>

<hr>
<script>

    function apagarConf(){
        let apagar = confirm('Deseja realmente excluir este registro?');
        if (apagar){
            window.location = "/navegacao.php?page=deletarUsuario&id=<?=$i->id;?>";
        }
        else{
            event.preventDefault();
        }
    }

    function mostarTab(){
        $("#tabela").fadeIn( 700 ).show();
        $("#cartao").hide();
    }

    function mostarCard(){
        $("#tabela").hide();
        $("#cartao").fadeIn( 700 ).show();
    }
    $( document ).ready(function() {
        $("#tabela").show();
        $("#cartao").hide();
    });

</script>
