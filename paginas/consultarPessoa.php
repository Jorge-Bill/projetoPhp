<?php

$pdo = conectar();
$detalhesPessoa = $pdo->prepare("SELECT 
    pessoa.id       AS id,
    pessoa.nome     AS nome,
    pessoa.foto     AS foto,
    pessoa.perfil   AS perfil,
    pessoa.senha    AS senha,
    pessoa.email    AS email
    
    FROM pessoa LIMIT 10
    ");

$query_pessoa=$pdo->query("SELECT * FROM pessoa");
$count = $query_pessoa->rowCount();
$calculete = ceil(($count/100)*10);

if(isset($_GET['listaUsuarios']) == $i){
    $url = $_GET['listaUsuarios'];
    $mody = $url*10 - 10;
    $query_pessoa=$pdo->query("SELECT * FROM pessoa LIMIT 10 OFFSET $mody");
}

$detalhesPessoa->execute();
$detalhesPessoa = $detalhesPessoa->fetchAll(PDO::FETCH_OBJ);
