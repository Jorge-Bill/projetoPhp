<?php if (array_key_exists('usuario',$_SESSION)): ?>
    <div class="clearfix"></div>
    <strong><p class="" id="valor"></p></strong>

    <?php
    $tempo_atual = @mktime(date("Y/m/d H:i:s"));
    $tempo_permitido = 1000; // tempo em segundos até redirecionar
    $fim = "";
    if(@$_SESSION['Cookie_countdown']=="") {
        $tempo_entrada = @mktime(date("Y/m/d H:i:s"));
        $tempo_cookie = '300'; // em segundos
        $_SESSION['Cookie_countdown'] = $tempo_entrada;
    } else {
        $tempo_gravado = $_SESSION['Cookie_countdown'];
        $tempo_gerado = $tempo_atual-$tempo_gravado;
        $fim.= $tempo_permitido-$tempo_gerado;
        if($fim <= 0) {
            echo "tempo esgotado";
            $_SESSION['Cookie_countdown'] = "";
            isset($_SESSION['logado']);
            session_destroy();
        }
    }
    ?>
        <script>
            let contador = '<?php if($fim=="") { echo $tempo_permitido+1; } else { echo "$fim"; } ?>';
            function Conta() {
                if(contador <= 0) {
                    location.href='/navegacao.php';
                }
                contador = contador-1;
                setTimeout("Conta()", 1000);
                document.getElementById("valor").innerHTML = "Você tem, " + contador + " segundos até o logout";
            }
            window.onload = function() {
                Conta();
            }
        </script>
    <?php endif; ?>

            </div>
        </div>

        <footer class="jumbotron">
            <h6 class="text-center">Registration System - <?php echo date('Y'); ?> &copy;</h6>
        </footer>
        <script src="/public/resources/js/bootstrap.js"></script>
    </body>
</html>