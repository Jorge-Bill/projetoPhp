<?php

require_once "config/conecta.php";

session_start();

require_once "public/layout/header.php";

if($_GET && array_key_exists('logado', $_SESSION)) {

    $page = $_GET['page'];

    if(array_key_exists('page', $_GET)) {

        $path = __DIR__ . '/modules/crud/' . $page. '.php';

        if ($page == 'logout'){

            $path = __DIR__ . '/modules/login/' . $page. '.php';

        }

        if ($page == '' or $page = intval($page)){

            header("Location: index.php");

        }

        if(count($_GET) >= 3){

            header("Location: index.php");

        }

        if(file_exists($path)) {

            require_once $path;

        } else {

//            die('Página não existe!');
            header("Location: /navegacao.php?page=listaUsuarios");
        }
    } else {

//        die('404 página não encontrada!');
        header("Location: /navegacao.php?page=listaUsuarios");
    }
} else {

    require_once __DIR__ . '/index.php';

}

require_once "public/layout/footer.php";