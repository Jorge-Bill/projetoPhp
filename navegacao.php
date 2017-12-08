<?php

require_once "paginas/conecta.php";

session_start();

require_once "paginas/header.php";

if($_REQUEST && array_key_exists('logado', $_SESSION)) {
    $page = $_REQUEST['page'];

    if(array_key_exists('page', $_REQUEST)) {

        $path = __DIR__ . '/paginas/' . $page. '.php';

        if(file_exists($path)) {
            require_once $path;
        } else {

            die('Página não existe!');

        }
    } else {

        die('404 página não encontrada!');

    }
} else {
    require_once __DIR__ . '/index.php';
}

require_once "paginas/footer.php";