<?php

$msg = ['results' => [
    'currect' => [
        'status' => 200
    ],
    'error' => [
        'message' => 'Erro ao cadastrar!',
        'status' => 500
    ]
]];

    if ($_POST) {

        $pessoa = (object)[
            'nome'      => $_POST['nome'],
            'email'     => $_POST['email'],
            'senha'     => $_POST['senha'],
            'perfil'    => $_POST['perfil'],
            'foto'      => $_FILES['foto']
        ];

        $destino = 'imagens/';

        $uploadfile = $destino . basename($pessoa->foto['name']);

        if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $pessoa->foto['type'])){
            print_r ('Isso não é uma imagem válida');
            exit;
        }

        if(!file_exists($destino)) {
            mkdir($destino);
        }

        if (!move_uploaded_file($pessoa->foto['tmp_name'], $uploadfile)) {
            print_r("Houve um erro ao gravar arquivo na pasta de destino!");
        }

        $pdo = conectar();

        $sql = ("INSERT INTO pessoa (nome, foto, perfil, senha, email) VALUES (:nome, :foto, :perfil, :senha, :email)");

        $cadastrarPessoa = $pdo->prepare($sql);

        $cadastrarPessoa->bindParam(":nome", $pessoa->nome);
        $cadastrarPessoa->bindParam(":foto", $pessoa->foto['name']);
        $cadastrarPessoa->bindParam(":perfil", $pessoa->perfil);
        $cadastrarPessoa->bindParam(":senha", $pessoa->senha);
        $cadastrarPessoa->bindParam(":email", $pessoa->email);

        if ($cadastrarPessoa->execute()){
            echo json_encode($msg['results']['currect']);
        }
        else{
            echo "Erro ao cadastrar";
            print_r($cadastrarPessoa->errorInfo());
            echo json_encode($msg['results']['error']);
        }

    }

?>

