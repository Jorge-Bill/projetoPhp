<?php

require_once "../navegacao.php";
require_once "conecta.php";

$nome       = (isset($_REQUEST['nomePessoa'])) ? $_REQUEST['nomePessoa'] : '';
$email      = (isset($_REQUEST['emailPessoa'])) ? $_REQUEST['emailPessoa'] : '';
$senha      = (isset($_REQUEST['senhaPessoa'])) ? $_REQUEST['senhaPessoa'] : '';
$perfil     = (isset($_REQUEST['perfilPessoa'])) ? $_REQUEST['perfilPessoa'] : '';
$foto       = (isset($_FILES['imagemPessoa'])) && $_FILES['imagemPessoa']['size'] ? $_FILES['imagemPessoa'] : '';

if(!file_exists("imagens")):
    mkdir("../imagens");
endif;

// Monta o caminho de destino com o nome do arquivo
$nome_foto = date('dmY') . '_' . $_FILES['imagemPessoa']['nomePessoa'];

// Essa função move_uploaded_file() copia e verifica se o arquivo enviado foi copiado com sucesso para o destino
if (!move_uploaded_file($_FILES['imagemPessoa']['tmp_name'], '../imagens/'.$nome_foto)):
    echo "Houve um erro ao gravar arquivo na pasta de destino!";
endif;

$pdo = conectar();

$sql = ("INSERT INTO pessoa  (nome, foto, perfil, senha, email) VALUES (:nome, :foto, :perfil, :senha, :email)");

$cadastrarPessoa = $pdo->prepare($sql);

$cadastrarPessoa->bindParam(":nome", $nome, PDO::PARAM_STR);
$cadastrarPessoa->bindParam(":foto", $foto, PDO::PARAM_STR);
$cadastrarPessoa->bindParam(":perfil", $perfil, PDO::PARAM_STR);
$cadastrarPessoa->bindParam(":senha", $senha, PDO::PARAM_STR);
$cadastrarPessoa->bindParam(":email", $email, PDO::PARAM_STR);

if ($cadastrarPessoa->execute()){
    header('Location: listaUsuarios.php');
}
else{
    echo "Erro ao cadastrar";
    print_r($cadastrarPessoa->errorInfo());
}















//
//$destino = 'imagens/' . $_FILES['arquivo']['name'];
//$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
//move_uploaded_file( $arquivo_tmp, $destino  );