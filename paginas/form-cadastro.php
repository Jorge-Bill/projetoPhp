<script src="/js/jquery.validate.min.js"></script>
<div class="col-md-7 col-md-offset-2 col-xs-12">
    <h1 class="text-center">Cadastrar</h1>
    <form id="cadastroPessoa">
        <div class="form-group">
            <label for="nomePessoa">Nome* </label>
            <input type="text" class="form-control valid" id="nomePessoa" name="nomePessoa" placeholder="Nome" minlength="2" required="" aria-required="true" aria-invalid="false" >
        </div>
        <div class="form-group">
            <label for="emailPessoa">E-mail*</label>
            <input type="email" class="form-control valid" id="emailPessoa" name="emailPessoa" placeholder="E-mail" required="" aria-required="true" aria-invalid="false">
        </div>
        <div class="form-group">
            <label for="senhaPessoa">Senha*</label>
            <input type="password" class="form-control valid" id="senhaPessoa" name="senhaPessoa" placeholder="Senha" minlength="5" required="" aria-required="true" aria-invalid="false">
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
            <a class="btn btn-default" href="/navegacao.php?page=listaUsuarios"> Cancelar</a>
            <button type="button" class="btn btn-primary" id="cadastrar">Cadastrar</button>
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
        $("#cadastroPessoa").validate();
        $("#cadastrar").click(() => {
            let nome    = $('#nomePessoa').val();
            let email   = $('#emailPessoa').val();
            let senha   = $('#senhaPessoa').val();
            let foto    = $('#imagemPessoa').val();
            let perfil  = $('#perfilPessoa').val();

            if( nome && email && senha && perfil && foto) {

                form.append('nome', nome);
                form.append('email', email);
                form.append('senha', senha);
                form.append('foto', foto);
                form.append('perfil', perfil);

                $.ajax({
                    method: "POST",
                    processData: false,
                    contentType: false,
                    url: "/navegacao.php?page=cadastrarPessoa",
                    data: form
                })
                .then(
                    function success(data) {
                        // console.log(`${data.message}`);
                        // window.location = "/navegacao.php?page=listaUsuarios";
                    },
                    function fail(data) {
                        // console.log(`${data.message}`);
                    }
                );
            }
            // else {
            //     alert('Erro! preencha os campos');
            // }
        });
    });
</script>