<?php

$msg = ['results' => [
    'currect' => [
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
            'perfil'    => $_POST['perfil'],
            'foto'      => $_FILES['foto']
        ];

        if (!empty($pessoa->foto)){
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
        }

        $pdo = conectar();

        $sql = "UPDATE pessoa SET nome=:nome, foto=:foto, perfil=:perfil, senha=:senha, email=:email WHERE id=:id;";

        $updatePessoa = $pdo->prepare($sql);

        $updatePessoa->bindParam(":id", $pessoa->id);
        $updatePessoa->bindParam(":nome", $pessoa->nome);
        $updatePessoa->bindParam(":foto", $pessoa->foto['name']);
        $updatePessoa->bindParam(":perfil", $pessoa->perfil);
        $updatePessoa->bindParam(":senha", $pessoa->senha);
        $updatePessoa->bindParam(":email", $pessoa->email);


        if ($updatePessoa->execute()){
            echo json_encode($msg['results']['currect']);
        }
        else{
            echo "Erro ao cadastrar";
            print_r($updatePessoa->errorInfo());
            echo json_encode($msg['results']['error']);
        }
    }
?>