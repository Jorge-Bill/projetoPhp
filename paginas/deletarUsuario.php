<?php

$pessoa = (object)[
    'id'      => $_GET['id'],
];

$pdo = conectar();

$deletarPessoa = $pdo->prepare('DELETE FROM pessoa WHERE id = :id');

$deletarPessoa->bindParam(":id", $pessoa->id);

if ($deletarPessoa->execute()){
    header('Location: /navegacao.php?page=listaUsuarios&pagination=1');
}

else{
    echo "Erro ao deletar";
    print_r($deletarPessoa->errorInfo());
}
