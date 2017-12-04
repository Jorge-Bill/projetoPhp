<?php
require_once "conecta.php";

$id  = $_REQUEST['id'];

$pdo = conectar();

$deletarPessoa = $pdo->prepare('DELETE FROM pessoa WHERE id = :id');

$deletarPessoa->bindParam(":id", $id);

if ($deletarPessoa->execute()){
    header('Location: listaUsuarios.php');
}

else{
    echo "Erro ao deletar";
    print_r($deletarPessoa->errorInfo());
}
