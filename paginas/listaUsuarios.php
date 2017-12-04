<?php
require_once "../navegacao.php";
require_once "conecta.php";
require_once "consultarPessoa.php";
require_once "header.php";
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="text-center">Lista de usuários</h1>
        <a class="btn btn-primary" href="form-cadastro.php">
            Criar Usuario
        </a>
    </div>
    <div class="panel-body">
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
            <?php foreach ($detalhesPessoa as $pessoa): ?>
                <tr>
                    <td><?=$pessoa->id;?></td>
                    <td><?=ucfirst(strtolower($pessoa->nome));?></td>
                    <td><?=ucfirst(strtolower($pessoa->email));?></td>
                    <td><?=ucfirst(strtolower($pessoa->perfil));?></td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="perfilUsuario.php?id=<?=$pessoa->id;?>">
                            Perfil
                        </a>
                        |
                        <a class="btn btn-sm btn-warning" href="editarForm.php?id=<?=$pessoa->id;?>">
                            Editar
                        </a>
                        |
                        <a class="btn btn-sm btn-danger" href="deletarUsuario.php?id=<?=$pessoa->id;?>">
                            Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once "footer.php"; ?>