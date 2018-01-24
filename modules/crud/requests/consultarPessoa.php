<?php

$pdo = conectar();

$pagina = array_key_exists('pagination', $_GET) ?  $_GET["pagination"] : 1;

$totalpg        = 6;
$offset         = ($pagina - 1) * $totalpg;

$detalhesPessoa = $pdo->prepare("SELECT 
    pessoa.id       AS id,
    pessoa.nome     AS nome,
    pessoa.foto     AS foto,
    pessoa.perfil   AS perfil,
    pessoa.senha    AS senha,
    pessoa.email    AS email
    
    FROM pessoa limit $totalpg offset $offset
    ");
$detalhesPessoa->execute();
$detalhesPessoa = $detalhesPessoa->fetchAll(PDO::FETCH_OBJ);


$dados =  $pdo->prepare("SELECT 
    pessoa.id       AS id,
    pessoa.nome     AS nome,
    pessoa.foto     AS foto,
    pessoa.perfil   AS perfil,
    pessoa.senha    AS senha,
    pessoa.email    AS email
    
    FROM pessoa");

$dados->execute();

$totalRegistro  = $dados->rowCount();

$totalPaginas   = ceil($totalRegistro/$totalpg);

//for($i = 1; $i <= $totalPaginas; $i++) {
//    echo $i;
//}

