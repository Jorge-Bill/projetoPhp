<?php
require_once "conecta.php";
require_once "header.php";
//require_once "editarUsuario.php";

$id = $_GET['id'];

$pdo = conectar();

$exibirPessoa = $pdo->prepare('SELECT * FROM pessoa WHERE id = :id');

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
        <h1 class="text-center">Editar</h1>
        <form method="POST" action="editarUsuario.php">
            <div class="form-group">
                <label for="id">Id</label>
                <input class="form-control" type='number' name='id' value="<?php echo $editarPessoa['id']?>" disabled>
            </div>
            <div class="form-group">
                <label for="nomePessoa">Nome</label>
                <input type="text" value="<?php echo $editarPessoa['nome']?>" class="form-control" id="nomePessoa" name="nomePessoa" placeholder="Nome" required >
            </div>
            <div class="form-group">
                <label for="emailPessoa">E-mail</label>
                <input type="email" value="<?php echo $editarPessoa['email']?>" class="form-control" id="emailPessoa" name="emailPessoa" placeholder="E-mail" required>
            </div>
            <div class="form-group">
                <label for="senhaPessoa">Senha</label>
                <input type="text" value="<?php echo $editarPessoa['senha']?>" class="form-control" id="senhaPessoa" name="senhaPessoa" placeholder="Senha" required>
            </div>
            <div class="form-group">
                <label for="imagemPessoa">Foto</label>
                <input type="file" name="imagemPessoa" id="imagemPessoa">
                <p class="help-block">Faça upload de uma imagem</p>
            </div>
            <div class="form-group col-md-4">
                <label>Perfil</label>
                <select value="<?php echo $editarPessoa['perfil']?>" class="form-control" id="perfilPessoa" name="perfilPessoa">
                    <option>Admin</option>
                    <option>Basico</option>
                </select>
            </div>
            <div class="clearfix"></div>
            <div class="pull-right">
                <a class="btn btn-default" href="listaUsuarios.php"> Cancelar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>

<?php
require_once "footer.php";
?>