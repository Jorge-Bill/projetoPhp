<?php

session_start();

if($_GET) {
    $page = $_GET['page'];

    if(array_key_exists('page', $_GET)) {

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
//    require_once __DIR__ . 'index.php';
}