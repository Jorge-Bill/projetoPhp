<?php
require_once "consultarPessoa.php";
$usuario = $_SESSION['usuario'];
?>


<h3>Bem vindo, <?= $usuario['nome']; ?></h3>
<div class="panel panel-default">
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
            <?php if($usuario['perfil'] == "Admin"): ?>
            <a class="btn btn-primary" href="/navegacao.php?page=form-cadastro">
                <span class="glyphicon glyphicon-plus"></span> Criar Usuario
            </a>
            <?php endif; ?>
            <?php foreach ($detalhesPessoa as $key => $pessoa): ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?=ucfirst(strtolower($pessoa->nome));?></td>
                    <td><?=ucfirst(strtolower($pessoa->email));?></td>
                    <td><?=ucfirst(strtolower($pessoa->perfil));?></td>
                    <td>
                        <a class="btn btn-sm btn-success" href="/navegacao.php?page=perfilUsuario&id=<?=$pessoa->id;?>">
                            <span class="glyphicon glyphicon-user"></span> Perfil
                        </a>
                        <?php if($usuario['perfil'] == "Admin"): ?>
                            <a class="btn btn-sm btn-warning" href="/navegacao.php?page=editarForm&id=<?=$pessoa->id;?>">
                              <span class="glyphicon glyphicon-pencil"></span> Editar
                            </a>
                            <a class="btn btn-sm btn-danger" href="/navegacao.php?page=deletarUsuario&id=<?=$pessoa->id;?>">
                               <span class="glyphicon glyphicon-trash"></span>  Excluir
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>




