<?php
$id = $_GET['id'];

$pdo = conectar();

$editarPessoa = $pdo->prepare('SELECT * FROM pessoa WHERE id = :id');

$editarPessoa->bindParam(":id", $id);


if ($editarPessoa->execute()) {
    $editarPessoa = $editarPessoa->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Erro ao cadastrar";
    print_r($editarPessoa->errorInfo());
}

?>
<script src="resources/js/jquery.validate.min.js"></script>

<div class="col-md-7 col-md-offset-2 col-xs-12">
    <h1 class="text-center">Editar</h1>
    <form id="formEditar">
        <div class="form-group">
            <!--            <label for="id">Id</label>-->
            <input class="form-control" type='hidden' name='idPessoa' id="idPessoa"
                   value="<?php echo $editarPessoa['id'] ?>">
        </div>
        <div class="form-group">
            <label for="nomePessoa">Nome</label>
            <input type="text" value="<?php echo $editarPessoa['nome'] ?>" class="form-control valid" id="nomePessoa"
                   name="nomePessoa" placeholder="Nome" minlength="2" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" required>
        </div>
        <div class="form-group">
            <label for="emailPessoa">E-mail</label>
            <input type="email" value="<?php echo $editarPessoa['email'] ?>" class="form-control valid" id="emailPessoa"
                   name="emailPessoa" placeholder="E-mail" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" required>
        </div>
        <div class="form-group">
            <label for="senhaPessoa">Senha</label>
            <input type="text" value="<?php echo $editarPessoa['senha'] ?>" class="form-control valid" id="senhaPessoa"
                   name="senhaPessoa" placeholder="Senha" minlength="5" pattern="[A-Za-z0-9]+" required>
        </div>

        <div class="form-group">
            <img id="imgPrevia" class="thumbnail" src="/../imagens/<?php echo $editarPessoa['foto']; ?>" width="500"
                 height="auto" alt="">
        </div>

        <div class="form-group">
            <label for="imagemPessoa">Foto</label>
            <input type="file" name="imagemPessoa" id="imagemPessoa">
            <p class="help-block">Faça upload de uma imagem</p>
        </div>

        <div class="form-group col-md-4">
            <label>Perfil</label>
            <select value="<?php echo $editarPessoa['perfil'] ?>" class="form-control" id="perfilPessoa"
                    name="perfilPessoa">
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


<div class="modal fade" tabindex="-1" role="dialog" id="editarModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Mensagem</h4>
            </div>
            <div class="modal-body">
                <p id="confirmacao"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>

    $(document).ready(function () {

        let form = new FormData();

        $("#imagemPessoa").change(function () {
            if (this.files && this.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgPrevia').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#imagemPessoa').change(function (event) {
            form.append('foto', event.target.files[0]);
        });

        $("#formEditar").validate();
        $("#editar").click(() => {
            let img = $("#imgPrevia").attr("src");
            let id = $('#idPessoa').val();
            let nome = $('#nomePessoa').val();
            let email = $('#emailPessoa').val();
            let senha = $('#senhaPessoa').val();
            let foto = $('#imagemPessoa').val();
            let perfil = $('#perfilPessoa').val();

            form.append('id', id);
            form.append('nome', nome);
            form.append('email', email);
            form.append('senha', senha);
            form.append('perfil', perfil);
            form.append('foto', foto);

            $.ajax({
                method: "POST",
                processData: false,
                contentType: false,
                url: "modules/crud/requests/editarUsuario.php",
                data: form
            })
                .then(
                    function success(data) {
                        if (data.status !== 200) {
                            $('#editarModal').modal('show');
                            $("#confirmacao").text("Erro!");
                        } else {
                            $('#editarModal').modal('show');
                            $("#confirmacao").text("Registro editado com sucesso");
                            setInterval(function() { window.location = "/navegacao.php" }, 2000);
                        }
                    }
                );

        });
    });

</script>

