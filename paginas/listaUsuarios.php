<?php
require_once "../navegacao.php";
require_once "conecta.php";
require_once "consultarPessoa.php";
require_once "header.php";
?>
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
            <a class="btn btn-primary" href="form-cadastro.php">
                <span class="glyphicon glyphicon-plus"></span> Criar Usuario
            </a>
            <?php foreach ($detalhesPessoa as $key => $pessoa): ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?=ucfirst(strtolower($pessoa->nome));?></td>
                    <td><?=ucfirst(strtolower($pessoa->email));?></td>
                    <td><?=ucfirst(strtolower($pessoa->perfil));?></td>
                    <td>
                        <a class="btn btn-sm btn-success" href="perfilUsuario.php?id=<?=$pessoa->id;?>">
                            <span class="glyphicon glyphicon-user"></span> Perfil
                        </a>
                        <a class="btn btn-sm btn-warning" href="editarForm.php?id=<?=$pessoa->id;?>">
                          <span class="glyphicon glyphicon-pencil"></span> Editar
                        </a>
                        <a class="btn btn-sm btn-danger" href="deletarUsuario.php?id=<?=$pessoa->id;?>">
                           <span class="glyphicon glyphicon-trash"></span>  Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once "footer.php"; ?>