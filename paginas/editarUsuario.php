<?php
require_once "conecta.php";

$id         = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : '';
$nome       = (isset($_REQUEST['nomePessoa'])) ? $_REQUEST['nomePessoa'] : '';
$perfil     = (isset($_REQUEST['perfilPessoa'])) ? $_REQUEST['perfilPessoa'] : '';
$senha      = (isset($_REQUEST['senhaPessoa'])) ? $_REQUEST['senhaPessoa'] : '';
$email      = (isset($_REQUEST['emailPessoa'])) ? $_REQUEST['emailPessoa'] : '';
$foto       = (isset($_FILES['imagemPessoa'])) && $_FILES['imagemPessoa']['size'] ? $_FILES['imagemPessoa'] : '';

var_dump($id);
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

$sql = "UPDATE pessoa SET nome=:nome, foto=:foto, perfil=:perfil, senha=:senha, email=:email WHERE id=:id;";

$updatePessoa = $pdo->prepare($sql);

$updatePessoa->bindParam(":id", $id);
$updatePessoa->bindParam(":nome", $nome);
$updatePessoa->bindParam(":foto", $nomeFoto);
$updatePessoa->bindParam(":perfil", $perfil);
$updatePessoa->bindParam(":senha", $senha);
$updatePessoa->bindParam(":email", $email);


if ($updatePessoa->execute()){
    header('Location: listaUsuarios.php');
    }
 else{
        echo "Erro ao editar";
        print_r($updatePessoa->errorInfo());
 }
