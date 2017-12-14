<?php

require_once "navegacao.php";
//se passar da session ira direto para pagina dashboard
if($_SESSION) {
    if(array_key_exists('logado', $_SESSION)) {
        header("Location:/navegacao.php?page=listaUsuarios");
    }
}

?>
<style>
    body{
        background-image: url("https://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-589330.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height:100%;
        background-attachment: fixed;
    }

    .login{
        box-shadow: 1px 1px 1px #dbdbdb;
        opacity: 0.9;
    }
</style>

    <div class="container login col-md-4 col-md-offset-4 col-xs-12 thumbnail">
        <h1 class="text-center">Login <span class="glyphicon glyphicon-flash"></span></h1>
        <hr>
        <form>
            <div class="form-group col-xs-12 col-md-6">
                <label for="email" class=" control-label">E-mail</label>
                <input class="form-control" id="email" name="email" autofocus placeholder="Digite seu usuário " required>
            </div>
            <div class="form-group col-xs-12 col-md-6">
                <label for="senha" class=" control-label">Senha</label>
                <input type="password" maxlength="6" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <div class="form-group col-xs-12 col-md-12">
                <button type="button" class="btn btn-primary btn-lg btn-block" id="login">Entrar</button>
            </div>
        </form>
    </div>


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
                            window.location = "/navegacao.php?page=listaUsuarios";
                        }
                    });
                } else {
                    alert('Preencha os campos para realizar o login');
                }
            });
        });
    </script>
