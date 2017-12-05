<?php
//print_r($_SESSION);
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
    <h1 class="text-center">Editar</h1>
    <form method="POST" action="/navegacao.php?page=editarUsuario" enctype="multipart/form-data">
        <div class="form-group">
<!--            <label for="id">Id</label>-->
            <input class="form-control" type='hidden' name='id' value="<?php echo $editarPessoa['id']?>">
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

        <?php
            if (!empty($editarPessoa['foto'])): ?>
                <div class="form-group">
                    <img class="thumbnail" src="/../imagens/<?php echo $editarPessoa['foto']; ?>" width="500" height="auto" alt="">
                </div>       
        <?php
            else :
                print_r("Que tal adicionar uma foto?");
            endif;

        ?>
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
<<<<<<< HEAD
            <a class="btn btn-default" href="listaUsuarios.php"> Cancelar</a>
            <button type="submit" class="btn btn-primary"> Salvar</button>
=======
            <a class="btn btn-default" href="/navegacao.php?page=listaUsuarios"> Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
>>>>>>> 851915a43640eaf8a77c7ecb1eb3dd9cdd564e77
        </div>
    </form>
</div>
