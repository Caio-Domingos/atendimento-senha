<?php

function conexaoBanco() {
    //Conexao no banco
    $host = 'localhost';
    $db = 'atendimento';
    $user = 'root';
    $pass = 'root';
    
    
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

