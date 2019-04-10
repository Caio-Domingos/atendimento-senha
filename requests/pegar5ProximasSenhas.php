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

$select = $pdo->query("SELECT senhaAtende FROM atende WHERE statusAtende = 'AGUARDANDO ATENDIMENTO' AND dataAtende = '$date'  ORDER BY codAtende ASC LIMIT 5");

$arr = [];
while ($linha = $select->fetch(PDO::FETCH_ASSOC)) {
    array_push($arr, $linha['senhaAtende']);
}

echo json_encode($arr);