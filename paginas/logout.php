<?php
require_once "../navegacao.php";
if(isset($_SESSION['logado'])){
    session_destroy();
    header("Location: ../index.php");
}