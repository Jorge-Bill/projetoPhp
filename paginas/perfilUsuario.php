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

    <div class="col-md-7 col-md-offset-2 col-xs-12">
        <h1 class="text-center">Perfil</h1>
        <div class="modal-dialog modal-sm-12" >
            <table class="table table-condensed text-center">
                <tr>
                    <td><strong>Nome:</strong></td>
                    <td><strong>Email:</strong></td>
                    <td><strong>Perfil:</strong></td>
                </tr>

                <tr>
                    <td><?php echo $editarPessoa['nome']?></td>
                    <td><?php echo $editarPessoa['email']?></td>
                    <td><?php echo $editarPessoa['perfil']?></td>
                </tr>
            </table>
        </div>
    </div>
            <!--            <strong>Nome:</strong>-->
            <!--            <p>-->
            <!--                --><?php //echo $editarPessoa['nome']?>
            <!--            </p>-->
            <!--            <strong>Email:</strong>-->
            <!--            <p>-->
            <!--                --><?php //echo $editarPessoa['email']?>
            <!--            </p>-->
            <!--            <strong>Perfil:</strong>-->
            <!--            <p>-->
            <!--                --><?php //echo $editarPessoa['perfil']?>
            <!--            </p>-->
            <!---->
            <!--            <p>-->
            <!--                --><?php //echo $editarPessoa['foto']?>
            <!--            </p>-->


<?php
require_once "footer.php";
?>