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
    <form>
        <div class="form-group">
            <!--            <label for="id">Id</label>-->
            <input class="form-control" type='hidden' name='idPessoa' id="idPessoa" value="<?php echo $editarPessoa['id']?>">
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

            <a class="btn btn-default" href="/navegacao.php?page=listaUsuarios"> Cancelar</a>
            <button type="button" id="editar" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>

<script>

    $(document).ready(function(){
        let form;
        $('#imagemPessoa').change(function (event) {
            form = new FormData();
            form.append('foto', event.target.files[0]);
        });

        $("#editar").click(() => {
            let id      = $('#idPessoa').val();
            let nome    = $('#nomePessoa').val();
            let email   = $('#emailPessoa').val();
            let senha   = $('#senhaPessoa').val();
            let foto    = $('#imagemPessoa').val();
            let perfil  = $('#perfilPessoa').val();

            if(nome && email && senha && perfil && foto) {
                form.append('id', id);
                form.append('nome', nome);
                form.append('email', email);
                form.append('senha', senha);
                form.append('foto', foto);
                form.append('perfil', perfil);

                $.ajax({
                    method: "POST",
                    processData: false,
                    contentType: false,
                    url: "/navegacao.php?page=editarUsuario",
                    data: form
                }).then(
                        function success(data) {
                            window.location = "/navegacao.php?page=listaUsuarios";
                        },

                        function fail(data) {
                            alert(`${data.message}`);
                        }
                    );
            }
            else {
                alert('Erro! preencha os campos');
            }
        });
    });

</script>

