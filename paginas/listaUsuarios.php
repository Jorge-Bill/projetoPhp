<?php
require_once "consultarPessoa.php";
$usuario = $_SESSION['usuario'];
$paginacao = $_GET['pagination'];
?>

<h3>Bem vindo, <?= ucfirst($usuario['nome']); ?></h3>
<?php if($usuario['perfil'] == "Admin"): ?>
    <a class="btn btn-primary" href="/navegacao.php?page=form-cadastro">
        <span class="glyphicon glyphicon-plus"></span> Criar Usuario
    </a>
<?php endif; ?>
<div class="pull-right">
    <button id="btnCard" onclick="mostarCard()" class="btn btn-default btnDev"><span class="glyphicon glyphicon-th-large"></span></button>
    <button id="btnTab" onclick="mostarTab()" class="btn btn-default btnDev"><span class="glyphicon glyphicon-th-list"></span></button>
</div>
<br>
<hr>

<div class="container sumir" id="cartao">
    <div class="row">
        <?php foreach ($detalhesPessoa as $key => $pessoa): ?>
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
                            <button onclick="apagarConf(<?=$pessoa->id;?>)" class="btn btn-sm btn-danger">
                                <span class="glyphicon glyphicon-trash"></span> Excluir
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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
            <?php foreach ($detalhesPessoa as $key => $pessoa):
                ?>
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
                            <button onclick="apagarConf(<?=$pessoa->id;?>)" class="btn btn-sm btn-danger">
                                <span class="glyphicon glyphicon-trash"></span> Excluir
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <br>

    </div>
</div>

<div class="text-center">

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if ($paginacao != 1): ?>
                <li>
                    <a href="navegacao.php?page=listaUsuarios&pagination=<?= 1; ?>"><span aria-hidden="true">&laquo;</span></a>
                </li>
            <?php endif; ?>
            <li>
                <?php if ($paginacao > 1): ?>
                    <a href="navegacao.php?page=listaUsuarios&pagination=<?= $paginacao - 1; ?>"aria-label="Previous">
                        <span aria-hidden="true">&lsaquo;</span>
                    </a>
                <?php else: ?>
                      <span class="disabled" aria-hidden="true">Primeira</span>
                <?php endif; ?>
            </li>
            <?php if ($paginacao > 1): ?>
                <li><a href="navegacao.php?page=listaUsuarios&pagination=<?= $paginacao - 1; ?>"><?= $paginacao - 1; ?></a></li>
            <?php endif; ?>
                <li class="active"><a href="navegacao.php?page=listaUsuarios&pagination=<?= $paginacao; ?>"><?= $paginacao; ?></a></li>
            <?php if ($paginacao < $totalPaginas): ?>
                <li><a href="navegacao.php?page=listaUsuarios&pagination=<?= $paginacao + 1; ?>"><?= $paginacao + 1; ?></a></li>
            <?php    endif; ?>
            <li>
                <?php if (($totalPaginas) > $paginacao): ?>
                    <a href="navegacao.php?page=listaUsuarios&pagination=<?= $paginacao + 1; ?>"aria-label="Next">
                        <span aria-hidden="true">&rsaquo;</span>
                    </a>
                <?php else: ?>
                    <span class="disabled" aria-hidden="true">Último</span>
                <?php endif; ?>
            </li>
            <?php if ($totalPaginas > $paginacao): ?>
           <li>
               <a href="navegacao.php?page=listaUsuarios&pagination=<?= $totalPaginas; ?>"><span aria-hidden="true">&raquo;</span></a>
           </li>
            <?php endif; ?>
        </ul>
    </nav>

</div>

<div class="modal fade" tabindex="-1" role="dialog" id="exclusaoModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mensagem</h4>
            </div>
            <div class="modal-body">
                <p id="mensagem"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="apagarRegistro" class="btn btn-primary">Confirmar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="tentativaExc">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Alerta!</h4>
            </div>
            <div class="modal-body">
                <p id="mensagemExc"></p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">Okay</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<hr>

<script>

    function apagarConf(id){

        let idLogado = <?= $usuario['id']; ?>;

        if (id != idLogado){

            $('#exclusaoModal').modal('show');
            $("#mensagem").text("Deseja realmente excluir este registro?");

            $( "#apagarRegistro" ).click(function() {
                window.location = "/navegacao.php?page=deletarUsuario&id="+id;
            });
        }else {
            $('#tentativaExc').modal('show');
            $("#mensagemExc").text("Esse registro não pode ser excluido! voce ta logado, <?= $usuario['nome'];?>, babaca");
        }

    }

    function mostarTab(){
        $("#tabela").fadeIn( 700 ).show();
        $("#cartao").hide();
        $("#btnTab").addClass("active");
        $("#btnCard").removeClass("active");
    }

    function mostarCard(){
        $("#tabela").hide();
        $("#cartao").removeClass( "sumir" ).fadeIn( 700 ).show();
        $("#btnTab").removeClass("active");
        $("#btnCard").addClass("active");
    }
    $( document ).ready(function() {
        $("#tabela").show();
        $("#cartao").hide();
        $("#btnTab").addClass("active");
    });

</script>
