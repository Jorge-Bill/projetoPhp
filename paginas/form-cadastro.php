<?php
    require_once "header.php";
?>

    <form action="cadastrarPessoa" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nomePessoa">Email address</label>
            <input type="text" class="form-control" id="nomePessoa" placeholder="E-mail">
        </div>
        <div class="form-group">
            <label for="emailPessoa">Email address</label>
            <input type="email" class="form-control" id="emailPessoa" placeholder="E-mail">
        </div>
        <div class="form-group">
            <label for="senhaPessoa">Senha</label>
            <input type="password" class="form-control" id="senhaPessoa" placeholder="Senha">
        </div>
        <div class="form-group">
            <label for="imagemPessoa">Foto</label>
            <input type="file" name="imagemPessoa" id="imagemPessoa">
            <p class="help-block">Faça upload de uma imagem</p>
        </div>
        <div class="form-group">
            <label>Perfil</label>
            <select class="form-control" id="perfilPessoa">
                <option>Admin</option>
                <option>Basico</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default">Cadastrar</button>
    </form>

<?php
    require_once "footer.php";
?>