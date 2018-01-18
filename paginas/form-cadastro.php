<script src="/js/jquery.validate.min.js"></script>
<div class="col-md-7 col-md-offset-2 col-xs-12">
    <h1 class="text-center">Cadastrar</h1>
    <form id="cadastroPessoa">
        <div class="form-group">
            <label for="nomePessoa">Nome* </label>
            <input type="text" class="form-control valid" id="nomePessoa" name="nomePessoa" placeholder="Nome" minlength="2" required>
        </div>
        <div class="form-group">
            <label for="emailPessoa">E-mail*</label>
            <input type="email" class="form-control valid" id="emailPessoa" name="emailPessoa" placeholder="E-mail" required>
        </div>
        <div class="form-group">
            <label for="senhaPessoa">Senha*</label>
            <input type="password" class="form-control valid" id="senhaPessoa" name="senhaPessoa" placeholder="Senha" minlength="5" required>
        </div>
        <div class="form-group">
            <label for="imagemPessoa">Foto</label>
            <input type="file" name="imagemPessoa" id="imagemPessoa" required>
            <p class="help-block">Faça upload de uma imagem</p>
        </div>
        <div class="form-group col-md-4">
            <label>Perfil*</label>
            <select class="form-control" id="perfilPessoa" name="perfilPessoa">
                <option>Admin</option>
                <option>Basico</option>
            </select>
        </div>
        <div id="msg"></div>
        <div class="clearfix"></div>
        <div class="pull-right">
            <a class="btn btn-default" href="/navegacao.php?page=listaUsuarios&pagination=1"> Cancelar</a>
            <button type="button" value="Submit" class="btn btn-primary" id="cadastrar">Cadastrar</button>
        </div>
    </form>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="cadastroModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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

    $(document).ready(function(){
        let form;
        $('#imagemPessoa').change(function (event) {
            form = new FormData();
            form.append('foto', event.target.files[0]);
        });
        $("#cadastroPessoa").validate();
        $("#cadastrar").click(() => {
            let nome    = $('#nomePessoa').val();
            let email   = $('#emailPessoa').val();
            let senha   = $('#senhaPessoa').val();
            let foto    = $('#imagemPessoa').val();
            let perfil  = $('#perfilPessoa').val();

            if( nome && email && senha && perfil && foto) {

                form.append('nome',   nome);
                form.append('email',  email);
                form.append('senha',  senha);
                form.append('foto',   foto);
                form.append('perfil', perfil);

                $.ajax({
                    method: "POST",
                    processData: false,
                    contentType: false,
                    url: "/Requests/cadastrarPessoa.php",
                    data: form
                })
                .then(
                    function success(data) {
                        if(data.status !== 200) {
                            $('#cadastroModal').modal('show');
                            $("#confirmacao").text("Erro! e-mail ja cadastrado");
                        } else {
                            $('#cadastroModal').modal('show');
                            $("#confirmacao").text("Pessoa cadastrada com sucesso");
                            setInterval(function() { window.location = "/navegacao.php?page=listaUsuarios&pagination=1" }, 2000);
                        }
                    }
                );
            }
            else {
                $('#cadastroModal').modal('show');
                $("#confirmacao").text("Erro! Preencha os campos");
            }
        });
    });
</script>