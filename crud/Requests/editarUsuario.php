<?php

require_once "../../conecta.php";

header('Content-Type: application/json');

$msg = ['results' => [
    'currect' => [
        'message' => 'funciona!',
        'status' => 200
    ],
    'error' => [
        'message' => 'Erro ao editar!',
        'status' => 500
    ]
]];

    if ($_POST){
        $pessoa = (object)[
            'id'        => $_POST['id'],
            'nome'      => $_POST['nome'],
            'email'     => $_POST['email'],
            'senha'     => $_POST['senha'],
            'perfil'    => $_POST['perfil']
        ];

        if(array_key_exists('foto', $_FILES)) {
            $pessoa->foto = $_FILES['foto'];
        }

        if (!empty($pessoa->foto)){

            $destino = '../../imagens/';

            $uploadfile = $destino . basename($pessoa->foto['name']);

            if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp|jpg)$/', $pessoa->foto['type'])){
                print_r ('Isso não é uma imagem válida');
                exit;
            }

            if(!file_exists($destino)) {
                mkdir($destino);
            }

            if (!move_uploaded_file($pessoa->foto['tmp_name'], $uploadfile)) {
                print_r("Houve um erro ao gravar arquivo na pasta de destino!");
            }
        }

        $pdo = conectar();

        if(array_key_exists('foto', $_FILES)) {
            $sql = "UPDATE pessoa SET nome=:nome, foto=:foto, perfil=:perfil, senha=:senha, email=:email WHERE id=:id;";

            $updatePessoa = $pdo->prepare($sql);

            $updatePessoa->bindParam(":id", $pessoa->id);
            $updatePessoa->bindParam(":nome", $pessoa->nome);
            $updatePessoa->bindParam(":foto", $pessoa->foto['name']);
            $updatePessoa->bindParam(":perfil", $pessoa->perfil);
            $updatePessoa->bindParam(":senha", $pessoa->senha);
            $updatePessoa->bindParam(":email", $pessoa->email);
        } else {
            $sql = "UPDATE pessoa SET nome=:nome, perfil=:perfil, senha=:senha, email=:email WHERE id=:id;";

            $updatePessoa = $pdo->prepare($sql);

            $updatePessoa->bindParam(":id", $pessoa->id);
            $updatePessoa->bindParam(":nome", $pessoa->nome);
            $updatePessoa->bindParam(":perfil", $pessoa->perfil);
            $updatePessoa->bindParam(":senha", $pessoa->senha);
            $updatePessoa->bindParam(":email", $pessoa->email);
        }


        if ($updatePessoa->execute()){
            echo json_encode($msg['results']['currect']);
        }
        else{
            echo json_encode($msg['results']['error']);
        }
    }
?>