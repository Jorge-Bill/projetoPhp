<?php
    if(isset($_SESSION['logado'])){
        session_destroy();
    }

    header("location: /index.php");
?>
