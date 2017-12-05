<?php
require_once "conecta.php";
require_once "header.php";
//require_once "editarUsuario.php";

$id = $_REQUEST['id'];

$pdo = conectar();

$editarPessoa = $pdo->prepare('SELECT * FROM pessoa WHERE id = :id');

$editarPessoa->bindParam(":id", $id);

if ($editarPessoa->execute()){
    $editarPessoa = $editarPessoa->fetch(PDO::FETCH_ASSOC);
}
else{
    echo "Erro ao cadastrar";
    print_r($editarPessoa->errorInfo());
}
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="text-center">Perfil</h1>
            <div class="container">
                <div class="col-md-7 col-md-offset-2 col-xs-12 text-center">
                    <div class="modal-dialog modal-sm-12">
                        <table class="table table-striped">
                            <tr>
                                <td class="danger"><strong>Nome:</strong></td>
                                <td class="danger"><strong>Email:</strong></td>
                                <td class="danger"><strong>Perfil:</strong></td>
                            </tr>

                            <tr>
                                <td><?php echo $editarPessoa['nome']?></td>
                                <td><?php echo $editarPessoa['email']?></td>
                                <td><?php echo $editarPessoa['perfil']?></td>
                            </tr>
                        </table>
                        <div class="pull-right">
                            <a class="btn btn-success" href="listaUsuarios.php"> Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once "footer.php";
?>