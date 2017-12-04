<?php

require_once "paginas/conecta.php";

header('Content-Type: application/json');

//session_start();

require_once "navegacao.php";

$msg = ['results' => [
    'currect' => [
        'status' => 200
    ],
    'error' => [
        'message' => 'Usuário ou senha inválidos!',
        'status' => 500
    ]
]];

if ($_POST) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $pdo = conectar();

    $loginPessoa = $pdo->prepare("SELECT * FROM pessoa WHERE email = :email AND senha = :senha");


    $loginPessoa->bindParam(":email", $email, PDO::PARAM_STR);
    $loginPessoa->bindParam(":senha", $senha, PDO::PARAM_STR);

    $loginPessoa->execute();

    $login = $loginPessoa->fetch(PDO::FETCH_ASSOC);

    if ($login) {

        $_SESSION['email'] = $email;
        $_SESSION['logado'] = true;

        echo json_encode($msg['results']['currect']);

    } else {

        session_destroy();

        echo json_encode($msg['results']['error']);
    }
}
