<?php
// Listar erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Includes

include_once './lib/conexao.php';
include_once './models/atendimento.php';

$pdo = conexaoBanco();

$date = $_POST['date'];
$senha = $_POST['senha'];

$select = $pdo->query("SELECT codAtende FROM atende WHERE senhaAtende = '$senha' AND dataAtende = '$date'  ORDER BY codAtende ASC LIMIT 1");

$id;
while ($linha = $select->fetch(PDO::FETCH_ASSOC)) {
    $id = $linha['codAtende'];
}

$alter = $pdo->query("UPDATE atende SET statusAtende = 'ATENDIDO' WHERE codAtende = '$id'");

echo json_encode(true);