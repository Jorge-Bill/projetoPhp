<?php

$i = 1;
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

$detalhesPessoa=$pdo->query("SELECT * FROM pessoa");

$count = $detalhesPessoa->rowCount();

$calculete = ceil(($count/100)*10);

if (isset($_GET['page']) == $i){
    $url = $_GET['page'];
    $mody = $url*10;
    $detalhesPessoa=$pdo->query("SELECT * FROM pessoa LIMIT 10 OFFSET $mody ");
}

$detalhesPessoa->execute();
$detalhesPessoa = $detalhesPessoa->fetchAll(PDO::FETCH_OBJ);
