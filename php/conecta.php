<?php
function conectar(){
    try{
        $pdo			= new PDO('mysql:host=127.0.0.1; dbname=pessoa', 'root', 'root');
    }catch(PDOException $erro_conn){
        echo $erro_conn->getMessage();
    }
    return $pdo;
}
header('Content-Type: text/html; charset=UTF-8');
$ano        = date('Y');
$hoje		= date('Y-m-d');
?>