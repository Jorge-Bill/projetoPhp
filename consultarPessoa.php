<?php

$detalhesPessoa = $pdo -> prepare("SELECT 
    pessoa.id       AS id,
    pessoa.nome     AS nome,
    pessoa.foto     AS foto,
    pessoa.perfil   AS perfil,
    pessoa.senha    AS senha,
    pessoa.email    AS email
    
    FROM pessoa
    ");

$detalhesPessoa -> execute();
//$detalhesPessoa ->
