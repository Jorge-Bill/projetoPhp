<?php
require_once "conecta.php";

$id         = $_REQUEST['id'];
$nome       = (isset($_REQUEST['nomePessoa'])) ? $_REQUEST['nomePessoa'] : '';
$perfil     = (isset($_REQUEST['perfilPessoa'])) ? $_REQUEST['perfilPessoa'] : '';
$senha      = (isset($_REQUEST['senhaPessoa'])) ? $_REQUEST['senhaPessoa'] : '';
$email      = (isset($_REQUEST['emailPessoa'])) ? $_REQUEST['emailPessoa'] : '';

$pdo = conectar();

$sql = "UPDATE pessoa SET nome=:nome, perfil=:perfil, senha=:senha, email=:email WHERE id=:id;";

$updatePessoa = $pdo->prepare($sql);

$updatePessoa->bindParam(":id", $id);
$updatePessoa->bindParam(":nome", $nome);
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
