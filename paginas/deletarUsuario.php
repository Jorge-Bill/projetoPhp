<?php

$id  = $_REQUEST['id'];

$pdo = conectar();

$deletarPessoa = $pdo->prepare('DELETE FROM pessoa WHERE id = :id');

$deletarPessoa->bindParam(":id", $id);

if ($deletarPessoa->execute()){
    header('Location: /navegacao.php?page=listaUsuarios');
}

else{
    echo "Erro ao deletar";
    print_r($deletarPessoa->errorInfo());
}
