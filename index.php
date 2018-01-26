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

<script src="resources/js/jquery.validate.min.js"></script>

<div class="container login col-md-4 col-md-offset-4 col-xs-12 thumbnail">
    <h1 class="text-center">Login <span class="glyphicon glyphicon-flash"></span></h1>
    <hr>
    <form id="loginForm">
        <div class="form-group col-xs-12 col-md-6">
            <label for="email" class=" control-label">E-mail</label>
            <input class="form-control valid" type="email" id="email" name="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" autofocus placeholder="Digite seu e-mail" required>
        </div>
        <div class="form-group col-xs-12 col-md-6">
            <label for="senha" class=" control-label">Senha</label>
            <input pattern="[A-Za-z0-9]+" class="form-control valid" type="password" minlength="5" id="senha" name="senha" placeholder="Digite sua senha" required>
        </div>
        <div class="form-group col-xs-12 col-md-12">

            <script>
                $(document).keypress(function(e) {
                    if(e.which == 13) $('#login').click();
                });

                $('button').click(function(e) {
                    alert(this.innerHTML);
                });
            </script>

            <button type="button" class="btn btn-info btn-lg btn-block " id="login">Entrar</span></button>
        </div>
    </form>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="loginModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mensagem</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-center" id="confirmacao"></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <script>
        $(document).ready(function(){

            $("#loginForm").validate();

            $("#login").click(() => {
                let email = $('#email').val();
                let senha = $('#senha').val();

                if( email !== "" && senha !== "" ) {
                    $.ajax({
                        method: "POST",
                        url: "modules/login/login_session.php",
                        data: { email: email, senha: senha }
                    }).done(function( data ) {
                        if(data.status !== 200 ) {
                            // alert(`${data.message}`);
                            $('#loginModal').modal('show');
                            $("#confirmacao").text(data.message);
                        } else {
                            $('#loginModal').modal('show');
                            $("#confirmacao").text("Bem vindo");
                            setInterval(function() { window.location = "/navegacao.php" }, 2000);
                        }
                    });
                } else {
                    $('#loginModal').modal('show');
                    $("#confirmacao").text('Preencha os campos para realizar o login');
                }
            });
        });
    </script>
