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
        <div class="modal-dialog modal-sm" >
            <p>Nome:</p>
            <p>
                <?php echo $editarPessoa['nome']?>
            </p>
            <p>Email:</p>
            <p>
                <?php echo $editarPessoa['email']?>
            </p>
            <p>Perfil</p>
            <p>
                <?php echo $editarPessoa['perfil']?>
            </p>

            <p>
                <?php echo $editarPessoa['foto']?>
            </p>
        </div>
    </div>

<?php
require_once "footer.php";
?>