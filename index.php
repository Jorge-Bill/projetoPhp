<?php

require_once "navegacao.php";
//se passar da session ira direto para pagina dashboard
if($_SESSION) {
    if(array_key_exists('logado', $_SESSION)) {
        header("Location:/navegacao.php?page=listaUsuarios");
    }
}

?>

<h1 class="text-center">Login <span class="glyphicon glyphicon-flash"></span></h1>
<div class="container-fluid centered" >
    <div class="container col-md-4 col-md-offset-4 col-xs-12">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="email" class=" control-label">Usuário</label>
                <div class="">
                    <input class="form-control" id="email" name="email" autofocus placeholder="Digite seu usuário " required>
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
                    <h5>Escolha o perfil de usuario</h5>
                    <div class="">
                        <select class="form-horizontal" id="perfil">
                            <option value="Admin">Admin</option>
                            <option value="basico">basico</option>
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
                    console.error('Preencha os campos para realizar o login');
                }
            });
        });
    </script>
