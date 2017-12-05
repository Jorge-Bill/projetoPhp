<?php

header('Content-Type: application/json');

$msg = ['results' => [
    'currect' => [
        'status' => 200
    ],
    'error' => [
        'message' => 'Preencha todos os campos!',
        'status' => 500
    ]
]];


if ($_REQUEST){

    $nome       = (isset($_REQUEST['nome'])) ? $_REQUEST['nome'] : '';
    $email      = (isset($_REQUEST['email'])) ? $_REQUEST['email'] : '';
    $senha      = (isset($_REQUEST['senha'])) ? $_REQUEST['senha'] : '';
    $perfil     = (isset($_REQUEST['perfil'])) ? $_REQUEST['perfil'] : '';
    $foto       = (isset($_FILES['foto'])) && $_FILES['foto']['size'] ? $_FILES['foto'] : '';


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
//    header('Location: /navegacao.php?page=listaUsuarios');
        echo "funciona";
    }

    else{
        echo "Erro ao cadastrar";
        print_r($cadastrarPessoa->errorInfo());
    }
}

?>