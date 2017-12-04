<?php
//require_once "../navegacao.php";
require_once "conecta.php";
require_once "header.php";
?>

    <div class="col-md-7 col-md-offset-2 col-xs-12">
        <form method="POST" action="cadastrarPessoa.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nomePessoa">Nome</label>
                <input type="text" class="form-control" id="nomePessoa" name="nomePessoa" placeholder="Nome">
            </div>
            <div class="form-group">
                <label for="emailPessoa">E-mail</label>
                <input type="email" class="form-control" id="emailPessoa" name="emailPessoa" placeholder="E-mail">
            </div>
            <div class="form-group">
                <label for="senhaPessoa">Senha</label>
                <input type="password" class="form-control" id="senhaPessoa" name="senhaPessoa" placeholder="Senha">
            </div>
            <div class="form-group">
                <label for="imagemPessoa">Foto</label>
                <input type="file" name="imagemPessoa" id="imagemPessoa">
                <p class="help-block">Faça upload de uma imagem</p>
            </div>
            <div class="form-group col-md-4">
                <label>Perfil</label>
                <select class="form-control" id="perfilPessoa" name="perfilPessoa">
                    <option>Admin</option>
                    <option>Basico</option>
                </select>
            </div>
            <div class="clearfix"></div>
            <button type="submit" class="btn btn-primary pull-right">Cadastrar</button>
        </form>
    </div>

<?php
    require_once "footer.php";
?>