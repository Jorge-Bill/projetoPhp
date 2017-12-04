<?php
//session_start();

require_once "navegacao.php";
require_once "paginas/header.php";
//se passar da session ira direto para pagina dashboard
if($_SESSION) {
    if(array_key_exists('logado', $_SESSION)) {
        header("Location: /paginas/dashboard.php");
    }
}

?>

<h1>Tela de Login</h1>
<div class="container-fluid centered" >
    <div class="container">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Usuário</label>

                <div class="col-sm-2">
                    <input class="form-control" id="email" name="email" placeholder="Digite seu usuário">
                </div>
            </div>
            <div class="form-group">
                <label for="senha" class="col-sm-2 control-label">Senha</label>
                <div class="col-sm-2">
                    <input type="password" maxlength="6" class="form-control" id="senha" name="senha" placeholder="Digite sua senha">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-2">
                    <h6>Escolha o perfil de usuario</h6>
                    <div class="checkbox">
                        <select class="form-horizontal" id="perfil">
                            <option value="volvo">Admin</option>
                            <option value="usu">basico</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-2">
                    <button type="button" class="btn btn-default" id="login">Entrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once "paginas/footer.php"; ?>

<script>
    $(document).ready(function(){

        $("#login").click(() => {
            let email = $('#email').val();// let é uma variavel, só funciona com o javascript 'novo'
            let senha = $('#senha').val();// let é uma variavel, só funciona com o javascript 'novo'

            if( email !== "" && senha !== "" ) {
                $.ajax({
                    method: "POST",
                    url: "login_session.php",
                    data: { email: email, senha: senha }
                }).done(function( data ) {
                    if(data.status !== 200 ) {//200 tudo deu certo
                        alert(`${data.message}`);
                    } else {
                        alert(`Seja bem vindo ao sistema do Ganço e do Wiliiam`);
                        window.location = "paginas/dashboard.php";
                    }
                });
            } else {
                console.error('BLA');
            }
        });
    });
</script>
</body>
</html>