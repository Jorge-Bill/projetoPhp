<?php

require_once "conecta.php";
require_once "consultarPessoa.php";

foreach ($detalhesPessoa as $pessoa) {

    echo ucfirst(strtolower($pessoa->nome));
    echo ucfirst(strtolower($pessoa->email));
    echo ucfirst(strtolower($pessoa->senha));
    echo ucfirst(strtolower($pessoa->perfil));

}


?>