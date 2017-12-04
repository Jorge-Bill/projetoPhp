<?php

require_once "../navegacao.php";
require_once "conecta.php";

$nome       = (isset($_REQUEST['nomePessoa'])) ? $_REQUEST['nomePessoa'] : '';
$email      = (isset($_REQUEST['emailPessoa'])) ? $_REQUEST['emailPessoa'] : '';
$senha      = (isset($_REQUEST['senhaPessoa'])) ? $_REQUEST['senhaPessoa'] : '';
$perfil     = (isset($_REQUEST['perfilPessoa'])) ? $_REQUEST['perfilPessoa'] : '';
$foto       = (isset($_FILES['imagemPessoa'])) && $_FILES['imagemPessoa']['size'] ? $_FILES['imagemPessoa'] : '';


var_dump($nome);
var_dump($email);
var_dump($senha);
var_dump($perfil);
var_dump($foto);

if (!empty($foto)){

    $nomeFoto   = $foto['name'];
    $tipo       = $foto['type'];
    $tamanho    = $foto['size'];
    $destino    = '../imagens/';

    var_dump($foto);
    var_dump($nomeFoto);
    var_dump($tipo);
    var_dump($tamanho);
    var_dump($destino);



    $uploadfile = $destino . basename($_FILES['imagemPessoa']['name']);

    if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo))
    {
        print_r ('Isso não é uma imagem válida');
        exit;
    }

    if(!file_exists($destino)):
        mkdir($destino);
    endif;


    if (!move_uploaded_file($_FILES['imagemPessoa']['tmp_name'], $uploadfile)):
        print_r( "Houve um erro ao gravar arquivo na pasta de destino!");
    endif;
}



$pdo = conectar();

$sql = ("INSERT INTO pessoa (nome, foto, perfil, senha, email) VALUES (:nome, :foto, :perfil, :senha, :email)");

$cadastrarPessoa = $pdo->prepare($sql);

$cadastrarPessoa->bindParam(":nome", $nome);
$cadastrarPessoa->bindParam(":foto", $nomeFoto);
$cadastrarPessoa->bindParam(":perfil", $perfil);
$cadastrarPessoa->bindParam(":senha", $senha);
$cadastrarPessoa->bindParam(":email", $email);

if ($cadastrarPessoa->execute()){
    header('Location: listaUsuarios.php');
}
else{
    echo "Erro ao cadastrar";
    print_r($cadastrarPessoa->errorInfo());
}
