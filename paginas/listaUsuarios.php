
<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="text-center">Lista de usuários</h1>
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
            <?php foreach ($detalhesPessoa as $pessoa) {
            ?>
                <tr>
                    <td><?=$pessoa->id;?></td>
                    <td><?=ucfirst(strtolower($pessoa->nome));?></td> //ucfirst(strtolower pra deixar a primeira letra em miusculo e o restante em minusculo
                    <td><?=ucfirst(strtolower($pessoa->email));?></td>
                    <td><?=ucfirst(strtolower($pessoa->perfil));?></td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="#">
                            Editar
                        </a>
                        |
                        <a class="btn btn-sm btn-danger" href="#">
                            Excluir
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>