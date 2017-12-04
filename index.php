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

<h1 class="text-center">Login</h1>
<hr>
<div class="container-fluid centered" >
    <div class="container col-md-6 col-md-offset-3 col-xs-12">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="email" class=" control-label">Usuário</label>

                <div class="">
                    <input class="form-control" id="email" name="email" placeholder="Digite seu usuário " required>
                </div>
            </div>
            <div class="form-group">
                <label for="senha" class=" control-label">Senha</label>
                <div class="">
                    <input type="password" maxlength="6" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>
            </div>
            <div class="form-group">
                <div class="">
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
                <div class="">
                    <button type="button" class="btn btn-primary pull-right" id="login">Entrar</button>
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