<?php

//header('Content-Type: application/json');

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

        $nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
        $perfil = (isset($_POST['perfil'])) ? $_POST['perfil'] : '';
        $foto = (isset($_FILES['foto'])) && $_FILES['foto']['size'] ? $_FILES['foto'] : '';

        var_dump($nome);
        var_dump($email);
        var_dump($senha);
        var_dump($perfil);
        var_dump($foto);

        if (!empty($foto)){

            $nomeFoto   = $foto['name'];
            $tipo       = $foto['type'];
            $tamanho    = $foto['size'];
            $destino    = 'imagens/';

            var_dump($foto);
            var_dump($nomeFoto);
            var_dump($tipo);
            var_dump($tamanho);
            var_dump($destino);

            $uploadfile = $destino . basename($_FILES['foto']['name']);

            if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo))
            {
                print_r ('Isso não é uma imagem válida');
                exit;
            }

            if(!file_exists($destino)):
                mkdir($destino);
            endif;

            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)):
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
            echo json_encode($msg['results']['currect']);
        }
        else{
            echo "Erro ao cadastrar";
            print_r($cadastrarPessoa->errorInfo());
            echo json_encode($msg['results']['error']);
        }

    }




?>

