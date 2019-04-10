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

$select = $pdo->query("SELECT count(codAtende) as nLinhas FROM atende WHERE dataAtende = '$date' AND statusAtende = 'AGUARDANDO ATENDIMENTO'");

$exists = false;
while ($linha = $select->fetch(PDO::FETCH_ASSOC)) {
    $exists = $linha['nLinhas'] > 0 ? true : false;
}

echo json_encode($exists);